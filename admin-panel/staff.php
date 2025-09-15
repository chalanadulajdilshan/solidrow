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
    <!-- App favicon -->
    <?php include './assets/main_css.php'; ?>
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
                                    <form id="form-data">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Name</label>
                                                <input type="text" id="name" name="name" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Position</label>
                                                <input type="text" id="position" name="position" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Contact No</label>
                                                <input type="text" id="contact_no" name="contact_no" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>WhatsApp No</label>
                                                <input type="text" id="whatsapp_no" name="whatsapp_no" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>NIC</label>
                                                <input type="text" id="nic" name="nic" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Education Qualification</label>
                                                <input type="text" id="education_qualification" name="education_qualification" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Position Qualification</label>
                                                <input type="text" id="position_qualification" name="position_qualification" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Service Experience</label>
                                                <input type="text" id="service_experience" name="service_experience" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>ID Copy</label>
                                                <input type="text" id="id_copy" name="id_copy" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>EPF No</label>
                                                <input type="text" id="epf_no" name="epf_no" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Salary</label>
                                                <input type="text" id="salary" name="salary" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>District</label>
                                                <input type="text" id="district" name="district" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Province</label>
                                                <input type="text" id="province" name="province" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Company</label>
                                                <input type="text" id="company" name="company" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 text-end">
                                                <button class="btn btn-primary" type="submit" id="create">Create</button>
                                                <input type="hidden" name="create">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Staff List -->
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
                                                    <td><?php echo $staff['name'] ?></td>
                                                    <td><?php echo $staff['position'] ?></td>
                                                    <td>
                                                        <div class="badge bg-pill bg-soft-success font-size-14 select-staff"
                                                            data-id="<?php echo $staff['id'] ?>"
                                                            data-name="<?php echo $staff['name'] ?>"
                                                            data-position="<?php echo $staff['position'] ?>"
                                                            data-contact_no="<?php echo $staff['contact_no'] ?>"
                                                            data-whatsapp_no="<?php echo $staff['whatsapp_no'] ?>"
                                                            data-nic="<?php echo $staff['nic'] ?>"
                                                            data-education_qualification="<?php echo $staff['education_qualification'] ?>"
                                                            data-position_qualification="<?php echo $staff['position_qualification'] ?>"
                                                            data-service_experience="<?php echo $staff['service_experience'] ?>"
                                                            data-id_copy="<?php echo $staff['id_copy'] ?>"
                                                            data-epf_no="<?php echo $staff['epf_no'] ?>"
                                                            data-salary="<?php echo $staff['salary'] ?>"
                                                            data-district="<?php echo $staff['district'] ?>"
                                                            data-province="<?php echo $staff['province'] ?>"
                                                            data-company="<?php echo $staff['company'] ?>">
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

            <?php include './footer.php'; ?>
        </div>
    </div>

    <div class="rightbar-overlay"></div>

    <!-- JS -->
    <script src="assets/js/main_js.php"></script>
    <script src="ajax/js/staff.js"></script>
</body>

</html>