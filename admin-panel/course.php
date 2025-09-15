<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Course Management | Youth Service LTD</title>
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
                    
                    <!-- Create / Edit Course -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create Course</h4>
                                    <form id="form-data" enctype="multipart/form-data">
                                        <input type="hidden" id="course_id" name="course_id">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Name</label>
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter course name" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Price</label>
                                                <input type="number" id="price" name="price" class="form-control" placeholder="Enter price" step="0.01" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Short Description</label>
                                                <input type="text" id="short_description" name="short_description" class="form-control" placeholder="Enter short description">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Queue</label>
                                                <input type="number" id="queue" name="queue" class="form-control" placeholder="Enter display order (queue)">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Staff</label>
                                                <select id="staff_id" name="staff_id" class="form-control">
                                                    <option value="">Select Staff</option>
                                                    <?php
                                                    $STAFF = new Staff(NULL);
                                                    foreach ($STAFF->all() as $staff) {
                                                        echo '<option value="' . $staff['id'] . '">' . htmlspecialchars($staff['name']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Image</label>
                                                <input type="file" id="image_name" name="image_name" class="form-control" accept="image/*" onchange="previewImage(this)">
                                                <div id="image_preview" class="mt-2" style="display: none;">
                                                    <img id="course_image" src="#" alt="Course Image Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                                    <button type="button" class="btn btn-sm btn-danger ms-2" onclick="removeImage()">Remove</button>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label>Description</label>
                                                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter course description"></textarea>
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
                                                <button type="button" class="btn btn-danger delete-course">
                                                    <i class="uil uil-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course List -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Courses</h4>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Short Description</th>
                                                <th>Staff</th>
                                                <th>Queue</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $COURSE = new Course(NULL);
                                            foreach ($COURSE->all() as $key => $course) {
                                                $key++;
                                            ?>
                                                <tr id="div<?php echo $course['id'] ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo htmlspecialchars($course['name']) ?></td>
                                                    <td><?php echo number_format($course['price'], 2) ?></td>
                                                    <td><?php echo htmlspecialchars($course['short_description']) ?></td>
                                                    <td><?php echo htmlspecialchars($course['staff_id']) ?></td>
                                                    <td><?php echo htmlspecialchars($course['queue']) ?></td>
                                                    <td>
                                                        <?php if (!empty($course['image_name'])) { ?>
                                                            <img src="../upload/course/<?php echo htmlspecialchars($course['image_name']) ?>" alt="Course Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <div class="badge bg-pill bg-soft-success font-size-14 select-course"
                                                            data-id="<?php echo $course['id'] ?>"
                                                            data-name="<?php echo htmlspecialchars($course['name']) ?>"
                                                            data-price="<?php echo htmlspecialchars($course['price']) ?>"
                                                            data-short_description="<?php echo htmlspecialchars($course['short_description']) ?>"
                                                            data-description="<?php echo htmlspecialchars($course['description']) ?>"
                                                            data-staff_id="<?php echo htmlspecialchars($course['staff_id']) ?>"
                                                            data-queue="<?php echo htmlspecialchars($course['queue']) ?>"
                                                            data-image_name="<?php echo htmlspecialchars($course['image_name']) ?>">
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
    <script src="ajax/js/course.js"></script>
    <script>
        function previewImage(input) {
            const preview = document.getElementById('image_preview');
            const image = document.getElementById('course_image');

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
