<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Solidrow Engineering</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/contact.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="solidrowengineering.php">
                <img src="assets/images/logo.png" alt="Solidrow Engineering Logo" height="70" class="d-inline-block align-text-top me-2">
                <span>Solidrow Engineering</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="solidrowengineering.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="solidrowengineering.php#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="solidrowengineering.php#projects">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="contact-us.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contact Hero Section -->
    <section class="contact-hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-12 text-center">
                    <h1 class="hero-title" data-aos="fade-up" data-aos-delay="300">
                        Get In <span class="text-accent">Touch</span>
                    </h1>
                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="500">
                        Let's discuss your engineering project and bring your vision to life
                    </p>
                    <div class="scroll-indicator">
                        <div class="scroll-mouse">
                            <div class="scroll-wheel"></div>
                        </div>
                        <p>Scroll Down</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section py-5">
        <div class="container-fluid">
            <div class="row g-0 min-vh-100">
                <!-- Map Section (Left) -->
                <div class="col-lg-6 contact-map-section" data-aos="fade-right">
                    <div class="map-container">
                        <div class="map-header">
                            <h3>Our Location</h3>
                            <p>Visit us at our headquarters</p>
                        </div>

                        <!-- Google Map Embed -->
                        <div class="map-embed">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126743.58703046694!2d79.77749994999999!3d6.9270786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo%2C%20Sri%20Lanka!5e0!3m2!1sen!2slk!4v1699123456789!5m2!1sen!2slk"
                                width="100%"
                                height="400"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                        <!-- Contact Info Cards -->
                        <div class="contact-info-cards">
                            <div class="info-card" data-aos="fade-up" data-aos-delay="200">
                                <div class="info-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div class="info-content">
                                    <h5>Address</h5>
                                    <p>123 Engineering Plaza<br>Colombo 03, Sri Lanka</p>
                                </div>
                            </div>

                            <div class="info-card" data-aos="fade-up" data-aos-delay="300">
                                <div class="info-icon">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                                <div class="info-content">
                                    <h5>Phone</h5>
                                    <p>+94 11 234 5678<br>+94 77 123 4567</p>
                                </div>
                            </div>

                            <div class="info-card" data-aos="fade-up" data-aos-delay="400">
                                <div class="info-icon">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                                <div class="info-content">
                                    <h5>Email</h5>
                                    <p>info@solidrow.com<br>projects@solidrow.com</p>
                                </div>
                            </div>

                            <div class="info-card" data-aos="fade-up" data-aos-delay="500">
                                <div class="info-icon">
                                    <i class="bi bi-clock-fill"></i>
                                </div>
                                <div class="info-content">
                                    <h5>Working Hours</h5>
                                    <p>Mon - Fri: 8:00 AM - 6:00 PM<br>Sat: 9:00 AM - 4:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form Section (Right) -->
                <div class="col-lg-6 contact-form-section" data-aos="fade-left">
                    <div class="form-container">
                        <div class="form-header">
                            <h2>Send Us A Message</h2>
                            <p>Ready to start your project? Get in touch with our engineering experts.</p>
                        </div>

                        <form class="contact-form needs-validation" novalidate id="contactForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                                        <label for="firstName">First Name *</label>
                                        <div class="invalid-feedback">Please provide your first name.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
                                        <label for="lastName">Last Name *</label>
                                        <div class="invalid-feedback">Please provide your last name.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                        <label for="email">Email Address *</label>
                                        <div class="invalid-feedback">Please provide a valid email address.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                                        <label for="phone">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="company" name="company" placeholder="Company Name">
                                        <label for="company">Company Name</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select" id="projectType" name="projectType" required>
                                            <option value="">Select Project Type</option>
                                            <option value="automation">Automation Systems</option>
                                            <option value="robotics">Industrial Robotics</option>
                                            <option value="infrastructure">Infrastructure Development</option>
                                            <option value="renewable">Renewable Energy</option>
                                            <option value="environmental">Environmental Engineering</option>
                                            <option value="consultation">Engineering Consultation</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label for="projectType">Project Type *</label>
                                        <div class="invalid-feedback">Please select a project type.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="message" name="message" placeholder="Your Message" style="height: 150px;" required></textarea>
                                        <label for="message">Project Details / Message *</label>
                                        <div class="invalid-feedback">Please provide project details or your message.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="privacy" name="privacy" required>
                                        <label class="form-check-label" for="privacy">
                                            I agree to the <a href="privacy-policy.php" target="_blank">Privacy Policy</a> and consent to my data being processed. *
                                        </label>
                                        <div class="invalid-feedback">You must agree to the privacy policy.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="bi bi-send me-2"></i>Send Message
                                        <div class="btn-loader d-none">
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Success/Error Messages -->
                        <div class="alert alert-success d-none" id="successMessage">
                            <i class="bi bi-check-circle me-2"></i>
                            Thank you! Your message has been sent successfully. We'll get back to you soon.
                        </div>
                        <div class="alert alert-danger d-none" id="errorMessage">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Sorry, there was an error sending your message. Please try again or contact us directly.
                        </div>

                        <!-- Social Links -->
                        <div class="social-links">
                            <h5>Follow Us</h5>
                            <div class="social-icons">
                                <a href="#" class="social-icon" data-bs-toggle="tooltip" title="Facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="#" class="social-icon" data-bs-toggle="tooltip" title="Twitter">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="#" class="social-icon" data-bs-toggle="tooltip" title="LinkedIn">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                                <a href="#" class="social-icon" data-bs-toggle="tooltip" title="Instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="#" class="social-icon" data-bs-toggle="tooltip" title="YouTube">
                                    <i class="bi bi-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/contact.js"></script>
</body>

</html>