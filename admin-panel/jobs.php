<?php
include '../class/include.php';
include './auth.php';

$id = $_GET['id'] ?? NULL;

$country = new Country($id);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Job Management | Youth Service LTD</title>
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
                                    <h4 class="card-title">Create Job</h4>
                                    <form id="form-data" enctype="multipart/form-data">
                                        <input type="hidden" id="job_id" name="job_id">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label>Title</label>
                                                <input type="text" id="title" name="title" class="form-control" placeholder="Enter job title" required>
                                            </div>
                                   
                                        <div class="col-md-4 mb-3">
                                            <label>Country</label>
                                            <select id="country" name="country" class="form-control" required>
                                                <option value="">Select Country</option>
                                                <?php
                                                $COUNTRY = new Country(NULL);
                                                foreach ($COUNTRY->all() as $key => $country) {
                                                    if ($country['id'] == $id) {
                                                        echo "<option value=\"{$country['id']}\" selected>{$country['name']}</option>";
                                                    } else {
                                                        echo "<option value=\"{$country['id']}\">{$country['name']}</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                            <div class="col-md-4 mb-3">
                                                <label>Position</label>
                                                <input type="text" id="position" name="position" class="form-control" placeholder="Enter position" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label>Description</label>
                                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter job description"></textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Image</label>
                                                <input type="file" id="image" name="image" class="form-control" accept="image/*" onchange="previewImage(this)">
                                                <div id="image_preview" class="mt-2" style="display: none;">
                                                    <img id="job_image" src="#" alt="Job Image Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                                    <button type="button" class="btn btn-sm btn-danger ms-2" onclick="removeImage()">Remove</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Responsible Person</label>
                                                <select id="respons_person" name="respons_person" class="form-control" required>
                                                    <option value="">Select Responsible Person</option>
                                                    <?php
                                                    $STAFF = new Staff(NULL);
                                                    foreach ($STAFF->all() as $staff) {
                                                        echo '<option value="' . htmlspecialchars($staff['id']) . '">' . htmlspecialchars($staff['name']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
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
                                                <th>Position</th>
                                                <th>Description</th>
                                                <th>Country</th>
                                                <th>Image</th>
                                                <th>Responsible Person</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $JOB = new Job(NULL);
                                            foreach ($JOB->all() as $key => $job) {
                                                $key++;
                                                // Get Staff name for display
                                                $STAFF_OBJ = new Staff($job['respons_person']);
                                                $responsibleName = $STAFF_OBJ->name ?? 'N/A';
                                            ?>
                                                <tr id="div<?php echo $job['id'] ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo htmlspecialchars($job['title']) ?></td>
                                                    <td><?php echo htmlspecialchars($job['position']) ?></td>
                                                    <td><?php echo htmlspecialchars($job['description']) ?></td>
                                                    <td><?php 
                                                        $country = new Country($job['country']);
                                                        echo htmlspecialchars($country->name ?? 'N/A'); 
                                                    ?></td>
                                                    <td>
                                                        <?php if (!empty($job['image'])) { ?>
                                                            <img src="../upload/job/<?php echo htmlspecialchars($job['image']) ?>" alt="Job Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($responsibleName) ?></td>
                                                    <td>
                                                        <div class="badge bg-pill bg-soft-success font-size-14 select-job"
                                                            data-id="<?php echo $job['id'] ?>"
                                                            data-title="<?php echo htmlspecialchars($job['title']) ?>"
                                                            data-position="<?php echo htmlspecialchars($job['position']) ?>"
                                                            data-description="<?php echo htmlspecialchars($job['description']) ?>"
                                                            data-country="<?php echo htmlspecialchars($job['country']) ?>"
                                                            data-image="<?php echo htmlspecialchars($job['image']) ?>"
                                                            data-respons_person="<?php echo htmlspecialchars($job['respons_person']) ?>">
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
    <script src="ajax/js/jobs.js"></script>
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
