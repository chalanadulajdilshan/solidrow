// Custom JavaScript for Solidrow Engineering Website
document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize AOS (Animate On Scroll)
    AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: true,
        mirror: false,
        offset: 100
    });

    // Navbar scroll effect
    const navbar = document.getElementById('mainNav');
    
    function updateNavbar() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
    
    // Initial check
    updateNavbar();
    
    // Add scroll event listener with throttling
    let ticking = false;
    function handleScroll() {
        if (!ticking) {
            requestAnimationFrame(function() {
                updateNavbar();
                ticking = false;
            });
            ticking = true;
        }
    }
    
    window.addEventListener('scroll', handleScroll, { passive: true });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            
            if (target) {
                const headerOffset = navbar.offsetHeight + 20;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Active navigation link highlighting
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
    
    function highlightActiveSection() {
        let current = '';
        const scrollPos = window.scrollY + navbar.offsetHeight + 100;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    }
    
    window.addEventListener('scroll', highlightActiveSection, { passive: true });
    highlightActiveSection(); // Initial call

    // Carousel auto-pause on hover
    const carousel = document.querySelector('#heroCarousel');
    if (carousel) {
        carousel.addEventListener('mouseenter', function() {
            bootstrap.Carousel.getInstance(carousel).pause();
        });
        
        carousel.addEventListener('mouseleave', function() {
            bootstrap.Carousel.getInstance(carousel).cycle();
        });
    }

    // Parallax effect for hero section
    function parallaxEffect() {
        const scrolled = window.pageYOffset;
        const heroSlides = document.querySelectorAll('.hero-slide');
        
        heroSlides.forEach(slide => {
            const rate = scrolled * -0.5;
            slide.style.transform = `translateY(${rate}px)`;
        });
    }
    
    // Apply parallax with requestAnimationFrame for better performance
    let parallaxTicking = false;
    function handleParallax() {
        if (!parallaxTicking) {
            requestAnimationFrame(function() {
                parallaxEffect();
                parallaxTicking = false;
            });
            parallaxTicking = true;
        }
    }
    
    window.addEventListener('scroll', handleParallax, { passive: true });

    // Counter animation for stats (if you add stats section later)
    function animateCounters() {
        const counters = document.querySelectorAll('.counter');
        
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000; // 2 seconds
            const increment = target / (duration / 16); // 60fps
            let current = 0;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };
            
            // Start animation when element is in viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCounter();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(counter);
        });
    }
    
    animateCounters();

    // Typing effect for hero titles
    function typeWriter(element, text, speed = 100) {
        let i = 0;
        element.innerHTML = '';
        
        function type() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }
        
        type();
    }

    // Loading screen
    function hideLoader() {
        const loader = document.querySelector('.loading-overlay');
        if (loader) {
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        }
    }

    // Hide loader when page is fully loaded
    window.addEventListener('load', hideLoader);

    // Projects Slider Functionality
    const projectsSlider = {
        currentIndex: 0,
        slides: document.querySelectorAll('.project-slide'),
        container: document.querySelector('.projects-slider'),
        indicators: document.querySelectorAll('.projects-indicators .indicator'),
        prevBtn: document.getElementById('projectsPrev'),
        nextBtn: document.getElementById('projectsNext'),
        slidesPerView: 3,
        
        init() {
            if (this.slides.length === 0) return;
            
            // Initialize active slides
            this.updateSlides();
            
            // Add event listeners
            this.prevBtn?.addEventListener('click', () => this.prevSlide());
            this.nextBtn?.addEventListener('click', () => this.nextSlide());
            
            // Touch/swipe support
            this.addTouchSupport();
            
            // Keyboard support
            this.addKeyboardSupport();
            
            // Handle window resize
            window.addEventListener('resize', () => this.handleResize());
            
            // Initial position
            this.updateSliderPosition();
        },
        
        updateSlides() {
            // Show active slides and hide others
            this.slides.forEach((slide, index) => {
                if (index >= this.currentIndex && index < this.currentIndex + this.slidesPerView) {
                    slide.classList.add('active');
                } else {
                    slide.classList.remove('active');
                }
            });
            
            // Update indicators
            this.indicators.forEach((indicator, i) => {
                indicator.classList.toggle('active', i === Math.floor(this.currentIndex / this.slidesPerView));
            });
            
            // Update slider position
            this.updateSliderPosition();
        },
        
        updateSliderPosition() {
            if (!this.container) return;
            const slideWidth = 100 / this.slidesPerView;
            const offset = -(this.currentIndex * slideWidth);
            this.container.style.transform = `translateX(${offset}%)`;
        },
        
        nextSlide() {
            if (this.currentIndex >= this.slides.length - this.slidesPerView) return;
            this.currentIndex++;
            this.updateSlides();
        },
        
        prevSlide() {
            if (this.currentIndex <= 0) return;
            this.currentIndex--;
            this.updateSlides();
        },
        
        goToSlide(index) {
            const slideIndex = index * this.slidesPerView;
            if (slideIndex >= 0 && slideIndex < this.slides.length) {
                this.currentIndex = slideIndex;
                this.updateSlides();
            }
        },
        
        handleResize() {
            // Adjust slides per view based on screen size
            if (window.innerWidth < 768) {
                this.slidesPerView = 1;
            } else if (window.innerWidth < 992) {
                this.slidesPerView = 2;
            } else {
                this.slidesPerView = 3;
            }
            this.updateSlides();
        },
        
        addTouchSupport() {
            const slider = this.container;
            if (!slider) return;
            
            let startX = 0;
            let startY = 0;
            let isDragging = false;
            
            slider.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;
                isDragging = true;
            }, { passive: true });
            
            slider.addEventListener('touchmove', (e) => {
                if (!isDragging) return;
                e.preventDefault();
            }, { passive: false });
            
            slider.addEventListener('touchend', (e) => {
                if (!isDragging) return;
                isDragging = false;
                
                const endX = e.changedTouches[0].clientX;
                const endY = e.changedTouches[0].clientY;
                const diffX = startX - endX;
                const diffY = startY - endY;
                
                // Only slide if horizontal swipe is greater than vertical
                if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 50) {
                    if (diffX > 0) {
                        this.nextSlide(); // Swipe left - next slide
                    } else {
                        this.prevSlide(); // Swipe right - previous slide
                    }
                }
            }, { passive: true });
        },
        
        addKeyboardSupport() {
            document.addEventListener('keydown', (e) => {
                const slider = this.container;
                if (!slider || !this.isInViewport(slider)) return;
                
                if (e.key === 'ArrowLeft') {
                    e.preventDefault();
                    this.prevSlide();
                } else if (e.key === 'ArrowRight') {
                    e.preventDefault();
                    this.nextSlide();
                }
            });
        },
        
        isInViewport(element) {
            const rect = element.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) * 1.5 &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }
    };
    
    // Initialize projects slider
    projectsSlider.init();

    // Website card hover effects with 3D tilt
    const websiteCards = document.querySelectorAll('.website-card');
    
    websiteCards.forEach(card => {
        card.addEventListener('mousemove', function(e) {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
        });
        
        card.addEventListener('mouseleave', function() {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
    });

    // Scroll progress indicator
    function updateScrollProgress() {
        const scrollProgress = document.querySelector('.scroll-progress');
        if (scrollProgress) {
            const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const progress = (scrollTop / scrollHeight) * 100;
            
            scrollProgress.style.width = progress + '%';
        }
    }
    
    window.addEventListener('scroll', updateScrollProgress, { passive: true });

    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Form validation and submission (if forms are added)
    function initializeFormValidation() {
        const forms = document.querySelectorAll('.needs-validation');
        
        forms.forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        });
    }
    
    initializeFormValidation();

    // Mobile menu improvements
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        // Close mobile menu when clicking on a link
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (navbarCollapse.classList.contains('show')) {
                    navbarToggler.click();
                }
            });
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!navbar.contains(e.target) && navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        });
    }

    // Keyboard navigation improvements
    document.addEventListener('keydown', function(e) {
        // ESC key closes mobile menu
        if (e.key === 'Escape' && navbarCollapse && navbarCollapse.classList.contains('show')) {
            navbarToggler.click();
        }
        
        // Space or Enter on cards triggers click
        if ((e.key === ' ' || e.key === 'Enter') && e.target.classList.contains('project-card')) {
            e.preventDefault();
            const link = e.target.querySelector('a');
            if (link) link.click();
        }
    });

    // Add focus styles for accessibility
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            document.body.classList.add('using-keyboard');
        }
    });
    
    document.addEventListener('mousedown', function() {
        document.body.classList.remove('using-keyboard');
    });

    // Performance optimization: Debounce resize events
    function debounce(func, wait, immediate) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                timeout = null;
                if (!immediate) func(...args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func(...args);
        };
    }

    // Handle window resize
    const handleResize = debounce(() => {
        // Refresh AOS on resize
        AOS.refresh();
        
        // Update any size-dependent calculations
        highlightActiveSection();
    }, 250);
    
    window.addEventListener('resize', handleResize);

    // Error handling for external resources
    window.addEventListener('error', function(e) {
        if (e.target.tagName === 'IMG') {
            console.warn('Image failed to load:', e.target.src);
            // You could set a fallback image here
            // e.target.src = '/assets/images/fallback.jpg';
        }
    }, true);

    console.log('Solidrow Engineering website initialized successfully!');
});

// Utility functions
const SolidrowUtils = {
    // Smooth scroll to element
    scrollTo: function(element, offset = 100) {
        const target = typeof element === 'string' ? document.querySelector(element) : element;
        if (target) {
            const elementPosition = target.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - offset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    },
    
    // Check if element is in viewport
    isInViewport: function(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    },
    
    // Format number with commas
    formatNumber: function(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
};

// Export utils for use in other scripts
window.SolidrowUtils = SolidrowUtils;