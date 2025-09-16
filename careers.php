<?php
include 'class/include.php';
$JOB = new Job();
$positions = $JOB->getPositions();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers - Solidrow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/solidrow/assets/css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Add padding to body to prevent content from being hidden behind fixed navbar */
        body {
            padding-top: 80px;
        }
        
        /* Adjust padding for mobile */
        @media (max-width: 991.98px) {
            body {
                padding-top: 60px;
            }
        }
    </style>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <main class="main-content">
    <!-- Career Form Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h3 class="mb-0">Apply Now</h3>
                        </div>
                        <div class="card-body">
                            <form id="career-form" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="mobile" name="mobile" required>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                                    <?php 
                                    $selectedPosition = isset($_GET['position']) ? htmlspecialchars(urldecode($_GET['position'])) : '';
                                    $isPositionLocked = !empty($selectedPosition);
                                    ?>
                                    <?php if ($isPositionLocked): ?>
                                        <input type="hidden" id="position" name="position" value="<?php echo $selectedPosition; ?>">
                                        <input type="text" class="form-control" value="<?php echo $selectedPosition; ?>" disabled>
                                        <small class="text-muted">This field is locked because you applied from a specific job posting.</small>
                                    <?php else: ?>
                                        <select class="form-select" id="position" name="position" required>
                                            <option value="">Select Position</option>
                                            <?php foreach ($positions as $position): ?>
                                                <option value="<?php echo htmlspecialchars($position); ?>">
                                                    <?php echo htmlspecialchars($position); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label for="experience" class="form-label">Experience <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="experience" name="experience" placeholder="e.g., 2 years in web development" required>
                                </div>

                                <div class="mb-4">
                                    <label for="cv" class="form-label">Upload CV (PDF, DOC, DOCX) <span class="text-danger">*</span></label>
                                    <input class="form-control" type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
                                    <div class="form-text">Max file size: 5MB</div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">Submit Application</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    </main>
    
    <?php include 'includes/footer.php'; ?>

    <!-- Required Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.preloader/1.1.0/jquery.preloader.min.js"></script>
    <script src="/solidrow/ajax/js/careers.js"></script>
</body>

</html>