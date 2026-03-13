<?php
include '../class/include.php';
include './auth.php';

$id = $_GET['id'] ?? '';
if (empty($id)) {
    header('Location: manage-baddegama-registration.php');
    exit();
}
$REGISTRATION = new BaddegamaRegistration($id);

// Handle status updates if needed (using the same logic as foreign employment)
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>View Baddegama Registration | Solidrow </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="#" name="description" />
    <meta content="Solidrow" name="author" />

    <?php include './assets/main-css.php'; ?>

</head>


<body class="someBlock">

    <!-- Begin page -->
    <div id="layout-wrapper">


        <?php include './top-header.php'; ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php include './navigation.php'; ?>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">View Registration</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="manage-baddegama-registration.php">Manage Baddegama Registration</a></li>
                                        <li class="breadcrumb-item active">View Details</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="p-4 card-body">
                                    <h4 class="card-title mb-4">Candidate Details: <?php echo htmlspecialchars($REGISTRATION->full_name); ?></h4>
                                    
                                    <form id="form-data">
                                        <div class="row">
                                            <!-- Basic Details Section -->
                                            <div class="col-md-12">
                                                <h5 class="mb-3 text-primary">Personal Information</h5>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($REGISTRATION->full_name); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">NIC Number</label>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($REGISTRATION->nic); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Passport Number</label>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($REGISTRATION->passport_number ?? 'N/A'); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Birthday</label>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($REGISTRATION->birthday); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Age</label>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($REGISTRATION->age); ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Gender</label>
                                                    <input type="text" class="form-control" value="<?php echo ucfirst(htmlspecialchars($REGISTRATION->gender)); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Marital Status</label>
                                                    <input type="text" class="form-control" value="<?php echo ucfirst(htmlspecialchars($REGISTRATION->marital_status ?? 'N/A')); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Mobile Number</label>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($REGISTRATION->mobile_number); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">WhatsApp Number</label>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($REGISTRATION->whatsapp_number ?? 'N/A'); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Province</label>
                                                    <?php 
                                                        $PROVINCE = new Province($REGISTRATION->province_id);
                                                        $province_name = $PROVINCE->name ?? 'N/A';
                                                    ?>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($province_name); ?>" readonly>
                                                </div>
                                            </div>

                                            <hr class="my-4">

                                            <!-- Professional Section -->
                                            <div class="col-md-12">
                                                <h5 class="mb-3 text-primary">Job & Professional Experience</h5>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Current Job</label>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($REGISTRATION->current_job ?? 'N/A'); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Experience (Years)</label>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($REGISTRATION->experience ?? '0'); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Job Intended Abroad</label>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($REGISTRATION->job_abroad ?? 'N/A'); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Destination Country</label>
                                                    <?php 
                                                        $COUNTRY = new Country($REGISTRATION->destination_country);
                                                        $country_name = $COUNTRY->name ?? 'N/A';
                                                    ?>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($country_name); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Application Type</label>
                                                    <input type="text" class="form-control" value="<?php echo strtoupper(htmlspecialchars($REGISTRATION->type ?? 'NORMAL')); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Registration Date</label>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($REGISTRATION->created_at); ?>" readonly>
                                                </div>
                                            </div>

                                            <hr class="my-4">

                                            <!-- Admin Update Section -->
                                            <div class="col-md-12">
                                                <h5 class="mb-3 text-success">Call Center & Status Tracking</h5>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="call_status">Call Status</label>
                                                    <select class="form-control" id="call_status" name="call_status">
                                                        <option value="" <?php echo empty($REGISTRATION->call_status) ? 'selected' : ''; ?>>-- Select Status --</option>
                                                        <option value="completed" <?php echo ($REGISTRATION->call_status == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                                        <option value="pending" <?php echo ($REGISTRATION->call_status == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                                        <option value="in_progress" <?php echo ($REGISTRATION->call_status == 'in_progress') ? 'selected' : ''; ?>>In Progress</option>
                                                        <option value="not_answered" <?php echo ($REGISTRATION->call_status == 'not_answered') ? 'selected' : ''; ?>>Not Answered</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="employee_status">Employee Status</label>
                                                    <select class="form-control" id="employee_status" name="employee_status">
                                                        <option value="" <?php echo empty($REGISTRATION->employee_status) ? 'selected' : ''; ?>>-- Select Status --</option>
                                                        <option value="ok" <?php echo ($REGISTRATION->employee_status == 'ok') ? 'selected' : ''; ?>>Ok</option>
                                                        <option value="not_ok" <?php echo ($REGISTRATION->employee_status == 'not_ok') ? 'selected' : ''; ?>>Not Ok</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="call_date_time">Last Call Time</label>
                                                    <?php 
                                                        $current_call_time = $REGISTRATION->call_date_time ? date('Y-m-d\TH:i', strtotime($REGISTRATION->call_date_time)) : date('Y-m-d\TH:i');
                                                    ?>
                                                    <input type="datetime-local" class="form-control" id="call_date_time" name="call_date_time" value="<?php echo $current_call_time; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="call_notes">Call Notes</label>
                                                    <textarea class="form-control" id="call_notes" name="call_notes" rows="4"><?php echo htmlspecialchars($REGISTRATION->call_notes); ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="id" value="<?php echo $REGISTRATION->id; ?>">
                                        <input type="hidden" name="update_baddegama">

                                        <div class="row mt-3">
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-primary px-4" id="update-btn">Update Status</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <?php include './assets/main-js.php'; ?>
    
    <script>
        $(document).ready(function() {
            $('#form-data').on('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                
                $.ajax({
                    url: 'ajax/php/baddegama-registration-update.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            swal({
                                title: "Success!",
                                text: "Registration updated successfully!",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }, function() {
                                window.location.reload();
                            });
                        } else {
                            swal({
                                title: "Error!",
                                text: response.message || "Update failed",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>
