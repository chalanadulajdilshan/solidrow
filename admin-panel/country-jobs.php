<?php
include '../class/include.php';
include './auth.php';

$country_id = $_GET['id'] ?? null;

if (!$country_id) {
    header('Location: countries.php');
    exit();
}

$COUNTRY = new Country($country_id);
$COUNTRY_JOB = new CountryJob();
$country_jobs = $COUNTRY_JOB->getByCountry($country_id);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Country Jobs Management | <?php echo $COUNTRY->name; ?> | Solidrow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include './assets/main-css.php'; ?>
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
                                <h4 class="mb-0"><?php echo htmlspecialchars($COUNTRY->name); ?> - Job Positions</h4>
                                <div class="page-title-right">
                                    <a href="countries.php" class="btn btn-secondary">
                                        <i class="mdi mdi-arrow-left me-1"></i> Back to Countries
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Create/Edit Form -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add/Edit Job Position</h4>
                                    <form id="form-data" enctype="multipart/form-data">
                                        <input type="hidden" id="job_id" name="job_id">
                                        <input type="hidden" id="country_id" name="country_id" value="<?php echo $country_id; ?>">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Job Position Name <span class="text-danger">*</span></label>
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter job position name" required>
                                            </div>
                                            <div class="col-md-6 mb-3 d-flex align-items-end">
                                                <div>
                                                    <button type="submit" id="create" class="btn btn-primary">
                                                        <i class="mdi mdi-plus"></i> Add Job Position
                                                    </button>
                                                    <button type="submit" id="update" class="btn btn-success" style="display: none;">
                                                        <i class="mdi mdi-check"></i> Update
                                                    </button>
                                                    <button type="button" id="cancel" class="btn btn-secondary" style="display: none;">
                                                        <i class="mdi mdi-close"></i> Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Positions List -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Job Positions List</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Job Position</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="jobs-list">
                                                <?php if (!empty($country_jobs)): ?>
                                                    <?php $count = 1; ?>
                                                    <?php foreach ($country_jobs as $job): ?>
                                                        <tr id="job-<?php echo $job['id']; ?>">
                                                            <td><?php echo $count++; ?></td>
                                                            <td><?php echo htmlspecialchars($job['name']); ?></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-warning edit-job" 
                                                                        data-id="<?php echo $job['id']; ?>"
                                                                        data-name="<?php echo htmlspecialchars($job['name']); ?>">
                                                                    <i class="mdi mdi-pencil"></i> Edit
                                                                </button>
                                                                <button class="btn btn-sm btn-danger delete-job" 
                                                                        data-id="<?php echo $job['id']; ?>">
                                                                    <i class="mdi mdi-delete"></i> Delete
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr id="no-jobs-row">
                                                        <td colspan="3" class="text-center">
                                                            <div class="alert alert-info">
                                                                <h5>No job positions found for this country.</h5>
                                                                <button class="btn btn-primary mt-2" id="add-first-job">
                                                                    <i class="mdi mdi-plus"></i> Add First Job Position
                                                                </button>
                                                            </div>
                                                        </td>
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

    <?php include './assets/main-js.php'; ?>
    <script>
        $(document).ready(function() {
            // Show message if no jobs found
            <?php if (empty($country_jobs)): ?>
            Swal.fire({
                title: 'No Job Positions',
                text: 'No job positions found for this country. Would you like to add the first one?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes, add first job',
                cancelButtonText: 'Not now',
                confirmButtonColor: '#34c38f',
                cancelButtonColor: '#f46a6a'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('html, body').animate({
                        scrollTop: $("#form-data").offset().top - 100
                    }, 500);
                    $('#name').focus();
                }
            });
            <?php endif; ?>
            
            // Handle add first job button click
            $(document).on('click', '#add-first-job', function() {
                $('html, body').animate({
                    scrollTop: $("#form-data").offset().top - 100
                }, 500);
                $('#name').focus();
            });
            // Handle form submission
            $('#form-data').on('submit', function(e) {
                e.preventDefault();
                
                if ($('#update').is(':visible')) {
                    updateJob();
                } else {
                    createJob();
                }
            });

            // Handle edit button click
            $(document).on('click', '.edit-job', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                
                $('#job_id').val(id);
                $('#name').val(name);
                
                $('#create').hide();
                $('#update, #cancel').show();
                
                // Scroll to form
                $('html, body').animate({
                    scrollTop: $("#form-data").offset().top - 100
                }, 500);
            });

            // Handle cancel button click
            $('#cancel').on('click', function() {
                resetForm();
            });

            // Handle delete button click
            $(document).on('click', '.delete-job', function() {
                const id = $(this).data('id');
                
                if (confirm('Are you sure you want to delete this job position?')) {
                    $.ajax({
                        url: 'ajax/php/country-job.php',
                        type: 'POST',
                        data: {
                            delete: true,
                            id: id
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                $(`#job-${id}`).remove();
                                showSuccess('Job position deleted successfully');
                                
                                // Reload the page if no jobs left
                                if ($('#jobs-list tr').length === 1) {
                                    setTimeout(() => location.reload(), 1000);
                                }
                            } else {
                                showError(response.message || 'Failed to delete job position');
                            }
                        },
                        error: function() {
                            showError('An error occurred while deleting the job position');
                        }
                    });
                }
            });

            // Function to create a new job
            function createJob() {
                const formData = new FormData($('#form-data')[0]);
                formData.append('create', true);

                $.ajax({
                    url: 'ajax/php/country-job.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Add new job to the list
                            const newRow = `
                                <tr id="job-${response.id}">
                                    <td>${$('#jobs-list tr').length + 1}</td>
                                    <td>${$('#name').val()}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning edit-job" 
                                                data-id="${response.id}"
                                                data-name="${$('#name').val()}">
                                            <i class="mdi mdi-pencil"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-job" 
                                                data-id="${response.id}">
                                            <i class="mdi mdi-delete"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            `;
                            
                            if ($('#jobs-list tr:first-child').hasClass('no-data')) {
                                $('#jobs-list').html(newRow);
                            } else {
                                $('#jobs-list').append(newRow);
                            }
                            
                            resetForm();
                            showSuccess('Job position added successfully');
                        } else {
                            showError(response.message || 'Failed to add job position');
                        }
                    },
                    error: function() {
                        showError('An error occurred while adding the job position');
                    }
                });
            }

            // Function to update a job
            function updateJob() {
                const formData = new FormData($('#form-data')[0]);
                formData.append('update', true);

                $.ajax({
                    url: 'ajax/php/country-job.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Update the job in the list
                            const id = $('#job_id').val();
                            $(`#job-${id} td:nth-child(2)`).text($('#name').val());
                            $(`#job-${id} .edit-job`).data('name', $('#name').val());
                            
                            resetForm();
                            showSuccess('Job position updated successfully');
                        } else {
                            showError(response.message || 'Failed to update job position');
                        }
                    },
                    error: function() {
                        showError('An error occurred while updating the job position');
                    }
                });
            }

            // Function to reset the form
            function resetForm() {
                $('#form-data')[0].reset();
                $('#job_id').val('');
                $('#create').show();
                $('#update, #cancel').hide();
            }

            // Function to show success message
            function showSuccess(message) {
                Swal.fire({
                    title: 'Success!',
                    text: message,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            }

            // Function to show error message
            function showError(message) {
                Swal.fire({
                    title: 'Error!',
                    text: message,
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    </script>
</body>
</html>
