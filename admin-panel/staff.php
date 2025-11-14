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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create Staff</h4>
                                    <form id="form-data" enctype="multipart/form-data">
                                        <input type="hidden" id="staff_id" name="staff_id">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Name</label>
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter full name" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Position</label>
                                                <input type="text" id="position" name="position" class="form-control" placeholder="Enter position" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Contact No</label>
                                                <input type="text" id="contact_no" name="contact_no" class="form-control" placeholder="Enter contact number" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>WhatsApp No</label>
                                                <input type="text" id="whatsapp_no" name="whatsapp_no" class="form-control" placeholder="Enter WhatsApp number">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>NIC</label>
                                                <input type="text" id="nic" name="nic" class="form-control" placeholder="Enter NIC number" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>ID Copy (Image)</label>
                                                <input type="file" id="id_copy" name="id_copy" class="form-control" accept="image/*" onchange="previewIdCopy(this)">
                                                <div id="id_copy_preview" class="mt-2" style="display: none;">
                                                    <img id="id_copy_image" src="#" alt="ID Copy Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                                    <button type="button" class="btn btn-sm btn-danger ms-2" onclick="removeIdCopy()">Remove</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>EPF No</label>
                                                <input type="text" id="epf_no" name="epf_no" class="form-control" placeholder="Enter EPF number" required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Salary</label>
                                                <input type="number" id="salary" name="salary" class="form-control" placeholder="Enter salary amount" required>
                                            </div>

                                             
                                            <div class="col-md-6">
                                                <label for="province" class="col-form-label">Province of Residence <span class="text-danger">*</span></label>
                                                <select class="form-control" id="province" name="province">
                                                    <option value="">-- Select Province --</option>
                                                    <?php
                                                    $PROVINCE = new Province(NULL);
                                                    foreach ($PROVINCE->all() as $key => $province) {
                                                        echo "<option value=\"{$province['id']}\">{$province['name']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="district" class="col-form-label">District <span class="text-danger">*</span></label>
                                                <select class="form-control" id="district" name="district">
                                                    <option value="">-- Select District --</option>
                                                    <!-- Populate dynamically -->
                                                </select>
                                            </div>
                                           
                                            <div class="col-md-6 mb-3">
                                                <label>Company</label>
                                                <select id="company" name="company" class="form-select" required>
                                                    <option value="">Select Company</option>
                                                    <?php
                                                    $COMPANY = new Company(NULL);
                                                    foreach ($COMPANY->all() as $company) {
                                                    ?>
                                                        <option value="<?php echo htmlspecialchars($company['id']); ?>">
                                                            <?php echo htmlspecialchars($company['name']); ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Group</label>
                                                <select id="group_id" name="group_id" class="form-select">
                                                    <option value="">Select Group (Optional)</option>
                                                    <?php
                                                    $GROUP = new Group(NULL);
                                                    $groups = $GROUP->all();
                                                    if ($groups) {
                                                        foreach ($groups as $group) {
                                                    ?>
                                                            <option value="<?php echo htmlspecialchars($group['id']); ?>">
                                                                <?php echo htmlspecialchars($group['group_name']); ?>
                                                            </option>
                                                    <?php 
                                                        }
                                                    } 
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Join Date</label>
                                                <input type="date" id="join_date" name="join_date" class="form-control" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label>Education Qualification</label>
                                                <textarea id="education_qualification" name="education_qualification" class="form-control" rows="3" placeholder="Enter education qualification"></textarea>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label>Professional Qualification</label>
                                                <textarea id="position_qualification" name="position_qualification" class="form-control" rows="3" placeholder="Enter Professional qualification"></textarea>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label>Service Experience</label>
                                                <textarea id="service_experience" name="service_experience" class="form-control" rows="3" placeholder="Enter service experience"></textarea>
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
                                                <button type="button" class="btn btn-danger delete-staff">
                                                    <i class="uil uil-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Staff</h4>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $STAFF = new Staff(NULL);
                                            foreach ($STAFF->all() as $key => $staff) {
                                                $key++;
                                            ?>
                                                <tr id="div<?php echo $staff['id'] ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo htmlspecialchars($staff['name']) ?></td>
                                                    <td><?php echo htmlspecialchars($staff['position']) ?></td>
                                                    <td>
                                                        <div class="badge bg-pill bg-soft-success font-size-14 select-staff"
                                                            data-id="<?php echo htmlspecialchars($staff['id']) ?>"
                                                            data-name="<?php echo htmlspecialchars($staff['name']) ?>"
                                                            data-position="<?php echo htmlspecialchars($staff['position']) ?>"
                                                            data-contact_no="<?php echo htmlspecialchars($staff['contact_no']) ?>"
                                                            data-whatsapp_no="<?php echo htmlspecialchars($staff['whatsapp_no']) ?>"
                                                            data-nic="<?php echo htmlspecialchars($staff['nic']) ?>"
                                                            data-education_qualification="<?php echo htmlspecialchars($staff['education_qualification']) ?>"
                                                            data-position_qualification="<?php echo htmlspecialchars($staff['position_qualification']) ?>"
                                                            data-service_experience="<?php echo htmlspecialchars($staff['service_experience']) ?>"
                                                            data-id_copy="<?php echo htmlspecialchars($staff['id_copy']) ?>"
                                                            data-epf_no="<?php echo htmlspecialchars($staff['epf_no']) ?>"
                                                            data-salary="<?php echo htmlspecialchars($staff['salary']) ?>"
                                                            data-district="<?php echo htmlspecialchars($staff['district']) ?>"
                                                            data-province="<?php echo htmlspecialchars($staff['province']) ?>"
                                                            data-company="<?php echo htmlspecialchars($staff['company']) ?>"
                                                            data-join_date="<?php echo htmlspecialchars($staff['join_date']) ?>">
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
    <script src="ajax/js/staff.js"></script>
     <script src="ajax/js/district.js" type="text/javascript"></script>
    <script>
        function previewIdCopy(input) {
            const preview = document.getElementById('id_copy_preview');
            const image = document.getElementById('id_copy_image');

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

        function removeIdCopy() {
            const input = document.getElementById('id_copy');
            const preview = document.getElementById('id_copy_preview');
            input.value = '';
            preview.style.display = 'none';
        }
    </script>
</body>
</html>
