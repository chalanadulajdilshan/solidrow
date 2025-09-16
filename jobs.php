<?php
include 'class/include.php';
$JOB_LISTING = new JobListing();
$jobs = $JOB_LISTING->getActiveJobs(); // Get active job listings
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Openings - Solidrow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/solidrow/assets/css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 80px;
            background-color: #f8f9fa;
        }

        .job-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
            height: 100%;
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .job-header {
            background-color: #f8f9fa;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .job-title {
            color: #2c3e50;
            font-weight: 600;
        }

        .job-location,
        .job-type {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .job-description {
            padding: 15px;
            color: #34495e;
        }

        .apply-btn {
            margin: 15px;
            width: calc(100% - 30px);
        }

        .no-jobs {
            text-align: center;
            padding: 50px 0;
            color: #7f8c8d;
        }
    </style>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <main class="main-content">
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h1 class="display-5 fw-bold">Current Job Openings</h1>
                    <p class="lead">Join our team and grow your career with us</p>
                </div>

                <div class="row">
                    <?php if (!empty($jobs)): ?>
                        <?php foreach ($jobs as $job): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card job-card h-100">
                                    <?php if (!empty($job['image'])): ?>
                                        <img src="upload/joblisting/<?php echo htmlspecialchars($job['image']); ?>" 
                                            class="card-img-top" 
                                            alt="<?php echo htmlspecialchars($job['name']); ?>"
                                            style="height: 180px; object-fit: cover; cursor: pointer;"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#imageModal"
                                            data-image="upload/joblisting/<?php echo htmlspecialchars($job['image']); ?>"
                                            data-title="<?php echo htmlspecialchars($job['name']); ?>">
                                    <?php endif; ?>
                                    <div class="job-header">
                                        <h5 class="job-title"><?php echo htmlspecialchars($job['name']); ?></h5>
                                        <?php if (!empty($job['position'])): ?>
                                            <h6 class="text-primary mb-2"><?php echo htmlspecialchars($job['position']); ?></h6>
                                        <?php endif; ?>
                                        <div class="d-flex justify-content-between">
                                            <span class="job-location">
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                <?php echo 'Colombo, Sri Lanka'; ?>
                                            </span>
                                            <span class="job-type">
                                                <i class="fas fa-briefcase me-1"></i>
                                                <?php echo !empty($job['job_type']) ? htmlspecialchars($job['job_type']) : 'Full-time'; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="job-description">
                                        <?php
                                        $description = $job['description'] ?? 'No description available.';
                                        echo strlen($description) > 150 ?
                                            substr($description, 0, 150) . '...' :
                                            $description;
                                        ?>
                                    </div>
                                    <div class="mt-auto">
                                        <a href="careers.php?position=<?php echo urlencode($job['position']); ?>"
                                            class="btn btn-primary apply-btn">
                                            Apply Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="no-jobs">
                                <i class="fas fa-briefcase fa-3x mb-3"></i>
                                <h3>No job openings at the moment</h3>
                                <p>Please check back later for new opportunities.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="" class="img-fluid" id="modalImage">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageModal = document.getElementById('imageModal');
            if (imageModal) {
                imageModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const imageUrl = button.getAttribute('data-image');
                    const imageTitle = button.getAttribute('data-title');
                    
                    const modalTitle = imageModal.querySelector('.modal-title');
                    const modalImage = imageModal.querySelector('#modalImage');
                    
                    modalTitle.textContent = imageTitle;
                    modalImage.src = imageUrl;
                    modalImage.alt = imageTitle;
                });
            }
        });
    </script>
</body>

</html>