<?php
// Footer PHP logic can be added here
$current_year = date('Y');
?>
<footer class="footer">
    <!-- Scroll Progress Bar -->
    <div class="scroll-progress"></div>

    <!-- Main Footer Content -->
    <div class="footer-main">
        <div class="container">
            <div class="row g-4">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">
                        <div class="footer-logo">

                            <span class="footer-brand-text">About Us</span>
                        </div>
                        <p class="footer-description">
                            Solidrow Group of Companies is a diversified corporate group dedicated to delivering excellence across 
                            multiple sectors including engineering, technical training, foreign employment, and visa consultancy.
                        </p>
                        <div class="social-links">
                            <a href="#" class="social-link" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h4 class="footer-title">Quick Links</h4>
                        <ul class="footer-links">
                            <li><a href="/solidrow/index.php">Home</a></li>
                            <li><a href="/solidrow/about.php">About Us</a></li>
                            <li><a href="/solidrow/services.php">Services</a></li>
                            <li><a href="/solidrow/jobs.php">Jobs</a></li>
                            <li><a href="/solidrow/contact.php">Contact</a></li>
                            <li><a href="/solidrow/blog.php">Blog</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Services -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h4 class="footer-title">Services</h4>
                        <ul class="footer-links">
                            <li><a href="/solidrow/job-placement.php">Job Placement</a></li>
                            <li><a href="/solidrow/visa-processing.php">Visa Processing</a></li>
                            <li><a href="/solidrow/training.php">Training Programs</a></li>
                            <li><a href="/solidrow/consultation.php">Consultation</a></li>
                            <li><a href="/solidrow/documentation.php">Documentation</a></li>
                            <li><a href="/solidrow/support.php">24/7 Support</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">
                        <h4 class="footer-title">Get in Touch</h4>
                        <div class="contact-info">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-details">
                                    <p>12/87 Kelanimulla,
                                        <br> Mulleriyawa New Town,
                                        <br> 10620,
                                        <br> Sri Lanka
                                    </p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact-details">
                                    <p>+94 77 930 1318</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-details">
                                    <p>info@solidrow.lk</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright">
                        &copy; <?php echo $current_year; ?> Solidrow Development by sourcecode.lk
                    </p>
                </div>
                <div class="col-md-6">
                    <ul class="footer-bottom-links">
                        <li><a href="/solidrow/privacy-policy.php">Privacy Policy</a></li>
                        <li><a href="/solidrow/terms-conditions.php">Terms & Conditions</a></li>
                        <li><a href="/solidrow/sitemap.php">Sitemap</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop" aria-label="Back to Top">
        <i class="fas fa-chevron-up"></i>
    </button>
</footer>

<style>
    /* Footer Styles */
    :root {
        --primary-color: #011a42;
        --secondary-color: #f57c02;
        --accent-color: #ff9e2c;
        --gradient-1: linear-gradient(135deg, #011a42 0%, #003366 100%);
        --gradient-2: linear-gradient(135deg, #f57c02 0%, #ff9e2c 100%);
    }

    .footer {
        background: var(--gradient-1);
        color: white;
        position: relative;
        overflow: hidden;
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }

    .footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image:
            radial-gradient(circle at 25% 25%, rgba(245, 124, 2, 0.1) 0%, transparent 70%),
            radial-gradient(circle at 75% 75%, rgba(245, 124, 2, 0.05) 0%, transparent 70%);
        pointer-events: none;
    }

    .footer-main {
        padding: 4rem 0 2rem;
        position: relative;
        z-index: 2;
    }

    .footer-section {
        height: 100%;
    }

    .footer-logo {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        gap: 10px;
    }

    .footer-brand-text {
        font-size: 1.5rem;
        font-weight: 700;
        margin-left: 0.5rem;
        background: linear-gradient(135deg, #ffffff 0%, #f57c02 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .footer-description {
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.7;
        margin-bottom: 2rem;
    }

    .social-links {
        display: flex;
        gap: 1rem;
    }

    .social-link {
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .social-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--gradient-2);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .social-link:hover::before {
        opacity: 1;
    }

    .social-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(245, 124, 2, 0.3);
        border-color: var(--accent-color);
    }

    .footer-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: white;
        position: relative;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 30px;
        height: 2px;
        background: var(--gradient-2);
        border-radius: 1px;
    }

    .footer-links {
        list-style: none;
        padding: 0;
    }

    .footer-links li {
        margin-bottom: 0.8rem;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        padding-left: 15px;
    }

    .footer-links a::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 6px;
        height: 6px;
        background: var(--accent-color);
        border-radius: 50%;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .footer-links a:hover {
        color: white;
        padding-left: 20px;
    }

    .footer-links a:hover::before {
        opacity: 1;
    }

    .contact-info {
        margin-bottom: 2rem;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.5rem;
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        background: rgba(245, 124, 2, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent-color);
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .contact-details p {
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
        line-height: 1.6;
    }

    .newsletter-signup {
        margin-top: 2rem;
    }

    .newsletter-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: white;
    }

    .newsletter-form .input-group {
        border-radius: 50px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .newsletter-form .form-control {
        border: none;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: white;
        padding: 0.8rem 1.2rem;
        border-radius: 50px 0 0 50px;
    }

    .newsletter-form .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .newsletter-form .form-control:focus {
        box-shadow: none;
        background: rgba(255, 255, 255, 0.15);
        color: white;
    }

    .btn-newsletter {
        background: var(--gradient-2);
        border: none;
        color: white;
        padding: 0.8rem 1.5rem;
        border-radius: 0 50px 50px 0;
        transition: all 0.3s ease;
    }

    .btn-newsletter:hover {
        background: linear-gradient(135deg, #ff9800 0%, #f57c02 100%);
        transform: translateX(2px);
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding: 1.5rem 0;
        position: relative;
        z-index: 2;
    }

    .copyright {
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
        font-size: 0.9rem;
    }

    .footer-bottom-links {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: flex-end;
        gap: 2rem;
    }

    .footer-bottom-links a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .footer-bottom-links a:hover {
        color: var(--accent-color);
    }

    /* Back to Top Button */
    .back-to-top {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 50px;
        height: 50px;
        background: var(--gradient-2);
        border: none;
        border-radius: 50%;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        z-index: 1000;
        transition: all 0.3s ease;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
    }

    .back-to-top.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .back-to-top:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(245, 124, 2, 0.4);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .footer-main {
            padding: 3rem 0 1.5rem;
        }

        .social-links {
            justify-content: center;
            margin-top: 2rem;
        }

        .footer-bottom-links {
            justify-content: center;
            margin-top: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .copyright {
            text-align: center;
        }

        .back-to-top {
            bottom: 1rem;
            right: 1rem;
            width: 45px;
            height: 45px;
        }
    }

    @media (max-width: 576px) {
        .footer-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .footer-title::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .contact-item {
            justify-content: center;
            text-align: left;
        }

        .newsletter-form .input-group {
            flex-direction: column;
            border-radius: 10px;
        }

        .newsletter-form .form-control,
        .btn-newsletter {
            border-radius: 10px;
            margin-bottom: 0.5rem;
        }
    }
</style>

<script>
    // Back to Top Button Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const backToTopBtn = document.getElementById('backToTop');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });

        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Newsletter Form Submission
        const newsletterForm = document.getElementById('newsletterForm');
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const email = this.querySelector('input[type="email"]').value;

                // Add your newsletter subscription logic here
                console.log('Newsletter subscription for:', email);

                // Show success message (you can replace this with your notification system)
                alert('Thank you for subscribing to our newsletter!');
                this.reset();
            });
        }
    });
</script>