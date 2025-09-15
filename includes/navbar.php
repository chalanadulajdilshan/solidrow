<?php
// You can add any PHP logic here for active menu items, user authentication, etc.
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="assets/images/logo.png" alt="Foreign Agency" height="40">
            <span class="brand-text">Solidrow group pvt ltd</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Contact Info -->
                <div class="d-flex ms-auto align-items-center">
                    <a href="tel:+94112223344" class="nav-link text-white d-flex align-items-center me-3">
                        <i class="bi bi-telephone-fill me-1"></i> +94 112 223344
                    </a>
                    <a href="mailto:info@foreignagency.com" class="nav-link text-white d-flex align-items-center">
                        <i class="bi bi-envelope-fill me-1"></i> info@foreignagency.com
                    </a>
                </div>
            </ul>
        </div>
    </div>
</nav>