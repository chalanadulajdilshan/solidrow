<?php
// Include configuration and any necessary PHP logic here
$page_title = "Foreign Agency - Your Gateway to Global Opportunities";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- AOS Animation Library -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Hero Slider Section -->
    <section id="hero-slider" class="hero-slider">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="carousel-bg" style="background-image: url('assets/images/hero1.jpg');">
                        <div class="carousel-overlay"></div>
                    </div>
                    <div class="container">
                        <div class="row align-items-center min-vh-100">
                            <div class="col-lg-8">
                                <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
                                    <h1 class="hero-title">Your Gateway to <span class="text-accent">Global Opportunities</span></h1>
                                    <p class="hero-subtitle">Connecting talented professionals with international career opportunities across the globe</p>
                                    <div class="hero-buttons">
                                        <a href="#services" class="btn btn-primary btn-lg me-3">Explore Services</a>
                                        <a href="#contact" class="btn btn-outline-light btn-lg">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="carousel-bg" style="background-image: url('assets/images/hero2.jpg');">
                        <div class="carousel-overlay"></div>
                    </div>
                    <div class="container">
                        <div class="row align-items-center min-vh-100">
                            <div class="col-lg-8">
                                <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
                                    <h1 class="hero-title">Expert <span class="text-accent">Consultation</span> Services</h1>
                                    <p class="hero-subtitle">Professional guidance for visa processing, documentation, and career planning</p>
                                    <div class="hero-buttons">
                                        <a href="#consultation" class="btn btn-primary btn-lg me-3">Book Consultation</a>
                                        <a href="#about" class="btn btn-outline-light btn-lg">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="carousel-bg" style="background-image: url('assets/images/hero3.jpg');">
                        <div class="carousel-overlay"></div>
                    </div>
                    <div class="container">
                        <div class="row align-items-center min-vh-100">
                            <div class="col-lg-8">
                                <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
                                    <h1 class="hero-title">Trusted <span class="text-accent">Partnership</span></h1>
                                    <p class="hero-subtitle">Over a decade of experience in international recruitment and placement services</p>
                                    <div class="hero-buttons">
                                        <a href="#success-stories" class="btn btn-primary btn-lg me-3">Success Stories</a>
                                        <a href="#contact" class="btn btn-outline-light btn-lg">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <!-- Our Websites Section -->
    <section id="our-websites" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title" data-aos="fade-up">Our Digital Presence</h2>
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">
                        Explore our specialized platforms designed to serve your needs
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Website Card 1 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="website-card simple-card">
                        <div class="card-image">
                            <img src="assets/images/website-1.jpg" alt="Solidrow Foreign Engineering Skills Training Institute" class="img-fluid">
                            <div class="card-overlay"></div>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Solidrow Foreign Engineering Skills Training Institute</h3>
                            <a href="https://training.solidrow.com" class="btn btn-view-more" target="_blank">
                                View More <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Website Card 2 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="website-card simple-card">
                        <div class="card-image">
                            <img src="assets/images/website-2.jpg" alt="Solidrow Foreign Employment Agency" class="img-fluid">
                            <div class="card-overlay"></div>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Solidrow Foreign Employment Agency</h3>
                            <a href="https://employment.solidrow.com" class="btn btn-view-more" target="_blank">
                                View More <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Website Card 3 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="website-card simple-card">
                        <div class="card-image">
                            <img src="assets/images/website-3.jpg" alt="Solidrow Visa Consultancy Services" class="img-fluid">
                            <div class="card-overlay"></div>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Solidrow Visa Consultancy Services</h3>
                            <a href="https://visa.solidrow.com" class="btn btn-view-more" target="_blank">
                                View More <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>