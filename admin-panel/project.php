<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Project Management | Youth Service LTD</title>
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
                    <!-- Create Project -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create Project</h4>
                                    <form id="form-data" enctype="multipart/form-data">
                                        <input type="hidden" id="project_id" name="project_id">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Title</label>
                                                <input type="text" id="title" name="title" class="form-control" placeholder="Enter project title" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Short Description</label>
                                                <input type="text" id="short_description" name="short_description" class="form-control" placeholder="Enter short description">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Image</label>
                                                <input type="file" id="image_name" name="image_name" class="form-control" accept="image/*" onchange="previewImage(this)">
                                                <div id="image_preview" class="mt-2" style="display: none;">
                                                    <img id="project_image" src="#" alt="Project Image Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                                    <button type="button" class="btn btn-sm btn-danger ms-2" onclick="removeImage()">Remove</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Project Date</label>
                                                <input type="date" id="project_date" name="project_date" class="form-control">
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
                                                <button type="button" class="btn btn-danger delete-project">
                                                    <i class="uil uil-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Project List -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Projects</h4>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Title</th>
                                                <th>Short Description</th>
                                                <th>Image</th>
                                                <th>Project Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $PROJECT = new Project(NULL);
                                            foreach ($PROJECT->all() as $key => $project) {
                                                $key++;
                                            ?>
                                                <tr id="div<?php echo $project['id'] ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo htmlspecialchars($project['title']) ?></td>
                                                    <td><?php echo htmlspecialchars($project['short_description']) ?></td>
                                                    <td>
                                                        <?php if (!empty($project['image_name'])) { ?>
                                                            <img src="../upload/project/<?php echo htmlspecialchars($project['image_name']) ?>" alt="Project Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($project['project_date']) ?></td>
                                                    <td>
                                                        <div class="badge bg-pill bg-soft-success font-size-14 select-project"
                                                            data-id="<?php echo $project['id'] ?>"
                                                            data-title="<?php echo htmlspecialchars($project['title']) ?>"
                                                            data-short_description="<?php echo htmlspecialchars($project['short_description']) ?>"
                                                            data-image_name="<?php echo htmlspecialchars($project['image_name']) ?>"
                                                            data-project_date="<?php echo htmlspecialchars($project['project_date']) ?>">
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
    <script src="ajax/js/project.js"></script>
    <script>
        function previewImage(input) {
            const preview = document.getElementById('image_preview');
            const image = document.getElementById('project_image');

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
            const input = document.getElementById('image_name');
            const preview = document.getElementById('image_preview');
            input.value = '';
            preview.style.display = 'none';
        }
    </script>
</body>
</html>
