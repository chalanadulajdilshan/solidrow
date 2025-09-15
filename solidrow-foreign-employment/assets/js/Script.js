// Initialize AOS (Animate On Scroll)
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: true,
        offset: 50
    });
});

// Navbar Scroll Effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.custom-navbar');
    const scrollProgress = document.querySelector('.scroll-progress');
    
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
    
    // Update scroll progress bar
    if (!scrollProgress) {
        const progressBar = document.createElement('div');
        progressBar.className = 'scroll-progress';
        document.body.appendChild(progressBar);
    }
    
    const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (window.scrollY / windowHeight) * 100;
    document.querySelector('.scroll-progress').style.width = scrolled + '%';
});

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            const offsetTop = target.offsetTop - 80;
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
            
            // Update active nav link
            updateActiveNavLink(this.getAttribute('href'));
        }
    });
});

// Update active navigation link based on scroll position
function updateActiveNavLink(activeHref = null) {
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const sections = document.querySelectorAll('section[id]');
    
    if (activeHref) {
        navLinks.forEach(link => link.classList.remove('active'));
        document.querySelector(`.navbar-nav .nav-link[href="${activeHref}"]`).classList.add('active');
        return;
    }
    
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        const sectionHeight = section.offsetHeight;
        if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
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

// Update active nav on scroll
window.addEventListener('scroll', updateActiveNavLink);

// Course Slider Functionality
class CourseSlider {
    constructor() {
        console.log('Initializing Course Slider...');
        this.slider = document.querySelector('.course-slider');
        this.cards = document.querySelectorAll('.course-card');
        this.indicators = document.querySelectorAll('.indicator');
        this.prevBtn = document.getElementById('prevCourse');
        this.nextBtn = document.getElementById('nextCourse');
        this.currentIndex = 0;
        this.autoPlayInterval = null;
        
        console.log('Found elements:', {
            slider: this.slider,
            cards: this.cards.length,
            indicators: this.indicators.length,
            prevBtn: this.prevBtn,
            nextBtn: this.nextBtn
        });
        
        // Initialize only if we have cards
        if (this.cards.length > 0) {
            console.log('Initializing slider with', this.cards.length, 'cards');
            this.init();
        } else {
            console.error('No course cards found for slider');
        }
    }
    
    init() {
        console.log('Initializing course slider...');
        if (!this.slider) {
            console.error('Slider container not found');
            return;
        }
        if (this.cards.length === 0) {
            console.error('No course cards found');
            return;
        }
        
        // Set initial active state
        console.log('Setting initial active state for card 0');
        this.cards[0].classList.add('active');
        if (this.indicators.length > 0) {
            this.indicators[0].classList.add('active');
        }
        
        this.bindEvents();
        this.startAutoPlay();
        console.log('Course slider initialized successfully');
    }
    
    bindEvents() {
        console.log('Binding slider events...');
        
        if (this.prevBtn) {
            console.log('Found previous button');
            this.prevBtn.addEventListener('click', (e) => {
                console.log('Previous button clicked');
                e.preventDefault();
                this.prevSlide();
            });
        } else {
            console.error('Previous button not found');
        }
        
        if (this.nextBtn) {
            console.log('Found next button');
            this.nextBtn.addEventListener('click', (e) => {
                console.log('Next button clicked');
                e.preventDefault();
                this.nextSlide();
            });
        } else {
            console.error('Next button not found');
        }
        
        this.indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => this.goToSlide(index));
        });
        
        // Pause autoplay on hover
        if (this.slider) {
            this.slider.addEventListener('mouseenter', () => this.stopAutoPlay());
            this.slider.addEventListener('mouseleave', () => this.startAutoPlay());
            
            // Touch/swipe support
            let startX = 0;
            let endX = 0;
            
            this.slider.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
            });
            
            this.slider.addEventListener('touchend', (e) => {
                endX = e.changedTouches[0].clientX;
                this.handleSwipe(startX, endX);
            });
        }
    }
    
    handleSwipe(startX, endX) {
        const diff = startX - endX;
        const minSwipeDistance = 50;
        
        if (Math.abs(diff) > minSwipeDistance) {
            if (diff > 0) {
                this.nextSlide();
            } else {
                this.prevSlide();
            }
        }
    }
    
    updateSlider() {
        console.log('Updating slider to index:', this.currentIndex);
        
        // First, set all cards to inactive but keep them in the DOM
        this.cards.forEach((card, index) => {
            if (index === this.currentIndex) {
                console.log('Activating card', index);
                // Add active class with a small delay to ensure smooth transition
                setTimeout(() => {
                    card.classList.add('active');
                    card.style.opacity = '1';
                    card.style.visibility = 'visible';
                    card.style.transform = 'translateX(0)';
                }, 10);
            } else {
                // Only hide the card after the transition is complete
                if (card.classList.contains('active')) {
                    card.style.opacity = '0';
                    card.style.visibility = 'hidden';
                    card.style.transform = 'translateX(100%)';
                    // Remove active class after transition
                    setTimeout(() => {
                        card.classList.remove('active');
                    }, 500); // Match this with CSS transition duration
                }
            }
        });
        
        // Update indicators
        if (this.indicators.length > 0) {
            this.indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === this.currentIndex);
            });
        }
        
        // Update navigation buttons
        if (this.prevBtn) {
            this.prevBtn.disabled = this.currentIndex === 0;
            console.log('Previous button disabled:', this.prevBtn.disabled);
        }
        if (this.nextBtn) {
            this.nextBtn.disabled = this.currentIndex === this.cards.length - 1;
            console.log('Next button disabled:', this.nextBtn.disabled);
        }
    }
    
    nextSlide() {
        // Disable buttons during transition
        if (this.nextBtn) this.nextBtn.disabled = true;
        if (this.prevBtn) this.prevBtn.disabled = true;
        
        // Update index
        if (this.currentIndex < this.cards.length - 1) {
            this.currentIndex++;
        } else {
            this.currentIndex = 0;
        }
        
        this.updateSlider();
        this.restartAutoPlay();
        
        // Re-enable buttons after transition
        setTimeout(() => {
            if (this.nextBtn) this.nextBtn.disabled = this.currentIndex === this.cards.length - 1;
            if (this.prevBtn) this.prevBtn.disabled = this.currentIndex === 0;
        }, 600); // Slightly longer than the CSS transition
    }
    
    prevSlide() {
        // Disable buttons during transition
        if (this.nextBtn) this.nextBtn.disabled = true;
        if (this.prevBtn) this.prevBtn.disabled = true;
        
        // Update index
        if (this.currentIndex > 0) {
            this.currentIndex--;
        } else {
            this.currentIndex = this.cards.length - 1;
        }
        
        this.updateSlider();
        this.restartAutoPlay();
        
        // Re-enable buttons after transition
        setTimeout(() => {
            if (this.nextBtn) this.nextBtn.disabled = this.currentIndex === this.cards.length - 1;
            if (this.prevBtn) this.prevBtn.disabled = this.currentIndex === 0;
        }, 600); // Slightly longer than the CSS transition
    }
    
    goToSlide(index) {
        if (index >= 0 && index < this.cards.length) {
            this.currentIndex = index;
            this.updateSlider();
            this.restartAutoPlay();
        }
    }
    
    startAutoPlay() {
        if (this.autoPlayInterval) return;
        
        this.autoPlayInterval = setInterval(() => {
            this.nextSlide();
        }, 5000);
    }
    
    stopAutoPlay() {
        if (this.autoPlayInterval) {
            clearInterval(this.autoPlayInterval);
            this.autoPlayInterval = null;
        }
    }
    
    restartAutoPlay() {
        this.stopAutoPlay();
        this.startAutoPlay();
    }
}

