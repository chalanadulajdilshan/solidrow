<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Job Listings Management | Your Site Name</title>
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
                    <!-- Create/Edit Form -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add/Edit Job Listing</h4>
                                    <form id="form-data" enctype="multipart/form-data">
                                        <input type="hidden" id="job_id" name="job_id">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Job Title</label>
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter job title" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Position</label>
                                                <input type="text" id="position" name="position" class="form-control" placeholder="Enter position" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label>Description</label>
                                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter job description" required></textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                                                    <label class="form-check-label" for="is_active">Active</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Image</label>
                                                <input type="file" id="image" name="image" class="form-control" accept="image/*" onchange="previewImage(this)">
                                                <div id="image_preview" class="mt-2" style="display: none;">
                                                    <img id="job_image" src="#" alt="Job Image Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                                    <button type="button" class="btn btn-sm btn-danger ms-2" onclick="removeImage()">Remove</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="button" id="create" class="btn btn-primary">Create</button>
                                                <button type="button" id="update" class="btn btn-success" style="display: none;">Update</button>
                                                <button type="button" id="new" class="btn btn-secondary">New</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Listings Table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Job Listings</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Job Title</th>
                                                    <th>Position</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $JOB = new JobListing();
                                                $jobs = $JOB->all();
                                                foreach ($jobs as $key => $job) {
                                                    $status = $job['is_active'] ? 'Active' : 'Inactive';
                                                    $statusClass = $job['is_active'] ? 'success' : 'danger';
                                                    $image = $job['image'] ? '../upload/joblisting/' . $job['image'] : '../assets/images/no-image.jpg';
                                                ?>
                                                    <tr class="select-job" data-id="<?php echo $job['id']; ?>"
                                                        data-name="<?php echo htmlspecialchars($job['name']); ?>"
                                                        data-position="<?php echo htmlspecialchars($job['position']); ?>"
                                                        data-description="<?php echo htmlspecialchars($job['description']); ?>"
                                                        data-image="<?php echo $job['image']; ?>"
                                                        data-is_active="<?php echo $job['is_active']; ?>">
                                                        <td><?php echo $key + 1; ?></td>
                                                        <td><img src="<?php echo $image; ?>" alt="Job Image" style="width: 50px; height: 50px; object-fit: cover;"></td>
                                                        <td><?php echo $job['name']; ?></td>
                                                        <td><?php echo $job['position']; ?></td>
                                                        <td><span class="badge bg-<?php echo $statusClass; ?>"><?php echo $status; ?></span></td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary btn-sm edit-job" data-id="<?php echo $job['id']; ?>">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm delete-job" data-id="<?php echo $job['id']; ?>">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-<?php echo $job['is_active'] ? 'warning' : 'success'; ?> btn-sm toggle-status"
                                                                data-id="<?php echo $job['id']; ?>"
                                                                data-status="<?php echo $job['is_active']; ?>">
                                                                <i class="fas fa-<?php echo $job['is_active'] ? 'times' : 'check'; ?>"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
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


    <?php include 'assets/main-js.php'; ?>
    <script src="ajax/js/job-listings.js"></script>
</body>

</html>