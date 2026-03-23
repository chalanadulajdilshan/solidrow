<?php
include '../class/include.php';
include './auth.php';

$id = $_GET['id'] ?? '';
if (empty($id)) {
    header('Location: manage-baddegama-registration.php');
    exit();
}
$REGISTRATION = new BaddegamaRegistration($id);
$is_edit = isset($_GET['edit']) && $_GET['edit'] == 'true';
$readonly = $is_edit ? '' : 'readonly';

// Handle status updates if needed (using the same logic as foreign employment)
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?php echo $is_edit ? 'Edit' : 'View'; ?> Baddegama Registration | Solidrow </title>
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
                                <h4 class="mb-0"><?php echo $is_edit ? 'Edit' : 'View'; ?> Registration</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="manage-baddegama-registration.php">Manage Baddegama Registration</a></li>
                                        <li class="breadcrumb-item active"><?php echo $is_edit ? 'Edit' : 'View'; ?> Details</li>
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
                                                    <label class="form-label" for="full_name">Full Name</label>
                                                    <input type="text" class="form-control" name="full_name" value="<?php echo htmlspecialchars($REGISTRATION->full_name); ?>" <?php echo $readonly; ?>>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="nic">NIC Number</label>
                                                    <input type="text" class="form-control" name="nic" value="<?php echo htmlspecialchars($REGISTRATION->nic); ?>" <?php echo $readonly; ?>>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="passport_number">Passport Number</label>
                                                    <input type="text" class="form-control" name="passport_number" value="<?php echo htmlspecialchars($REGISTRATION->passport_number ?? 'N/A'); ?>" <?php echo $readonly; ?>>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="birthday">Birthday</label>
                                                    <input type="date" class="form-control" name="birthday" value="<?php echo date('Y-m-d', strtotime($REGISTRATION->birthday)); ?>" <?php echo $readonly; ?>>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="age">Age</label>
                                                    <input type="text" class="form-control" name="age" value="<?php echo htmlspecialchars($REGISTRATION->age); ?>" <?php echo $readonly; ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="gender">Gender</label>
                                                    <?php if ($is_edit): ?>
                                                        <select class="form-control" name="gender">
                                                            <option value="male" <?php echo $REGISTRATION->gender == 'male' ? 'selected' : ''; ?>>Male</option>
                                                            <option value="female" <?php echo $REGISTRATION->gender == 'female' ? 'selected' : ''; ?>>Female</option>
                                                        </select>
                                                    <?php else: ?>
                                                        <input type="text" class="form-control" value="<?php echo ucfirst(htmlspecialchars($REGISTRATION->gender)); ?>" readonly>
                                                        <input type="hidden" name="gender" value="<?php echo htmlspecialchars($REGISTRATION->gender); ?>">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="marital_status">Marital Status</label>
                                                    <?php if ($is_edit): ?>
                                                        <select class="form-control" name="marital_status">
                                                            <option value="single" <?php echo $REGISTRATION->marital_status == 'single' ? 'selected' : ''; ?>>Single</option>
                                                            <option value="married" <?php echo $REGISTRATION->marital_status == 'married' ? 'selected' : ''; ?>>Married</option>
                                                        </select>
                                                    <?php else: ?>
                                                        <input type="text" class="form-control" value="<?php echo ucfirst(htmlspecialchars($REGISTRATION->marital_status ?? 'N/A')); ?>" readonly>
                                                        <input type="hidden" name="marital_status" value="<?php echo htmlspecialchars($REGISTRATION->marital_status); ?>">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="mobile_number">Mobile Number</label>
                                                    <input type="text" class="form-control" name="mobile_number" value="<?php echo htmlspecialchars($REGISTRATION->mobile_number); ?>" <?php echo $readonly; ?>>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="whatsapp_number">WhatsApp Number</label>
                                                    <input type="text" class="form-control" name="whatsapp_number" value="<?php echo htmlspecialchars($REGISTRATION->whatsapp_number ?? 'N/A'); ?>" <?php echo $readonly; ?>>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="province_id">Province</label>
                                                    <?php if ($is_edit): ?>
                                                        <select class="form-control" name="province_id">
                                                            <?php 
                                                            $PROV = new Province(NULL);
                                                            foreach ($PROV->all() as $p) {
                                                                $selected = $p['id'] == $REGISTRATION->province_id ? 'selected' : '';
                                                                echo "<option value='{$p['id']}' {$selected}>{$p['name']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    <?php else: ?>
                                                        <?php 
                                                            $PROVINCE = new Province($REGISTRATION->province_id);
                                                            $province_name = $PROVINCE->name ?? 'N/A';
                                                        ?>
                                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($province_name); ?>" readonly>
                                                        <input type="hidden" name="province_id" value="<?php echo htmlspecialchars($REGISTRATION->province_id); ?>">
                                                    <?php endif; ?>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="type">Location</label>
                                                    <?php if ($is_edit): ?>
                                                        <select class="form-control" name="type">
                                                            <option value="">-- Select Location --</option>
                                                            <?php 
                                                            $LOC = new Location(NULL);
                                                            foreach ($LOC->all() as $l) {
                                                                $selected = $l['id'] == $REGISTRATION->type ? 'selected' : '';
                                                                echo "<option value='{$l['id']}' {$selected}>{$l['name']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    <?php else: ?>
                                                        <?php 
                                                            $LOCATION = new Location($REGISTRATION->type);
                                                            $location_name = $LOCATION->name ?? ($REGISTRATION->type == 'BADDEGAMA' ? 'Baddegama' : 'N/A');
                                                        ?>
                                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($location_name); ?>" readonly>
                                                        <input type="hidden" name="type" value="<?php echo htmlspecialchars($REGISTRATION->type); ?>">
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <hr class="my-4">

                                            <!-- Professional Section -->
                                            <div class="col-md-12">
                                                <h5 class="mb-3 text-primary">Job & Professional Experience</h5>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="current_job">Current Job</label>
                                                    <input type="text" class="form-control" name="current_job" value="<?php echo htmlspecialchars($REGISTRATION->current_job ?? 'N/A'); ?>" <?php echo $readonly; ?>>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="experience">Experience (Years)</label>
                                                    <input type="text" class="form-control" name="experience" value="<?php echo htmlspecialchars($REGISTRATION->experience ?? '0'); ?>" <?php echo $readonly; ?>>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="job_abroad">Job Intended Abroad</label>
                                                    <input type="text" class="form-control" name="job_abroad" value="<?php echo htmlspecialchars($REGISTRATION->job_abroad ?? 'N/A'); ?>" <?php echo $readonly; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="destination_country">Destination Country</label>
                                                    <?php if ($is_edit): ?>
                                                        <select class="form-control" name="destination_country">
                                                            <?php 
                                                            $CTRY = new Country(NULL);
                                                            foreach ($CTRY->all() as $c) {
                                                                $selected = $c['id'] == $REGISTRATION->destination_country ? 'selected' : '';
                                                                echo "<option value='{$c['id']}' {$selected}>{$c['name']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    <?php else: ?>
                                                        <?php 
                                                            $COUNTRY = new Country($REGISTRATION->destination_country);
                                                            $country_name = $COUNTRY->name ?? 'N/A';
                                                        ?>
                                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($country_name); ?>" readonly>
                                                        <input type="hidden" name="destination_country" value="<?php echo htmlspecialchars($REGISTRATION->destination_country); ?>">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Application Type</label>
                                                    <input type="text" class="form-control" value="<?php echo strtoupper(htmlspecialchars($REGISTRATION->type ?? 'NORMAL')); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Registration Date</label>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($REGISTRATION->created_at); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="result">Result</label>
                                                    <?php if ($is_edit): ?>
                                                        <select class="form-control" name="result" id="result">
                                                            <option value="" <?php echo empty($REGISTRATION->result) ? 'selected' : ''; ?>>-- Select Result --</option>
                                                            <option value="Pass" <?php echo ($REGISTRATION->result == 'Pass') ? 'selected' : ''; ?>>Pass</option>
                                                            <option value="Fail" <?php echo ($REGISTRATION->result == 'Fail') ? 'selected' : ''; ?>>Fail</option>
                                                        </select>
                                                    <?php else: ?>
                                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($REGISTRATION->result ?? 'N/A'); ?>" readonly>
                                                        <input type="hidden" name="result" value="<?php echo htmlspecialchars($REGISTRATION->result); ?>">
                                                    <?php endif; ?>
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

                                        <div class="row mt-3">
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-primary px-4" id="update-btn"><?php echo $is_edit ? 'Save Changes' : 'Update Status'; ?></button>
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
                
                // Validation (All except passport and whatsapp)
                const is_edit = <?php echo json_encode($is_edit); ?>;
                // if (is_edit) {
                //     if (!$('input[name="full_name"]').val()) {
                //         swal("Error!", "Please enter full name", "error");
                //         return;
                //     }
                //     if (!$('input[name="nic"]').val()) {
                //         swal("Error!", "Please enter NIC", "error");
                //         return;
                //     }
                //     if (!$('input[name="birthday"]').val()) {
                //         swal("Error!", "Please select birthday", "error");
                //         return;
                //     }
                //     if (!$('input[name="age"]').val()) {
                //         swal("Error!", "Please enter age", "error");
                //         return;
                //     }
                //     if (!$('select[name="gender"]').val()) {
                //         swal("Error!", "Please select gender", "error");
                //         return;
                //     }
                //     if (!$('select[name="marital_status"]').val()) {
                //         swal("Error!", "Please select marital status", "error");
                //         return;
                //     }
                //     if (!$('input[name="mobile_number"]').val()) {
                //         swal("Error!", "Please enter mobile number", "error");
                //         return;
                //     }
                //     if (!$('select[name="province_id"]').val()) {
                //         swal("Error!", "Please select province", "error");
                //         return;
                //     }
                //     if (!$('input[name="current_job"]').val()) {
                //         swal("Error!", "Please enter current job", "error");
                //         return;
                //     }
                //     if (!$('input[name="experience"]').val()) {
                //         swal("Error!", "Please enter experience", "error");
                //         return;
                //     }
                //     if (!$('input[name="job_abroad"]').val()) {
                //         swal("Error!", "Please enter job intended abroad", "error");
                //         return;
                //     }
                //     if (!$('select[name="destination_country"]').val()) {
                //         swal("Error!", "Please select destination country", "error");
                //         return;
                //     }
                // }

                $.ajax({
                    url: '../ajax/php/baddegama-registration.php',
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
                                window.location.href = 'manage-baddegama-registration.php';
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