// Initialize Course Slider
let courseSliderInitialized = false;

function initCourseSlider() {
    if (courseSliderInitialized) return;
    console.log('Initializing course slider...');
    const courseSlider = new CourseSlider();
    window.courseSlider = courseSlider; // Make it available in console for debugging
    courseSliderInitialized = true;
    console.log('Course slider instance created:', courseSlider);
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCourseSlider);
} else {
    initCourseSlider();
}

// Animated Counter
function animateCounters() {
    const counters = document.querySelectorAll('.stat-number[data-count]');
    
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-count'));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            counter.textContent = Math.floor(current);
        }, 16);
    });
}

// Trigger counter animation when about section is visible
const aboutSection = document.querySelector('#about-us');
if (aboutSection) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.unobserve(entry.target);
            }
        });
    });
    observer.observe(aboutSection);
}

// Gallery Modal/Lightbox Functionality
function initGallery() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            const img = this.querySelector('img');
            createLightbox(img.src, img.alt);
        });
    });
}

function createLightbox(src, alt) {
    const lightbox = document.createElement('div');
    lightbox.className = 'lightbox';
    lightbox.innerHTML = `
        <div class="lightbox-content">
            <span class="lightbox-close">&times;</span>
            <img src="${src}" alt="${alt}">
            <div class="lightbox-caption">${alt}</div>
        </div>
    `;
    
    // Add lightbox styles
    const lightboxStyles = `
        .lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .lightbox.show {
            opacity: 1;
        }
        .lightbox-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            text-align: center;
        }
        .lightbox-content img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .lightbox-close {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            font-size: 30px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }
        .lightbox-close:hover {
            background: rgba(255,255,255,0.3);
            transform: scale(1.1);
        }
        .lightbox-caption {
            color: white;
            margin-top: 20px;
            font-size: 1.1rem;
        }
    `;
    
    // Add styles if not already added
    if (!document.querySelector('#lightbox-styles')) {
        const styleSheet = document.createElement('style');
        styleSheet.id = 'lightbox-styles';
        styleSheet.textContent = lightboxStyles;
        document.head.appendChild(styleSheet);
    }
    
    document.body.appendChild(lightbox);
    
    // Show lightbox with animation
    setTimeout(() => lightbox.classList.add('show'), 10);
    
    // Close functionality
    const closeBtn = lightbox.querySelector('.lightbox-close');
    closeBtn.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });
    
    // ESC key to close
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });
    
    function closeLightbox() {
        lightbox.classList.remove('show');
        setTimeout(() => {
            document.body.removeChild(lightbox);
        }, 300);
    }
}

