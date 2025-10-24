<?php
include '../class/include.php';
include './auth.php';

 
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title> Job  Management | Youth Service LTD</title>
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
                    <!-- Create Job -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create Job Role  </h4>
                                    <form id="form-data" enctype="multipart/form-data">
                                        <input type="hidden" id="job_id" name="job_id">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label>Title</label>
                                                <input type="text" id="title" name="title" class="form-control" placeholder="Enter job title" required>
                                            </div>
                                   
                                         
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-end">
                                                <button type="button" class="btn btn-primary" id="create">
                                                    <i class="uil uil-save me-1"></i> Save
                                                </button>
                                                <button type="button" class="btn btn-warning" id="update" style="display: none;">
                                                    <i class="uil uil-save me-1"></i> Update
                                                </button>
                                                <button type="button" class="btn btn-secondary" id="new">
                                                    <i class="uil uil-plus me-1"></i> New
                                                </button>
                                                <button type="button" class="btn btn-danger delete-job">
                                                    <i class="uil uil-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job List -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Jobs</h4>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Title</th> 
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $JOB_ROLE = new JobRole(NULL);
                                            foreach ($JOB_ROLE->all() as $key => $job) {
                                                $key++;
                                            
                                            ?>
                                                <tr id="div<?php echo $job['id'] ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo htmlspecialchars($job['name']) ?></td>
                                                     
                                                    <td>
                                                        <div class="badge bg-pill bg-soft-success font-size-14 select-job"
                                                            data-id="<?php echo $job['id'] ?>"
                                                            data-title="<?php echo htmlspecialchars($job['name']) ?>" >
                                                            <i class="fas fa-pencil-alt p-1"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
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
    <div class="rightbar-overlay"></div>
    <?php include 'assets/main-js.php'; ?>
    <script src="ajax/js/job-role.js"></script>
    <script>
        function previewImage(input) {
            const preview = document.getElementById('image_preview');
            const image = document.getElementById('job_image');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    image.src = e.target.result;
                    preview.style.display = 'flex';
                    preview.style.alignItems = 'center';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            const input = document.getElementById('image');
            const preview = document.getElementById('image_preview');
            input.value = '';
            preview.style.display = 'none';
        }
    </script>
</body>
</html>
