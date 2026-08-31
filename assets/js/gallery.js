/**
 * Solidrow Gallery & Lightbox JavaScript
 * Handles lightbox functionality and gallery interactions
 */

(function() {
    'use strict';

    // ========================================
    // Lightbox Controller
    // ========================================
    const GalleryLightbox = {
        items: [],
        currentIndex: 0,
        isOpen: false,

        init() {
            this.lightbox = document.getElementById('galleryLightbox');
            if (!this.lightbox) return;

            this.content = document.getElementById('lightboxContent');
            this.caption = document.getElementById('lightboxCaption');
            this.counter = document.getElementById('lightboxCounter');
            this.closeBtn = document.getElementById('lightboxClose');
            this.prevBtn = document.getElementById('lightboxPrev');
            this.nextBtn = document.getElementById('lightboxNext');
            this.backdrop = this.lightbox.querySelector('.lightbox-backdrop');

            this.bindEvents();
            this.bindGalleryItems();
        },

        bindEvents() {
            // Close
            this.closeBtn.addEventListener('click', () => this.close());
            this.backdrop.addEventListener('click', () => this.close());

            // Navigation
            this.prevBtn.addEventListener('click', () => this.prev());
            this.nextBtn.addEventListener('click', () => this.next());

            // Keyboard
            document.addEventListener('keydown', (e) => {
                if (!this.isOpen) return;
                if (e.key === 'Escape') this.close();
                if (e.key === 'ArrowLeft') this.prev();
                if (e.key === 'ArrowRight') this.next();
            });

            // Touch/Swipe
            let startX = 0;
            this.content.addEventListener('touchstart', (e) => {
                startX = e.changedTouches[0].screenX;
            }, { passive: true });
            this.content.addEventListener('touchend', (e) => {
                const diff = startX - e.changedTouches[0].screenX;
                if (Math.abs(diff) > 50) {
                    diff > 0 ? this.next() : this.prev();
                }
            }, { passive: true });
        },

        bindGalleryItems() {
            // Bind click handlers to all gallery items
            document.querySelectorAll('[data-lightbox]').forEach((el) => {
                el.addEventListener('click', (e) => {
                    e.preventDefault();
                    const group = el.getAttribute('data-lightbox-group') || 'default';
                    this.openGroup(group, el);
                });
            });
        },

        openGroup(group, clickedEl) {
            // Collect all items in this group
            const elements = document.querySelectorAll(`[data-lightbox-group="${group}"]`);
            this.items = [];
            let startIndex = 0;

            elements.forEach((el, index) => {
                const type = el.getAttribute('data-lightbox-type') || 'photo';
                const src = el.getAttribute('data-lightbox');
                const title = el.getAttribute('data-lightbox-title') || '';
                const videoUrl = el.getAttribute('data-lightbox-video') || '';

                this.items.push({ type, src, title, videoUrl });

                if (el === clickedEl) {
                    startIndex = index;
                }
            });

            this.open(startIndex);
        },

        open(index) {
            this.currentIndex = index;
            this.isOpen = true;
            this.lightbox.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            
            // Trigger animation
            requestAnimationFrame(() => {
                this.lightbox.classList.add('active');
            });

            this.showItem();
        },

        close() {
            this.lightbox.classList.remove('active');
            this.isOpen = false;
            document.body.style.overflow = '';
            
            // Stop any playing videos
            const iframe = this.content.querySelector('iframe');
            const video = this.content.querySelector('video');
            if (iframe) iframe.src = '';
            if (video) video.pause();

            setTimeout(() => {
                this.lightbox.style.display = 'none';
                this.content.innerHTML = '';
            }, 300);
        },

        prev() {
            if (this.items.length <= 1) return;
            this.currentIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
            this.showItem();
        },

        next() {
            if (this.items.length <= 1) return;
            this.currentIndex = (this.currentIndex + 1) % this.items.length;
            this.showItem();
        },

        showItem() {
            const item = this.items[this.currentIndex];
            if (!item) return;

            // Clear previous content
            this.content.innerHTML = '';

            if (item.type === 'photo') {
                // Show image
                const img = document.createElement('img');
                img.src = item.src;
                img.alt = item.title || 'Gallery Image';
                img.className = 'lightbox-image';
                img.addEventListener('load', () => img.classList.add('loaded'));
                
                // Loading spinner
                const spinner = document.createElement('div');
                spinner.className = 'lightbox-spinner';
                spinner.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                this.content.appendChild(spinner);
                this.content.appendChild(img);
            } else {
                // Show video
                const videoUrl = item.videoUrl || item.src;
                const ytId = this.extractYoutubeId(videoUrl);

                if (ytId) {
                    // YouTube embed
                    const iframe = document.createElement('iframe');
                    iframe.src = `https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0`;
                    iframe.className = 'lightbox-video';
                    iframe.setAttribute('allowfullscreen', '');
                    iframe.setAttribute('allow', 'autoplay; encrypted-media');
                    iframe.setAttribute('frameborder', '0');
                    this.content.appendChild(iframe);
                } else {
                    // HTML5 video
                    const video = document.createElement('video');
                    video.src = item.src;
                    video.className = 'lightbox-video-player';
                    video.controls = true;
                    video.autoplay = true;
                    this.content.appendChild(video);
                }
            }

            // Update caption
            this.caption.textContent = item.title || '';
            this.caption.style.display = item.title ? 'block' : 'none';

            // Update counter
            if (this.items.length > 1) {
                this.counter.textContent = `${this.currentIndex + 1} / ${this.items.length}`;
                this.counter.style.display = 'block';
                this.prevBtn.style.display = 'flex';
                this.nextBtn.style.display = 'flex';
            } else {
                this.counter.style.display = 'none';
                this.prevBtn.style.display = 'none';
                this.nextBtn.style.display = 'none';
            }
        },

        extractYoutubeId(url) {
            if (!url) return null;
            const match = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
            return match ? match[1] : null;
        }
    };

    // ========================================
    // Lazy Loading for Gallery Images
    // ========================================
    function initLazyLoading() {
        const lazyImages = document.querySelectorAll('.gallery-lazy');
        
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('gallery-lazy');
                        img.classList.add('gallery-loaded');
                        observer.unobserve(img);
                    }
                });
            }, { rootMargin: '100px' });

            lazyImages.forEach(img => observer.observe(img));
        } else {
            // Fallback: load all images
            lazyImages.forEach(img => {
                img.src = img.dataset.src;
            });
        }
    }

    // ========================================
    // Gallery Filter (for agency pages with mixed media)
    // ========================================
    function initGalleryFilter() {
        const filterBtns = document.querySelectorAll('.gallery-filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-grid-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Update active state
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filter = btn.dataset.filter;

                galleryItems.forEach(item => {
                    if (filter === 'all' || item.dataset.type === filter) {
                        item.style.display = '';
                        item.classList.add('gallery-fade-in');
                    } else {
                        item.style.display = 'none';
                        item.classList.remove('gallery-fade-in');
                    }
                });
            });
        });
    }

    // ========================================
    // Initialize on DOM Ready
    // ========================================
    document.addEventListener('DOMContentLoaded', () => {
        GalleryLightbox.init();
        initLazyLoading();
        initGalleryFilter();
    });

})();
