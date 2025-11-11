<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Application Management | Youth Service LTD</title>
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
                    
                    <!-- Create / Edit Application -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create Application</h4>
                                    <form id="form-data" enctype="multipart/form-data">
                                        <input type="hidden" id="id" name="id">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Full Name</label>
                                                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter full name" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>NIC</label>
                                                <input type="text" id="NIC" name="NIC" class="form-control" placeholder="Enter NIC number" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Passport Number</label>
                                                <input type="text" id="passportnumber" name="passportnumber" class="form-control" placeholder="Enter passport number" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Married Status</label>
                                                <select id="married_status" name="married_status" class="form-control" required>
                                                    <option value="">Select status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Widowed">Widowed</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Mobile Number</label>
                                                <input type="text" id="mobile_number" name="mobile_number" class="form-control" placeholder="Enter mobile number" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>WhatsApp Number</label>
                                                <input type="text" id="whatsapp_number" name="whatsapp_number" class="form-control" placeholder="Enter WhatsApp number">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Country</label>

 
                                                <select id="country" name="country" class="form-control" required>
                                                    <option value="">Select country</option>
                                                    <?php
                                                    $COUNTRY = new Country(NULL);
                                                    foreach ($COUNTRY->all() as $key => $country) {
                                                        $key++;
                                                    ?>
                                                        <option value="<?php echo $country['id'] ?>"><?php echo htmlspecialchars($country['name']) ?></option>
                                                    <?php
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
                                                <button type="button" class="btn btn-danger delete-application">
                                                    <i class="uil uil-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Application List -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Applications</h4>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Full Name</th>
                                                <th>NIC</th>
                                                <th>Passport Number</th>
                                                <th>Married Status</th>
                                                <th>Mobile Number</th>
                                                <th>WhatsApp Number</th>
                                                <th>Country</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $APPLICATION = new Application(NULL);
                                            foreach ($APPLICATION->all() as $key => $application) {
                                                $COUNTRY = new Country($application['country']);
                                                $key++;
                                            ?>
                                                <tr id="div<?php echo $application['id'] ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo htmlspecialchars($application['fullname']) ?></td>
                                                    <td><?php echo htmlspecialchars($application['NIC']) ?></td>
                                                    <td><?php echo htmlspecialchars($application['passportnumber']) ?></td>
                                                    <td><?php echo htmlspecialchars($application['married_status']) ?></td>
                                                    <td><?php echo htmlspecialchars($application['mobile_number']) ?></td>
                                                    <td><?php echo htmlspecialchars($application['whatsapp_number']) ?></td>
                                                    <td><?php echo htmlspecialchars($COUNTRY->name) ?></td>
                                                    <td>
                                                        <div class="badge bg-pill bg-soft-success font-size-14 select-application"
                                                            data-id="<?php echo $application['id'] ?>"
                                                            data-fullname="<?php echo htmlspecialchars($application['fullname']) ?>"
                                                            data-nic="<?php echo htmlspecialchars($application['NIC']) ?>"
                                                            data-passportnumber="<?php echo htmlspecialchars($application['passportnumber']) ?>"
                                                            data-married_status="<?php echo htmlspecialchars($application['married_status']) ?>"
                                                            data-mobile_number="<?php echo htmlspecialchars($application['mobile_number']) ?>"
                                                            data-whatsapp_number="<?php echo htmlspecialchars($application['whatsapp_number']) ?>"
                                                            data-country="<?php echo htmlspecialchars($COUNTRY->id) ?>">
                                                            <i class="fas fa-pencil-alt p-1"></i>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <form action="create-agancy-student.php" method="post" style="display:inline;">
                                                            <input type="hidden" name="application" value="<?php echo $application['id'] ?>">
                                                            <button type="submit" class="btn btn-sm btn-primary ms-1">
                                                                <i class="fas fa-user-graduate"></i> Create Student
                                                            </button>
                                                        </form>
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
    <script src="ajax/js/application.js"></script>
</body>
</html>
