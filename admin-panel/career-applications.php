<?php
include '../class/include.php';
include './auth.php';

// Get all applications
$career = new Career();
$applications = $career->all();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Career Applications | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include './assets/main-css.php'; ?>
    <style>
        .cv-preview {
            height: 80vh;
            width: 100%;
            border: none;
        }
        .app-details {
            font-size: 0.9rem;
        }
        .app-details dt {
            width: 120px;
            font-weight: 500;
        }
        .app-details dd {
            margin-left: 140px;
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body class="someBlock">
    <div id="layout-wrapper">
        <?php include './top-header.php'; ?>
        <?php include './navigation.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Career Applications</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Applications List</h4>
                                    <div class="table-responsive">
                                        <table class="table table-centered table-nowrap mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Mobile</th>
                                                    <th>Experience</th>
                                                    <th>Date Applied</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($applications)): ?>
                                                    <?php foreach ($applications as $app): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($app['name']); ?></td>
                                                            <td><?php echo htmlspecialchars($app['position']); ?></td>
                                                            <td><?php echo htmlspecialchars($app['mobile']); ?></td>
                                                            <td><?php echo htmlspecialchars($app['experience']); ?> years</td>
                                                            <td><?php echo date('M d, Y', strtotime($app['created_at'])); ?></td>
                                                            <td>
                                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" 
                                                                        data-bs-target="#applicationModal" 
                                                                        data-id="<?php echo $app['id']; ?>">
                                                                    <i class="fas fa-eye"></i> View
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center">No applications found.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Details Modal -->
    <div class="modal fade" id="applicationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Application Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="applicationDetails">
                    <!-- Content will be loaded via AJAX -->
                    <div class="text-center my-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'assets/main-js.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const applicationModal = document.getElementById('applicationModal');
            
            if (applicationModal) {
                applicationModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const applicationId = button.getAttribute('data-id');
                    const modal = this;
                    
                    // Show loading state
                    const modalBody = modal.querySelector('.modal-body');
                    modalBody.innerHTML = `
                        <div class="text-center my-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>`;
                    
                    // Load application details via AJAX
                    fetch(`ajax/php/get_application_details.php?id=${applicationId}`)
                        .then(response => response.text())
                        .then(html => {
                            modalBody.innerHTML = html;
                            // Update download CV link
                            const cvPath = modalBody.querySelector('[data-cv-path]')?.dataset.cvPath;
                            if (cvPath) {
                                const downloadLink = modal.querySelector('#downloadCv');
                                downloadLink.href = `../upload/careers/${cvPath}`;
                                downloadLink.download = cvPath;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            modalBody.innerHTML = '<div class="alert alert-danger">Error loading application details.</div>';
                        });
                });
                
                // Reset modal content when hidden
                applicationModal.addEventListener('hidden.bs.modal', function() {
                    const modalBody = this.querySelector('.modal-body');
                    modalBody.innerHTML = `
                        <div class="text-center my-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>`;
                });
            }
        });
    </script>
</body>
</html>