// Initialize gallery
initGallery();

// Contact Form Handler
const contactForm = document.querySelector('.contact-form');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Sending...';
        submitBtn.disabled = true;
        
        // Get form data
        const formData = new FormData(this);
        
        // Simulate form submission (replace with actual AJAX call)
        setTimeout(() => {
            // Reset form
            this.reset();
            
            // Show success message
            showNotification('Message sent successfully! We will contact you soon.', 'success');
            
            // Reset button
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }, 2000);
    });
}

// Notification System
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'}"></i>
            <span>${message}</span>
            <button class="notification-close">&times;</button>
        </div>
    `;
    
    // Add notification styles
    const notificationStyles = `
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            max-width: 400px;
            padding: 15px 20px;
            border-radius: 10px;
            color: white;
            z-index: 10000;
            transform: translateX(100%);
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .notification-success {
            background: #28a745;
        }
        .notification-info {
            background: #17a2b8;
        }
        .notification-error {
            background: #dc3545;
        }
        .notification.show {
            transform: translateX(0);
        }
        .notification-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .notification-close {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            margin-left: auto;
            padding: 0;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    `;
    
    // Add styles if not already added
    if (!document.querySelector('#notification-styles')) {
        const styleSheet = document.createElement('style');
        styleSheet.id = 'notification-styles';
        styleSheet.textContent = notificationStyles;
        document.head.appendChild(styleSheet);
    }
    
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => notification.classList.add('show'), 10);
    
    // Auto hide after 5 seconds
    const hideTimer = setTimeout(() => {
        hideNotification();
    }, 5000);
    
    // Close button functionality
    notification.querySelector('.notification-close').addEventListener('click', hideNotification);
    
    function hideNotification() {
        clearTimeout(hideTimer);
        notification.classList.remove('show');
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }
}

// Back to Top Button
function createBackToTopButton() {
    const backToTop = document.createElement('button');
    backToTop.className = 'back-to-top';
    backToTop.innerHTML = '<i class="fas fa-arrow-up"></i>';
    backToTop.setAttribute('aria-label', 'Back to Top');
    document.body.appendChild(backToTop);
    
    backToTop.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', () => {
        if (window.scrollY > 500) {
            backToTop.classList.add('visible');
        } else {
            backToTop.classList.remove('visible');
        }
    });
}

// Initialize back to top button
createBackToTopButton();

// Parallax Effect for Hero Section
function initParallax() {
    const heroSlides = document.querySelectorAll('.hero-slide');
    
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallaxSpeed = 0.5;
        
        heroSlides.forEach(slide => {
            const yPos = -(scrolled * parallaxSpeed);
            slide.style.transform = `translateY(${yPos}px)`;
        });
    });
}

// Initialize parallax on larger screens
if (window.innerWidth > 768) {
    initParallax();
}

// Lazy Loading Images
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
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
    
    images.forEach(img => imageObserver.observe(img));
}

// Initialize lazy loading
initLazyLoading();

// Typing Effect for Hero Text
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

// Initialize typing effect for hero titles (optional)
const heroTitles = document.querySelectorAll('.hero-title');
heroTitles.forEach((title, index) => {
    const originalText = title.textContent;
    // Only apply to first slide initially
    if (index === 0) {
        setTimeout(() => {
            typeWriter(title, originalText, 50);
        }, 500);
    }
});

// Mobile Menu Enhancement
const navbarToggler = document.querySelector('.navbar-toggler');
const navbarCollapse = document.querySelector('.navbar-collapse');

if (navbarToggler && navbarCollapse) {
    navbarToggler.addEventListener('click', function() {
        navbarCollapse.classList.toggle('show');
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!navbarToggler.contains(e.target) && !navbarCollapse.contains(e.target)) {
            navbarCollapse.classList.remove('show');
        }
    });
    
    // Close menu when clicking on nav links
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navbarCollapse.classList.remove('show');
        });
    });
}

// Page Loading Animation
window.addEventListener('load', function() {
    // Hide loading screen if exists
    const loader = document.querySelector('.page-loader');
    if (loader) {
        loader.style.opacity = '0';
        setTimeout(() => {
            loader.style.display = 'none';
        }, 500);
    }
    
    // Trigger entrance animations
    const animatedElements = document.querySelectorAll('[data-aos]');
    animatedElements.forEach(element => {
        element.classList.add('aos-animate');
    });
});

// Form Validation Enhancement
function enhanceFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input, textarea, select');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    validateField(this);
                }
            });
        });
    });
}

function validateField(field) {
    const value = field.value.trim();
    let isValid = true;
    let errorMessage = '';
    
    // Required field validation
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        errorMessage = 'This field is required';
    }
    
    // Email validation
    if (field.type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid email address';
        }
    }
    
    // Phone validation
    if (field.type === 'tel' && value) {
        const phoneRegex = /^[\d\s\-\+\(\)]{10,}$/;
        if (!phoneRegex.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid phone number';
        }
    }
    
    // Update field state
    if (isValid) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
        removeErrorMessage(field);
    } else {
        field.classList.remove('is-valid');
        field.classList.add('is-invalid');
        showErrorMessage(field, errorMessage);
    }
    
    return isValid;
}

function showErrorMessage(field, message) {
    removeErrorMessage(field);
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback';
    errorDiv.textContent = message;
    
    field.parentNode.appendChild(errorDiv);
}

function removeErrorMessage(field) {
    const errorDiv = field.parentNode.querySelector('.invalid-feedback');
    if (errorDiv) {
        errorDiv.remove();
    }
}

// Initialize form validation
enhanceFormValidation();

// Performance Optimization - Debounce scroll events
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Apply debounce to scroll-heavy functions
const debouncedScrollHandler = debounce(() => {
    updateActiveNavLink();
}, 100);

window.addEventListener('scroll', debouncedScrollHandler);

// Initialize all components when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Add any additional initialization code here
    console.log('SOLIDROW FESTI website loaded successfully!');
});

// Add smooth reveal animations for elements
function revealOnScroll() {
    const reveals = document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .zoom-in');
    
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });
    
    reveals.forEach(reveal => {
        revealObserver.observe(reveal);
    });
}

// Initialize reveal animations
revealOnScroll();