<?php
include '../class/include.php';
include './auth.php';

$id = '';
$id = $_GET['id'];
$ENGINEERING_APPLICATION = new EngineeringApplication($id);
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Manahe User | Sl Youth </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="#" name="description" />
    <meta content="Themesbrand" name="author" />

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
                                <h4 class="mb-0">Dashboard</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item active">User Type</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="p-4 card-body">
                                    <div class="p-2 mt-4">
                                        <form id="form-data" enctype="multipart/form-data">
                                            <div class="row">
                                                <!-- Full Name -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="full_name">සම්පූර්ණ නම (Full Name) <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="full_name" name="full_name"
                                                            placeholder="Enter your full name" value="<?php echo $ENGINEERING_APPLICATION->full_name ?>">
                                                    </div>
                                                    <input type="hidden" name="id" id="id" value="<?php echo $ENGINEERING_APPLICATION->id ?>">

                                                    <input type="hidden" name="staff_id" id="staff_id" value="<?php
                                                                                                                if (!isset($_SESSION['id'])) {
                                                                                                                    die('Session ID not set. Please log in again.');
                                                                                                                }
                                                                                                                echo $_SESSION['id'];
                                                                                                                ?>">
                                                </div>

                                                <!-- NIC Number -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="nic">ජාතික හැඳුනුම්පත් අංකය (NIC Number)
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="nic" name="nic"
                                                            placeholder="Enter your national id number" value="<?php echo $ENGINEERING_APPLICATION->nic ?>">
                                                    </div>
                                                </div>

                                                <!-- Passport Number -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="passport_number">පාස්පෝට් අංකය (Passport
                                                            Number) </label>
                                                        <input type="text" class="form-control" id="passport_number"
                                                            name="passport_number" placeholder="Enter your passport number" value="<?php echo $ENGINEERING_APPLICATION->passport_number ?>"
                                                            required>
                                                    </div>
                                                </div>

                                                <!-- Birthday -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="birthday">උපන් දිනය (Birthday) <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" id="birthday" name="birthday"
                                                            value="<?php echo $ENGINEERING_APPLICATION->birthday ?>" required>
                                                    </div>
                                                </div>

                                                <!-- Age -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="age">වයස (Age) <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" id="age" name="age"
                                                            placeholder="Enter your age" value="<?php echo $ENGINEERING_APPLICATION->age ?>" required>
                                                    </div>
                                                </div>

                                                <!-- Gender -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="gender">ස්ත්‍රී පුරුෂභාවය (Gender) <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" id="gender" name="gender" required>
                                                            <option value="">-- Select Gender --</option>
                                                            <option value="male" <?php echo ($ENGINEERING_APPLICATION->gender == 'male') ? 'selected' : ''; ?>>පුරුෂ (Male)</option>
                                                            <option value="female" <?php echo ($ENGINEERING_APPLICATION->gender == 'female') ? 'selected' : ''; ?>>ස්ත්‍රී (Female)</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Marital Status -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="marital_status">විවාහක අවිවාහක බව
                                                            (Marital Status) <span class="text-danger">*</span></label>
                                                        <select class="form-control" id="marital_status" name="marital_status" required>
                                                            <option value="">-- Select Marital Status --</option>
                                                            <option value="single" <?php echo ($ENGINEERING_APPLICATION->marital_status == 'single') ? 'selected' : ''; ?>>අවිවාහක (Single)</option>
                                                            <option value="married" <?php echo ($ENGINEERING_APPLICATION->marital_status == 'married') ? 'selected' : ''; ?>>විවාහක (Married)</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Mobile Number -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="mobile_number">ජංගම දුරකතන අංකය (Mobile
                                                            Number) <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="mobile_number"
                                                            name="mobile_number" placeholder="Enter your mobile number" value="<?php echo $ENGINEERING_APPLICATION->mobile_number ?>"
                                                            required>
                                                    </div>
                                                </div>

                                                <!-- Whatsapp Number -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="whatsapp_number">Whatsapp Number</label>
                                                        <input type="text" class="form-control" id="whatsapp_number"
                                                            name="whatsapp_number" placeholder="Enter your WhatsApp number" value="<?php echo $ENGINEERING_APPLICATION->whatsapp_number ?>">
                                                    </div>
                                                </div>

                                                <!-- Province -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="province_id">Select your Province <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" name="province_id" id="province_id" required>

                                                            <?php
                                                            $PROVINCE = new Province($ENGINEERING_APPLICATION->province_id);

                                                            ?>
                                                            <option value="<?php echo $PROVINCE->id ?>"><?php echo $PROVINCE->name ?></option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Current Job -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="current_job">ඔබගේ වෘත්තීය (Your current
                                                            job)</label>
                                                        <input type="text" class="form-control" id="current_job"
                                                            name="current_job" placeholder="Enter your current job" value="<?php echo $ENGINEERING_APPLICATION->current_job ?>">
                                                    </div>
                                                </div>

                                                <!-- Job Intend to Do Abroad -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="job_abroad">ඔබ නියැලීමට බලාපොරොත්තු වන
                                                            විදේශ රැකියාව (The job you intend to do abroad) <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" id="job_abroad" name="job_abroad" required>

                                                            <?php
                                                            $JobRole = new JobRole($ENGINEERING_APPLICATION->job_abroad);

                                                            ?>
                                                            <option value="<?php echo $JobRole->id ?>"><?php echo $JobRole->name ?></option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Type -->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="call_date_time">Call Date & Time <span class="text-danger">*</span></label>
                                                        <input type="datetime-local" class="form-control" id="call_date_time" name="call_date_time"
                                                            placeholder="Enter  call date" value="<?php echo $ENGINEERING_APPLICATION->call_date_time ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="call_status">Call Status <span class="text-danger">*</span></label>
                                                        <select class="form-control" id="call_status" name="call_status" required>
                                                            <option value="" <?php echo empty($ENGINEERING_APPLICATION->call_status) ? 'selected' : ''; ?>>-- Select Call Status --</option>
                                                            <option value="completed" <?php echo ($ENGINEERING_APPLICATION->call_status == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                                            <option value="pending" <?php echo ($ENGINEERING_APPLICATION->call_status == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                                            <option value="in_progress" <?php echo ($ENGINEERING_APPLICATION->call_status == 'in_progress') ? 'selected' : ''; ?>>In Progress</option>
                                                            <option value="not_answered" <?php echo ($ENGINEERING_APPLICATION->call_status == 'not_answered') ? 'selected' : ''; ?>>Not Answered</option>
                                                            <option value="rescheduled" <?php echo ($ENGINEERING_APPLICATION->call_status == 'rescheduled') ? 'selected' : ''; ?>>Rescheduled</option>
                                                            <option value="cancelled" <?php echo ($ENGINEERING_APPLICATION->call_status == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                                            <option value="follow_up" <?php echo ($ENGINEERING_APPLICATION->call_status == 'follow_up') ? 'selected' : ''; ?>>Follow Up Required</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="employee_status">Employee Status <span class="text-danger">*</span></label>
                                                        <select class="form-control" id="employee_status" name="employee_status" required>
                                                            <option value="" <?php echo empty($ENGINEERING_APPLICATION->employee_status) ? 'selected' : ''; ?>>-- Select Employee Status --</option>
                                                            <option value="ok" <?php echo ($ENGINEERING_APPLICATION->employee_status == 'ok') ? 'selected' : ''; ?>>Ok</option>
                                                            <option value="not_ok" <?php echo ($ENGINEERING_APPLICATION->employee_status == 'not_ok') ? 'selected' : ''; ?>>Not Ok</option> 
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="call_notes">Call Notes</label>
                                                        <textarea class="form-control" id="call_notes" name="call_notes" rows="3"><?php echo htmlspecialchars($ENGINEERING_APPLICATION->call_notes); ?></textarea>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-12 text-end">
                                                    <button class="btn btn-primary" type="submit" id="update">Update</button>
                                                    <input type="hidden" name="update">
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <?php include './assets/main-js.php'; ?>
    <script src="ajax/js/engineering-application.js" type="text/javascript"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>