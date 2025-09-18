<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Staff Management | Youth Service LTD</title>
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

                    <!-- Create Staff -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create Staff</h4>
                                    <form id="form-data" enctype="multipart/form-data">
                                        <input type="hidden" id="staff_id" name="staff_id">
                                        <div class="row">

                                            <!-- Country Dropdown -->
                                            <div class="col-md-6 mb-3">
                                                <label>Country</label>
                                                <select id="country_id" name="country_id" class="form-control" required>
                                                    <option value="">Select Country</option>
                                                    <?php
                                                    $COUNTRY = new Country(NULL);
                                                    foreach ($COUNTRY->all() as $country) {
                                                        echo '<option value="' . htmlspecialchars($country['id']) . '">' . htmlspecialchars($country['name']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <!-- Visa Category Dropdown -->
                                            <div class="col-md-6 mb-3">
                                                <label>Visa Category</label>
                                                <select id="visa_category" name="visa_category" class="form-control" required>
                                                    <option value="">Select Visa Category</option>
                                                    <option value="D4">D4 Korean Language Program</option>
                                                    <option value="D2.1">D2.1 Associate Degree (2 Years)</option>
                                                    <option value="D2.2">D2.2 Bachelor Degree (4 Years)</option>
                                                    <option value="D2.3">D2.3 Master's Degree (2 Years)</option>
                                                    <option value="D2.4">D2.4 PhD (2 Years)</option>
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
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Manage Staff -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Staff</h4>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Country</th>
                                                <th>Visa Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $STUDENT_COUNTRY_VISA = new StudentCountryVisa(NULL);
                                            foreach ($STUDENT_COUNTRY_VISA->all() as $key => $student_country_visa) {
                                                $key++;
                                            ?>
                                                <tr id="div<?php echo $student_country_visa['id'] ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo htmlspecialchars($student_country_visa['country_id']) ?></td>
                                                    <td><?php echo htmlspecialchars($student_country_visa['visa_category']) ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <div class="badge bg-pill bg-soft-success font-size-14 select-staff me-1"
                                                                data-id="<?php echo htmlspecialchars($student_country_visa['id']) ?>"
                                                                data-country_id="<?php echo isset($student_country_visa['country_id']) ? htmlspecialchars($student_country_visa['country_id']) : '' ?>"
                                                                data-visa_category="<?php echo isset($student_country_visa['visa_category']) ? htmlspecialchars($student_country_visa['visa_category']) : '' ?>">
                                                                <i class="fas fa-pencil-alt p-1"></i>
                                                            </div>
                                                            <div class="badge bg-pill bg-soft-danger font-size-14 delete-staff"
                                                                data-id="<?php echo htmlspecialchars($student_country_visa['id']) ?>">
                                                                <i class="fas fa-trash p-1"></i>
                                                            </div>
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
    <script src="ajax/js/student-country-visa.js"></script>

    <script>
        // Handle row selection to pre-fill form
        document.querySelectorAll('.select-staff-visa').forEach(function (el) {
            el.addEventListener('click', function () {
                document.getElementById('staff_visa_id').value = this.dataset.id;
                document.getElementById('country_id').value = this.dataset.country_id;
                document.getElementById('visa_category').value = this.dataset.visa_category;
                document.getElementById('create').style.display = 'none';
                document.getElementById('update').style.display = 'inline-block';
            });
        });

        document.getElementById('new').addEventListener('click', function () {
            document.getElementById('form-data').reset();
            document.getElementById('create').style.display = 'inline-block';
            document.getElementById('update').style.display = 'none';
        });
    </script>
</body>

</html>
