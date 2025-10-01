<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solidrow Engineering - Leading Engineering Solutions</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#home">
                <img src="../assets/images/Solidrow Engineering Logo.png" alt="Solidrow Engineering Logo" height="40" class="me-2">
                SOLIDROW ENGINEERING
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about-us">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#projects">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact-us.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Slider -->
    <section id="home" class="hero-section">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
            </div>
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="hero-slide slide-1">
                        <div class="hero-overlay"></div>
                        <div class="container">
                            <div class="row align-items-center min-vh-100">
                                <div class="col-lg-8">
                                    <h1 class="hero-title" data-aos="fade-up" data-aos-delay="300">
                                        Engineering Excellence
                                        <span class="text-accent">Redefined</span>
                                    </h1>
                                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="500">
                                        Leading the future of engineering with innovative solutions and cutting-edge technology
                                    </p>
                                    <div class="hero-buttons" data-aos="fade-up" data-aos-delay="700">
                                        <a href="#projects" class="btn btn-primary btn-lg me-3">
                                            <i class="bi bi-arrow-right me-2"></i>Our Projects
                                        </a>
                                        <a href="#about" class="btn btn-outline-light btn-lg">
                                            Learn More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="hero-slide slide-2">
                        <div class="hero-overlay"></div>
                        <div class="container">
                            <div class="row align-items-center min-vh-100">
                                <div class="col-lg-8">
                                    <h1 class="hero-title" data-aos="fade-up" data-aos-delay="300">
                                        Innovative
                                        <span class="text-accent">Solutions</span>
                                    </h1>
                                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="500">
                                        Transforming ideas into reality with precision engineering and creative problem-solving
                                    </p>
                                    <div class="hero-buttons" data-aos="fade-up" data-aos-delay="700">
                                        <a href="#services" class="btn btn-primary btn-lg me-3">
                                            <i class="bi bi-gear me-2"></i>Our Services
                                        </a>
                                        <a href="#contact" class="btn btn-outline-light btn-lg">
                                            Get Started
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="hero-slide slide-3">
                        <div class="hero-overlay"></div>
                        <div class="container">
                            <div class="row align-items-center min-vh-100">
                                <div class="col-lg-8">
                                    <h1 class="hero-title" data-aos="fade-up" data-aos-delay="300">
                                        Building the
                                        <span class="text-accent">Future</span>
                                    </h1>
                                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="500">
                                        Your trusted partner in engineering excellence and sustainable development
                                    </p>
                                    <div class="hero-buttons" data-aos="fade-up" data-aos-delay="700">
                                        <a href="#projects" class="btn btn-primary btn-lg me-3">
                                            <i class="bi bi-building me-2"></i>View Portfolio
                                        </a>
                                        <a href="#about" class="btn btn-outline-light btn-lg">
                                            About Us
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="carousel-item">
                    <div class="hero-slide slide-4">
                        <div class="hero-overlay"></div>
                        <div class="container">
                            <div class="row align-items-center min-vh-100">
                                <div class="col-lg-8">
                                    <h1 class="hero-title" data-aos="fade-up" data-aos-delay="300">
                                        Trusted
                                        <span class="text-accent">Partnership</span>
                                    </h1>
                                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="500">
                                        Delivering exceptional engineering solutions with reliability, innovation, and commitment to excellence
                                    </p>
                                    <div class="hero-buttons" data-aos="fade-up" data-aos-delay="700">
                                        <a href="#contact" class="btn btn-primary btn-lg me-3">
                                            <i class="bi bi-handshake me-2"></i>Partner With Us
                                        </a>
                                        <a href="#services" class="btn btn-outline-light btn-lg">
                                            Our Expertise
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <!-- Company Websites Section -->
    <section id="websites" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="section-title" data-aos="fade-up">Our Network</h2>
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">
                        Explore our affiliated websites and services
                    </p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="website-card">
                        <div class="website-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <h5>Solidrow Main</h5>
                        <p>Our main corporate website</p>
                        <a href="https://solidrow.com" class="btn btn-outline-primary btn-sm">
                            Visit Site <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="website-card">
                        <div class="website-icon">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h5>FESTI Training</h5>
                        <p>Vocational training programs</p>
                        <a href="https://festi.lk" class="btn btn-outline-primary btn-sm">
                            Visit Site <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="website-card">
                        <div class="website-icon">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h5>Engineering Hub</h5>
                        <p>Technical resources & tools</p>
                        <a href="https://hub.solidrow.com" class="btn btn-outline-primary btn-sm">
                            Visit Site <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="website-card">
                        <div class="website-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h5>Careers Portal</h5>
                        <p>Join our engineering team</p>
                        <a href="https://careers.solidrow.com" class="btn btn-outline-primary btn-sm">
                            Visit Site <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="section-title" data-aos="fade-up">Featured Projects</h2>
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">
                        Showcasing our engineering excellence and innovation
                    </p>
                </div>
            </div>

            <!-- Projects Slider -->
            <div class="projects-slider-container" data-aos="fade-up" data-aos-delay="300">
                <div class="projects-slider-wrapper">
                    <div class="projects-slider" id="projectsSlider">
                        <div class="project-slide">
                            <div class="project-card">
                                <div class="project-image">
                                    <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Smart Building System" class="img-fluid">
                                    <div class="project-overlay">
                                        <a href="project-detail.php?id=1" class="btn btn-light">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="project-content">
                                    <span class="project-category">Automation</span>
                                    <h5>Smart Building System</h5>
                                    <p>IoT-enabled building management system with advanced automation and energy efficiency features.</p>
                                </div>
                            </div>
                        </div>

                        <div class="project-slide">
                            <div class="project-card">
                                <div class="project-image">
                                    <img src="https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Industrial Robotics" class="img-fluid">
                                    <div class="project-overlay">
                                        <a href="project-detail.php?id=2" class="btn btn-light">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="project-content">
                                    <span class="project-category">Robotics</span>
                                    <h5>Industrial Robotics</h5>
                                    <p>Custom robotic solutions for manufacturing processes with precision control and safety systems.</p>
                                </div>
                            </div>
                        </div>

                        <div class="project-slide">
                            <div class="project-card">
                                <div class="project-image">
                                    <img src="https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bridge Construction" class="img-fluid">
                                    <div class="project-overlay">
                                        <a href="project-detail.php?id=3" class="btn btn-light">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="project-content">
                                    <span class="project-category">Infrastructure</span>
                                    <h5>Bridge Construction</h5>
                                    <p>Modern bridge design and construction with innovative materials and sustainable practices.</p>
                                </div>
                            </div>
                        </div>

                        <div class="project-slide">
                            <div class="project-card">
                                <div class="project-image">
                                    <img src="https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Solar Power Plant" class="img-fluid">
                                    <div class="project-overlay">
                                        <a href="project-detail.php?id=4" class="btn btn-light">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="project-content">
                                    <span class="project-category">Renewable Energy</span>
                                    <h5>Solar Power Plant</h5>
                                    <p>Large-scale solar energy installation with smart grid integration and monitoring systems.</p>
                                </div>
                            </div>
                        </div>

                        <div class="project-slide">
                            <div class="project-card">
                                <div class="project-image">
                                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Water Treatment Plant" class="img-fluid">
                                    <div class="project-overlay">
                                        <a href="project-detail.php?id=5" class="btn btn-light">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="project-content">
                                    <span class="project-category">Environmental</span>
                                    <h5>Water Treatment Plant</h5>
                                    <p>Advanced water purification system with eco-friendly technology and sustainable operations.</p>
                                </div>
                            </div>
                        </div>

                        <div class="project-slide">
                            <div class="project-card">
                                <div class="project-image">
                                    <img src="https://images.unsplash.com/photo-1565374781-2bc55dafe5c9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Wind Energy Farm" class="img-fluid">
                                    <div class="project-overlay">
                                        <a href="project-detail.php?id=6" class="btn btn-light">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="project-content">
                                    <span class="project-category">Renewable Energy</span>
                                    <h5>Wind Energy Farm</h5>
                                    <p>Large-scale wind turbine installation with smart grid integration and monitoring systems.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slider Navigation -->
                <div class="projects-nav">
                    <button class="projects-prev" id="projectsPrev">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button class="projects-next" id="projectsNext">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>

                <!-- Slider Indicators -->
                <div class="projects-indicators" id="projectsIndicators">
                    <span class="indicator active" data-slide="0"></span>
                    <span class="indicator" data-slide="1"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about-us" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title" data-aos="fade-up">About Us</h2>
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">
                        Leading the way in foreign employment and vocational training
                    </p>
                </div>
            </div>

            <div class="row align-items-center mb-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="about-content">
                        <div class="about-intro">
                            <h3 class="about-heading">Welcome To All Solidrow Engineering</h3>
                            <p class="about-description" style="text-align: justify;">
                                <strong>SOLIDROW ENGINEERING</strong> delivers innovative and reliable engineering solutions across civil, mechanical, and electrical sectors. We specialize in designing, developing, and executing projects with a strong emphasis on quality, safety, and sustainability. With a team of skilled professionals and modern technology, we ensure that every project meets international standards while remaining cost-effective and efficient.
                            </p>
                            <p class="about-description" style="text-align: justify; margin-bottom: 10px;">
                                <strong>Core Expertise:</strong>
                            </p>
                            <ul class="mission-list" style="list-style-type: none; padding-left: 0; margin-top: 10px;">
                                <li><i class="fas fa-check-circle text-primary me-2"></i>Civil construction and infrastructure development</li>
                                <li><i class="fas fa-check-circle text-primary me-2"></i>Mechanical and electrical engineering services</li>
                                <li><i class="fas fa-check-circle text-primary me-2"></i>Project design, consultancy, and management</li>
                                <li><i class="fas fa-check-circle text-primary me-2"></i>Customized industrial solutions</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="about-image-container">
                        <div class="about-image">
                            <img src="../assets/images/Engineering-about.jpg" alt="Solidrow Engineering" class="img-fluid rounded-3">
                            <div class="image-decoration"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vision, Mission, Goal Cards -->
            <div class="row g-4">
                <!-- Our Vision -->
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="about-card vision-card">
                        <div class="card-icon-wrapper">
                            <div class="card-icon vision-icon">
                                <i class="fas fa-eye"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Our Vision</h4>
                            <p class="card-text">
                                To be a leading engineering solutions provider, driving innovation, quality, and sustainability in every project we undertake and build long-term partnerships with clients by providing engineering excellence that drives progress and supports economic development.</p>
                        </div>
                        <div class="card-decoration vision-decoration"></div>
                    </div>
                </div>

                <!-- Our Mission -->
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="about-card mission-card">
                        <div class="card-icon-wrapper">
                            <div class="card-icon mission-icon">
                                <i class="fas fa-bullseye"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Our Mission</h4>
                            <ul class="mission-list" style="list-style-type: none; padding-left: 0; margin-top: 10px;">
                                <li><i class="fas fa-check-circle text-primary me-2"></i>To deliver high-quality engineering services that meet international standards and exceed client expectations.</li>
                                <li><i class="fas fa-check-circle text-primary me-2"></i>To embrace innovation, technology, and sustainable practices in engineering solutions.</li>
                                <li><i class="fas fa-check-circle text-primary me-2"></i>To cultivate a skilled workforce committed to safety, precision, and continuous improvement.</li>
                                <li><i class="fas fa-check-circle text-primary me-2"></i>To contribute to national and global development by providing reliable and cost-effective engineering solutions.</li>
                            </ul>
                        </div>
                        <div class="card-decoration mission-decoration"></div>
                    </div>
                </div>


                <!-- Additional Features Row -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="features-container" data-aos="fade-up">
                            <div class="row g-4">
                                <div class="col-lg-3 col-sm-6">
                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-certificate"></i>
                                        </div>
                                        <h5>Accredited Institute</h5>
                                        <p>Recognized by TVEC Sri Lanka</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <h5>Expert Instructors</h5>
                                        <p>Industry experienced trainers</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-globe"></i>
                                        </div>
                                        <h5>Global Opportunities</h5>
                                        <p>Connect with international employers</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-handshake"></i>
                                        </div>
                                        <h5>24/7 Support</h5>
                                        <p>Continuous guidance and assistance</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <img src="../assets/images/Solidrow Engineering Logo.png" alt="FESTI" height="70" class="me-2">
                            <h5 class="widget-title">SOLIDROW FOREIGN EMPLOYMENT</h5>
                        </div>
                        <p>Empowering individuals with essential skills and knowledge required to succeed in foreign employment opportunities.</p>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h5 class="widget-title">Quick Links</h5>
                        <ul class="footer-links">
                            <li><a href="#home">Home</a></li>
                            <li><a href="#about-us">About Us</a></li>
                            <li><a href="#courses">Courses</a></li>
                            <li><a href="#gallery">Gallery</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h5 class="widget-title">Projects</h5>
                        <ul class="footer-links">
                            <li><a href="#courses">Building & Infrastructure Projects</a></li>
                            <li><a href="#courses">Civil Engineering Projects</a></li>
                            <li><a href="#courses">Specialized Projects</a></li>
                            <li><a href="#courses">Long-term Development Projects</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h5 class="widget-title">Contact Info</h5>
                        <div class="contact-info">
                            <p><i class="fas fa-map-marker-alt"></i>
                                12/87 Kelanimulla,
                                <br> Mulleriyawa New Town,
                                <br> 10620,
                                <br> Sri Lanka
                            </p>
                            <p><i class="fas fa-phone"></i> 011 436 4644 <br>
                                0776111115</p>
                            <p><i class="fas fa-envelope"></i> engineering@solidrow.lk</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">&copy; 2023 SOLIDROW FESTI (PVT) LTD. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0">Accredited by TVEC | Registration: P01/1060</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
</body>

</html>