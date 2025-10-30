<!doctype html>
<?php
include '../class/include.php';
include './auth.php';
$DEFULTDATA = new DefaultData();
 
$AGENCY_STUDENT  = new AgancyStudent(NULL);
$studentToEdit = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $studentToEdit = new AgancyStudent((int) $_GET['id']);
}

$res = $AGENCY_STUDENT->getLastID();
$student_id = $res + 1;
$student_id = 'SDW/'.DATE('Y').'/'.DATE('m').'/'.DATE('d').'/'.$_SESSION['id'].'/'.$student_id;
?>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Create Agency Student  </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="#" name="description" />
    <meta content="NYSC" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- plugin css -->
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/libs/@chenfengyuan/datepicker/datepicker.min.css">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />

    <link href="plugin/sweetalert/sweetalert.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <style>
        .passport_fields {
            display: none;
            clear: both;
        }
        /* Validation styles */
        .is-valid {
            border-color: #28a745 !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e") !important;
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
            padding-right: 2.25rem;
        }
        .is-invalid {
            border-color: #dc3545 !important;
            padding-right: 2.25rem;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        .form-control:focus.is-valid,
        .form-control:focus.is-invalid {
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 80%;
            color: #dc3545;
        }
    </style>
</head>

<body class="someBlock">

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->


    <?php include './top-header.php'; ?>
    <?php include './navigation.php'; ?>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Create Agency Student</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <form id="form-data">
                            <div id="section-1" class="section">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-danger">01. Personal Details</p>
                                        <hr>
                                        <div class="row mt-2">

                                         <div class="col-md-4">
                                                <label for="registration_no" class="col-form-label"> Registration No <span class="text-danger">*</span></label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="text" id="registration_no"
                                                        name="registration_no" placeholder="Enter Registration No" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->registration_no : $student_id); ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="student_id" class="col-form-label"> Candidate Reg. No <span class="text-danger">*</span></label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="text" id="student_id"
                                                        name="student_id" placeholder="Enter Candidate Reg. No" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->student_id : ''); ?>" <?php echo $studentToEdit ? 'readonly' : ''; ?> >
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="registration_date" class="col-form-label">Registration Date <span class="text-danger">*</span></label>
                                                <input class="form-control" type="date" id="registration_date" name="registration_date" value="<?php echo $studentToEdit && $studentToEdit->registration_date ? date('Y-m-d', strtotime($studentToEdit->registration_date)) : ''; ?>">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="full_name" class="col-form-label">Name as Mentioned in the Passport <span class="text-danger">*</span></label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="text" id="full_name" name="full_name"
                                                        placeholder="Enter Name as Mentioned in the Passport " value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->full_name : ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 hidden">
                                                <label for="name_with_initials" class="col-form-label"> Name with Initial</label>
                                                <div class="col-md-12">
                                                    <input class="form-control" type="text" id="name_with_initials"
                                                        name="name_with_initials" placeholder="Enter Name with Initials" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->name_with_initials : ''); ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="address" class="col-form-label">Address <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="address" name="address"
                                                    placeholder="Enter Address" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->address : ''); ?>" required>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="nic" class="col-form-label">NIC Number <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="nic" name="nic"
                                                    placeholder="Enter NIC Number" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->nic : ''); ?>" required 
                                                    oninput="validateNIC(this)" 
                                                    onblur="checkNICExists(this.value)">
                                                <div class="invalid-feedback" id="nic-feedback">
                                                    Please enter a valid NIC number (10 or 12 digits)
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <label for="passport_retention" class="col-form-label">Passport Retention</label>
                                                <select class="form-control" id="passport_retention" name="passport_retention" onchange="togglePassportFields()">
                                                    <option value="">-- Select Passport Retention --</option>
                                                    <option value="yes" <?php echo $studentToEdit && $studentToEdit->passport_retention == 'yes' ? 'selected' : ''; ?>>Yes</option>
                                                    <option value="no" <?php echo $studentToEdit && $studentToEdit->passport_retention == 'no' ? 'selected' : ''; ?>>No</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4 passport_fields" style="display: none;">
                                                <label for="passport_collected_date" class="col-form-label">Passport Collected Date</label>
                                                <input class="form-control" type="date" id="passport_collected_date" name="passport_collected_date" placeholder="Enter Passport Collected Date" value="<?php echo $studentToEdit && $studentToEdit->passport_collected_date ? date('Y-m-d', strtotime($studentToEdit->passport_collected_date)) : ''; ?>">
                                            </div>

                                            <div class="col-md-4 passport_fields" style="display: none;">
                                                <label for="passport_number" class="col-form-label">Passport Number</label>
                                                <input class="form-control" type="text" id="passport_number" name="passport_number" placeholder="Enter Passport Number" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->passport_number : ''); ?>">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="birth_date" class="col-form-label">Birth Date </label>
                                                <input class="form-control" type="text" id="birth_date" name="birth_date"
                                                    value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->birth_date : ''); ?>" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="gender" class="col-form-label">Gender</label>
                                                <input class="form-control" type="text" id="gender" name="gender" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->gender : ''); ?>" readonly>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="email" class="col-form-label">Email Address</label>
                                                <input class="form-control" type="text" id="email" name="email"
                                                    placeholder="Enter Email Address" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->email : ''); ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="phone_number" class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="phone_number"
                                                    name="phone_number" placeholder="Enter Phone Number (10 digits)" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->phone_number : ''); ?>" required 
                                                    oninput="validatePhoneNumber(this)" 
                                                    onblur="checkMobileNumberExists(this.value, 'phone_number', function(exists) {
                                                        if (exists) {
                                                            showError('phone_number', 'This phone number is already registered');
                                                        }
                                                    });"
                                                    maxlength="10"
                                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                                                <div class="invalid-feedback">
                                                    Please enter a valid 10-digit phone number
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="whatsapp_number" class="col-form-label">Whatsapp Number <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="whatsapp_number"
                                                    name="whatsapp_number" placeholder="Enter WhatsApp Number (10 digits)" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->whatsapp_number : ''); ?>" required 
                                                    oninput="validatePhoneNumber(this)" maxlength="10"
                                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                                                <div class="invalid-feedback">
                                                    Please enter a valid 10-digit WhatsApp number
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="province" class="col-form-label">Province of Residence <span class="text-danger">*</span></label>
                                                <select class="form-control" id="province" name="province">
                                                    <option value="">-- Select Province --</option>
                                                    <?php
                                                    $PROVINCE = new Province(NULL);
                                                    foreach ($PROVINCE->all() as $key => $province) {
                                                        $selected = $studentToEdit && $studentToEdit->province == $province['id'] ? 'selected' : '';
                                                        echo "<option value=\"{$province['id']}\" $selected>{$province['name']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="district" class="col-form-label">District <span class="text-danger">*</span></label>
                                                <select class="form-control" id="district" name="district">
                                                    <option value="">-- Select District --</option>
                                                    <?php
                                                    if ($studentToEdit && $studentToEdit->province) {
                                                        $DISTRICT = new District(NULL);
                                                        foreach ($DISTRICT->GetDistrictByProvince($studentToEdit->province) as $district) {
                                                            $selected = $studentToEdit->district == $district['id'] ? 'selected' : '';
                                                            echo "<option value=\"{$district['id']}\" $selected>{$district['name']}</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="ds_division" class="col-form-label">Divisional
                                                    Secretariat</label>
                                                <select class="form-control" id="dsdivision_id" name="dsdivision_id">
                                                    <option value="">-- Select Divisional Secretariat --</option>
                                                    <?php
                                                    if ($studentToEdit && $studentToEdit->district) {
                                                        $DSDIVISION = new Dsdivision(NULL);
                                                        foreach ($DSDIVISION->GetDistrictByDsdivision($studentToEdit->district) as $division) {
                                                            $selected = $studentToEdit->dsdivision_id == $division['id'] ? 'selected' : '';
                                                            echo "<option value=\"{$division['id']}\" $selected>{$division['name']}</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="gn_division" class="col-form-label">Grama Niladhari
                                                    Division</label>
                                                <select class="form-control" id="gn_division" name="gn_division">
                                                    <option value="">-- Select Grama Niladhari Division --</option>
                                                    <?php
                                                    if ($studentToEdit && $studentToEdit->dsdivision_id) {
                                                        $GNDIV = new Gndivision(NULL);
                                                        foreach ($GNDIV->GetGnByDsdivision($studentToEdit->dsdivision_id) as $gn) {
                                                            $selected = $studentToEdit->gn_division == $gn['id'] ? 'selected' : '';
                                                            echo "<option value=\"{$gn['id']}\" $selected>{$gn['name']}</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="school_attendant" class="col-form-label">Highest Professional Qualification</label>
                                                <input class="form-control" type="text" id="school_attendant"
                                                    name="school_attendant"
                                                    placeholder="Enter Professional Qualification" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->school_attendant : ''); ?>">
                                            </div>


                                            <!-- selection countrys -->
                                            <div class="col-md-4">
                                                <label for="country" class="col-form-label">Country <span class="text-danger">*</span></label>
                                                <select class="form-control" id="country" name="country">
                                                    <option value="">-- Select Country --</option>
                                                    <?php
                                                    $COUNTRY = new Country(NULL);
                                                    foreach ($COUNTRY->all() as $key => $country) {
                                                        $selected = $studentToEdit && $studentToEdit->country == $country['id'] ? 'selected' : '';
                                                        echo "<option value=\"{$country['id']}\" $selected>{$country['name']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="country" class="col-form-label">Staff Coordinator  </label>
                                                <select class="form-control" id="staff_id" name="staff_id">
                                                    <option value="">-- Select Staff Coordinator --</option>
                                                    <?php
                                                    $STAFFCOORDINATOR = new staff(NULL);
                                                    foreach ($STAFFCOORDINATOR->all() as $key => $country) {
                                                        $selected = $studentToEdit && $studentToEdit->staff_id == $country['id'] ? 'selected' : '';
                                                        echo "<option value=\"{$country['id']}\" $selected>{$country['name']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="agent" class="col-form-label">Agent </label>
                                                <select class="form-control" id="agent_id" name="agent_id">
                                                    <option value="">-- Select Agent --</option>
                                                    <?php
                                                    $AGENT = new Agent(NULL);
                                                    $user = new User($_SESSION['id']);
                                                    foreach ($AGENT->all() as $key => $agent) {
                                                        $selected = '';
                                                        if ($studentToEdit) {
                                                            $selected = $studentToEdit->agent_id == $agent['id'] ? 'selected' : '';
                                                        } elseif ($agent['id'] == $user->agent_user_id) {
                                                            $selected = 'selected';
                                                        }
                                                        echo "<option value=\"{$agent['id']}\" $selected>{$agent['name']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                       


                                        <div class="col-md-4">
                                            <div class="form-check mt-4">
                                                <input class="form-check-input" type="checkbox" id="other_agent_check" name="other_agent_check" onchange="toggleOtherAgentFields()" <?php echo $studentToEdit && $studentToEdit->other_agent_check ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="other_agent_check">
                                                   Other Coordinator
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 other-agent-fields" style="display: none;">
                                            <label for="other_agent_name" class="col-form-label">Other Coordinator Name</label>
                                            <input type="text" class="form-control" id="other_agent_name" name="other_agent_name" placeholder="Enter Other Coordinator Name" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->other_agent_name : ''); ?>">
                                        </div>

                                        <div class="col-md-4 other-agent-fields" style="display: none;">
                                            <label for="other_agent_mobile" class="col-form-label">Other Coordinator Mobile</label>
                                            <input type="text" class="form-control" id="other_agent_mobile" name="other_agent_mobile" 
                                                   placeholder="Enter Coordinator Mobile (10 digits)" 
                                                   oninput="validatePhoneNumber(this)" 
                                                   maxlength="10"
                                                   value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->other_agent_mobile : ''); ?>"
                                                   onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                                            <div class="invalid-feedback">
                                                Please enter a valid 10-digit mobile number
                                            </div>
                                        </div>
                                        <script>
                                            $('form').on('submit', function(e) {
                                                e.preventDefault();
                                                const form = this;
                                                const phoneNumber = $('#phone_number').val();
                                                const whatsappNumber = $('#whatsapp_number').val();
                                                const otherAgentMobile = $('#other_agent_mobile').val();
                                                
                                                // Reset previous error states
                                                $('.is-invalid').removeClass('is-invalid');
                                                $('.duplicate-error').remove();
                                                
                                                // Validate phone number format
                                                if (!validatePhoneNumber(phoneNumber)) {
                                                    alert('Please enter a valid 10-digit phone number');
                                                    $('#phone_number').focus();
                                                    return false;
                                                }
                                                
                                                // Validate WhatsApp number format
                                                if (!validatePhoneNumber(whatsappNumber)) {
                                                    alert('Please enter a valid 10-digit WhatsApp number');
                                                    $('#whatsapp_number').focus();
                                                    return false;
                                                }
                                                
                                                // Check if other agent mobile is provided and valid
                                                if ($('#other_agent_check').is(':checked') && otherAgentMobile) {
                                                    if (!validatePhoneNumber(otherAgentMobile)) {
                                                        alert('Please enter a valid 10-digit mobile number for other coordinator');
                                                        $('#other_agent_mobile').focus();
                                                        return false;
                                                    }
                                                }
                                                
                                                // Function to show error message
                                                function showError(field, message) {
                                                    const $field = $('#' + field);
                                                    $field.addClass('is-invalid');
                                                    $field.after('<div class="invalid-feedback duplicate-error">' + message + '</div>');
                                                    $field.focus();
                                                }
                                                
                                                // Check for duplicate numbers
                                                let checksCompleted = 0;
                                                let hasDuplicates = false;
                                                
                                                function checkNext() {
                                                    checksCompleted++;
                                                    if (checksCompleted === 3 || (checksCompleted === 2 && !$('#other_agent_check').is(':checked'))) {
                                                        if (!hasDuplicates) {
                                                            form.submit();
                                                        }
                                                    }
                                                }
                                                
                                                // Check phone number
                                                checkMobileNumberExists(phoneNumber, 'phone_number', function(exists) {
                                                    if (exists) {
                                                        showError('phone_number', 'This phone number is already registered');
                                                        hasDuplicates = true;
                                                    }
                                                    checkNext();
                                                });
                                                
                                                // Check WhatsApp number
                                                checkMobileNumberExists(whatsappNumber, 'whatsapp_number', function(exists) {
                                                    if (exists) {
                                                        showError('whatsapp_number', 'This WhatsApp number is already registered');
                                                        hasDuplicates = true;
                                                    }
                                                    checkNext();
                                                });
                                                
                                                // Check other agent mobile if provided
                                                if ($('#other_agent_check').is(':checked') && otherAgentMobile) {
                                                    checkMobileNumberExists(otherAgentMobile, 'other_agent_mobile', function(exists) {
                                                        if (exists) {
                                                            showError('other_agent_mobile', 'This coordinator mobile number is already registered');
                                                            hasDuplicates = true;
                                                        }
                                                        checkNext();
                                                    });
                                                } else {
                                                    checksCompleted++; // Skip this check if not applicable
                                                }
                                            });
                                        </script>
                                        <div class="col-md-8" style="margin-top: 40px">
                                            <button class="btn btn-primary" type="button" id="save_section_1">Save Section 1</button>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div id="section-2" class="section"  >
<!-- <div id="section-2" class="section" style="display: none;"> -->

                                <div class="card">
                                    <div class="card-body">

                                        <p class="text-danger">02. Personal Details (Attachment) </p>
                                        <hr>

                                        <div class="row mt-2">

                                            <div class="col-md-6">
                                                <label for="passport_image" class="col-form-label">Passport Size Photo <span
                                                        class="text-danger">(826px x 1062px)</span></label>
                                                <input class="form-control" type="file" id="passport_image" name="passport_image">
                                                <input type="hidden" name="passport_image_hidden" id="passport_image_hidden" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->passport_image : ''); ?>">
                                            </div>


                                            <div class="col-md-6">
                                                <label for="nic_doc" class="col-form-label">NIC Color Copy (Attach)</label>
                                                <input class="form-control" type="file" id="nic_doc" name="nic_doc">
                                                <input type="hidden" name="nic_doc_hidden" id="nic_doc_hidden" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->nic_doc : ''); ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="passport_doc" class="col-form-label">Passport Color Copy (Attach)</label>
                                                <input class="form-control" type="file" id="passport_doc" name="passport_doc">
                                                <input type="hidden" name="passport_doc_hidden" id="passport_doc_hidden" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->passport_doc : ''); ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="professional_certificate_1" class="col-form-label">Professional Certificate (Attach) </label>
                                                <input class="form-control" type="file" id="professional_certificate_1"
                                                    name="professional_certificate_1">
                                                <input type="hidden" name="professional_certificate_1_hidden" id="professional_certificate_1_hidden" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->professional_certificate_1 : ''); ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="working_experience" class="col-form-label">Attach Working Experience</label>
                                                <input class="form-control" type="file" id="working_experience"
                                                    name="working_experience">
                                                <input type="hidden" name="working_experience_hidden" id="working_experience_hidden" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->working_experience : ''); ?>">
                                            </div>


                                            <div class="col-md-6">
                                                <label for="cv_copy" class="col-form-label">CV Copy (Attach)</label>
                                                <input class="form-control" type="file" id="cv_copy" name="cv_copy">
                                                <input type="hidden" name="cv_copy_hidden" id="cv_copy_hidden" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->cv_copy : ''); ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="local_pcc" class="col-form-label">Local PCC (Attach)</label>
                                                <input class="form-control" type="file" id="local_pcc" name="local_pcc">
                                                <input type="hidden" name="local_pcc_hidden" id="local_pcc_hidden" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->local_pcc : ''); ?>">
                                            </div>





                                            <div class="col-md-6">
                                                <label for="pcc_color_copy" class="col-form-label">2nd PCC Color Copy (Attach)</label>
                                                <input class="form-control" type="file" id="pcc_color_copy" name="pcc_color_copy">
                                                <input type="hidden" name="pcc_color_copy_hidden" id="pcc_color_copy_hidden" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->pcc_color_copy : ''); ?>">
                                            </div>


                                            <div class="col-md-6">
                                                <label for="local_pcc_date" class="col-form-label">Local PCC Attach Date</label>
                                                <input class="form-control datepicker" type="text" id="local_pcc_date" name="local_pcc_date" placeholder="Select Date" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->local_pcc_date : ''); ?>">
                                            </div>



                                            <div class="col-md-6">
                                                <label for="pcc_submit_date" class="col-form-label">2nd PCC Submit Date</label>
                                                <input class="form-control datepicker" type="text" id="pcc_submit_date" name="pcc_submit_date" placeholder="Enter 2nd PCC Submit Date" value="<?php echo htmlspecialchars($studentToEdit ? $studentToEdit->pcc_submit_date : ''); ?>">
                                            </div>
                                        </div>


                                        <div class="col-md-8" style="margin-top: 40px">
                                            <button class="btn btn-primary" type="button" id="save_section_2">Save Section 2</button>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div id="section-3" class="section"  >
<!-- <div id="section-3" class="section" style="display: none;"> -->

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <p class="text-danger">03. Other Related Qualification Section</p>
                                            <hr>

                                            <div class="col-md-6">
                                                <label for="avb_qualification" class="col-form-label">Available Qualification</label>
                                                <select class="form-control" id="avb_qualification" name="avb_qualification">
                                                    <option value="">-- Select option --</option>
                                                    <option value="yes" <?php echo $studentToEdit && $studentToEdit->other_related_qualification ? 'selected' : ''; ?>> Yes </option>
                                                    <option value="no" <?php echo $studentToEdit && !$studentToEdit->other_related_qualification ? 'selected' : ''; ?>> No </option>
                                                </select>
                                            </div>

                                            <!-- These fields will be hidden initially -->
                                            <div class="col-md-6 related-qualification-fields" style="display: none;">
                                                <label for="other_related_qualification" class="col-form-label">Other Related Qualification</label>
                                                <input class="form-control" type="text" id="other_related_qualification" name="other_related_qualification"
                                                    placeholder="Enter Other Related Qualification">
                                            </div>
                                            <div class="col-md-6 related-qualification-fields" style="display: none;">
                                                <label for="example-url-input" class="col-form-label">Attach Related Qualification 01</label>
                                                <input class="form-control" type="file" id="related_qualification_1" name="related_qualification_1">
                                                <input type="hidden" name="related_qualification_1_hidden" id="related_qualification_1_hidden">
                                            </div>
                                            <div class="col-md-6 related-qualification-fields" style="display: none;">
                                                <label for="example-url-input" class="col-form-label">Attach Related Qualification 02</label>
                                                <input class="form-control" type="file" id="related_qualification_2" name="related_qualification_2">
                                                <input type="hidden" name="related_qualification_2_hidden" id="related_qualification_2_hidden">
                                            </div>
                                            <div class="col-md-6 related-qualification-fields" style="display: none;">
                                                <label for="example-url-input" class="col-form-label">Attach Related Qualification 03</label>
                                                <input class="form-control" type="file" id="related_qualification_3" name="related_qualification_3">
                                                <input type="hidden" name="related_qualification_3_hidden" id="related_qualification_3_hidden">
                                            </div>
                                        </div>


                                        <div class="col-md-8" style="margin-top: 40px">
                                            <button class="btn btn-primary" type="button" id="save_section_3">Save Section 3</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="section-4" class="section" >
<!-- <div id="section-4" class="section" style="display: none;"> -->

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <p class="text-danger">04. Emergency Contact Person Details</p>
                                            <hr>
                                            <div class="col-md-6">
                                                <label for="emergency_person_name" class="col-form-label">Emergency Person Name</label>
                                                <input class="form-control" type="text" id="emergency_person_name"
                                                    name="emergency_person_name" placeholder="Enter Emergency Person Name">
                                            </div>


                                            <div class="col-md-6">
                                                <label for="relationship" class="col-form-label"> Relationship </label>
                                                <select class="form-control" name="relationship" id="relationship">
                                                    <option value="">-- Select Relationship -- </option>
                                                    <?php
                                                    $DEFULTDATA = new DefaultData();
                                                    foreach ($DEFULTDATA->Relation() as $key => $tp) {
                                                    ?>
                                                        <option value="<?php echo $key ?>"><?php echo $tp ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="emergency_person_address" class="col-form-label">Emergency Person Address</label>
                                                <input class="form-control" type="text" id="emergency_person_address" name="emergency_person_address" placeholder="Enter Emergency Person Address">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="emergency_contact_number" class="col-form-label">Phone Number</label>
                                                <input class="form-control" type="text" id="emergency_contact_number" name="emergency_contact_number" placeholder="Enter Emergency Phone Number">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="emergency_whatsapp" class="col-form-label">Whatsapp
                                                    Number</label>
                                                <input class="form-control" type="text" id="emergency_whatsapp" name="emergency_whatsapp" placeholder="Enter Emergency Whatsapp Number">
                                            </div>
                                        </div>

                                        <div class="col-md-8" style="margin-top: 40px">
                                            <button class="btn btn-primary" type="button" id="save_section_4">Save Section 4</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="section-5" class="section" >
<!-- <div id="section-5" class="section" style="display: none;"> -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mt-2">
                                            <p class="text-danger">05. Job Confirmation Details</p>
                                            <hr>
                                            <div class="col-md-6">
                                                <label for="demand_name_field" class="col-form-label">Demand Name / Company</label>
                                                <input class="form-control" type="text" id="demand_name_field" name="demand_name_field" placeholder="Enter Demand Name and Field">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="occupation" class="col-form-label">Occupation</label>
                                                <input class="form-control" type="text" id="occupation" name="occupation" placeholder="Enter Occupation">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="agency_test_date" class="col-form-label">Agency Test Faced Date</label>
                                                <input class="form-control datepicker" type="text" id="agency_test_date" name="agency_test_date" placeholder="Enter Agency Test Faced Date">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="selection_test_result" class="col-form-label">Selection Test Result</label>
                                                <select class="form-control" id="selection_test_result" name="selection_test_result">
                                                    <option value="">Select Result</option>
                                                    <option value="Pass">Pass</option>
                                                    <option value="Fail">Fail</option>
                                                </select>
                                            </div>


                                            <div class="col-md-6">
                                                <label for="job_confirm_letter_date" class="col-form-label">Job Confirmation Letter Issue Date</label>
                                                <input class="form-control datepicker" type="text" id="job_confirm_letter_date" name="job_confirm_letter_date" placeholder="Enter Job Confirmation Letter Issue Date">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="job_confirm_letter_sign_date" class="col-form-label">Job Confirmation Letter Sign Date</label>
                                                <input class="form-control datepicker" type="text" id="job_confirm_letter_sign_date" name="job_confirm_letter_sign_date" placeholder="Enter Job Confirmation Letter Issue Date">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="job_confirm_sign_attach" class="col-form-label">Job Confirmation Letter Sign Attach</label>
                                                <input class="form-control" type="file" id="job_confirm_sign_attach" name="job_confirm_sign_attach">
                                                <input type="hidden" name="job_confirm_sign_attach_hidden" id="job_confirm_sign_attach_hidden">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="work_permit_document" class="col-form-label">Work Permit Related Document Submit date</label>
                                                <input class="form-control datepicker" type="text" id="work_permit_document" name="work_permit_document" placeholder="Select Date">
                                            </div>

                                        </div>

                                        <div class="col-md-8" style="margin-top: 40px">
                                            <button class="btn btn-primary" type="button" id="save_section_5">Save Section 5</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="section-6" class="section" >
<!-- <div id="section-6" class="section" style="display: none;"> -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mt-2">
                                            <p class="text-danger">06. Visa Related Documents</p>
                                            <hr>

                                            <div class="col-md-6">
                                                <label for="online_pcc" class="col-form-label">Online PCC (Attach)</label>
                                                <input class="form-control" type="file" id="online_pcc" name="online_pcc">
                                                <input type="hidden" name="online_pcc_hidden" id="online_pcc_hidden">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="online_pcc_date" class="col-form-label">Online PCC Attach Date</label>
                                                <input class="form-control datepicker" type="text" id="online_pcc_date" name="online_pcc_date" placeholder="Select Date">
                                            </div>




                                            <div class="col-md-6">
                                                <label for="work_permit_apply_date" class="col-form-label">Work Permit Apply
                                                    Date</label>
                                                <input class="form-control datepicker" type="text"
                                                    id="work_permit_apply_date" name="work_permit_apply_date"
                                                    placeholder="Enter Work Permit Issue Date">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="work_permit_issue_date" class="col-form-label">Work Permit Issue
                                                    Date</label>
                                                <input class="form-control datepicker" type="text"
                                                    id="work_permit_issue_date" name="work_permit_issue_date"
                                                    placeholder="Enter Work Permit Issue Date">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="work_permit_copy" class="col-form-label">Work Permit Color Copy
                                                    (Attach)</label>
                                                <input class="form-control" type="file" id="work_permit_copy"
                                                    name="work_permit_copy">
                                                <input type="hidden" name="work_permit_copy_hidden" id="work_permit_copy_hidden">
                                            </div>


                                            <div class="col-md-6">
                                                <label for="travel_insurance_copy" class="col-form-label">Travel Insurance
                                                    Copy (Attach)</label>
                                                <input class="form-control" type="file" id="travel_insurance_copy"
                                                    name="travel_insurance_copy">
                                                <input type="hidden" name="travel_insurance_copy_hidden" id="travel_insurance_copy_hidden">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="travel_insurance_submit_date" class="col-form-label">Travel
                                                    Insurance Submit Date</label>
                                                <input class="form-control datepicker" type="text"
                                                    id="travel_insurance_submit_date" name="travel_insurance_submit_date"
                                                    placeholder="Enter Travel Insurance Submit Date">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="travel_insurance2_copy" class="col-form-label">Travel Insurance 2
                                                    Copy (Attach)</label>
                                                <input class="form-control" type="file" id="travel_insurance2_copy"
                                                    name="travel_insurance2_copy">
                                                <input type="hidden" name="travel_insurance2_copy_hidden" id="travel_insurance2_copy_hidden">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="travel_insurance2_submit_date" class="col-form-label">Travel
                                                    Insurance 2 Submit Date</label>
                                                <input class="form-control datepicker" type="text"
                                                    id="travel_insurance2_submit_date" name="travel_insurance2_submit_date"
                                                    placeholder="Enter Travel Insurance Submit Date">
                                            </div>



                                            <div class="col-md-6">
                                                <label for="visa_file_send_date" class="col-form-label">Visa Document Send
                                                    Date</label>
                                                <input class="form-control datepicker" type="text" id="visa_file_send_date"
                                                    name="visa_file_send_date" placeholder="Enter Visa File Send Date">
                                            </div>


                                            <div class="col-md-6">
                                                <label for="embassy_appointment_date" class="col-form-label">Embassy
                                                    Appointment Date</label>
                                                <input class="form-control datepicker" type="text"
                                                    id="embassy_appointment_date" name="embassy_appointment_date"
                                                    placeholder="Enter Embassy Appointment Date">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="job_contract_copy" class="col-form-label">Job Contract Copy
                                                    Reseaved Date</label>
                                                <input class="form-control datepicker" type="text" id="job_contract_copy"
                                                    name="job_contract_copy" placeholder="Enter Job Contract Copy Reseaved Date">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="job_contract_copy_file" class="col-form-label">Job Contract Copy
                                                    (Attach)</label>
                                                <input class="form-control" type="file" id="job_contract_copy_file"
                                                    name="job_contract_copy_file">
                                                <input type="hidden" name="job_contract_copy_file_hidden" id="job_contract_copy_file_hidden">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="english_copy_attach_date" class="col-form-label">Employment/Job
                                                    Offer Letter English Copy Attach date</label>
                                                <input class="form-control datepicker" type="text" id="english_copy_attach_date"
                                                    name="english_copy_attach_date" placeholder="Enter Employment/Job Offer Letter English Copy Attach date">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="job_offer_letter_english" class="col-form-label">Employment/Job
                                                    Offer Letter English Copy (Attach)</label>
                                                <input class="form-control" type="file" id="job_offer_letter_english"
                                                    name="job_offer_letter_english">
                                                <input type="hidden" name="job_offer_letter_english_hidden" id="job_offer_letter_english_hidden">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="job_offer_letter_romania" class="col-form-label">Employment/Job
                                                    Offer Letter Romania Copy (Attach)</label>
                                                <input class="form-control" type="file" id="job_offer_letter_romania"
                                                    name="job_offer_letter_romania">
                                                <input type="hidden" name="job_offer_letter_romania_hidden" id="job_offer_letter_romania_hidden">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="guarantee_letter_english" class="col-form-label">Guarantee
                                                    Letter English Copy (Attach)</label>
                                                <input class="form-control" type="file" id="guarantee_letter_english"
                                                    name="guarantee_letter_english">
                                                <input type="hidden" name="guarantee_letter_english_hidden" id="guarantee_letter_english_hidden">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="guarantee_letter_romania" class="col-form-label">Guarantee
                                                    Letter Romania Copy (Attach)</label>
                                                <input class="form-control" type="file" id="guarantee_letter_romania"
                                                    name="guarantee_letter_romania">
                                                <input type="hidden" name="guarantee_letter_romania_hidden" id="guarantee_letter_romania_hidden">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="accommodation_confirmation" class="col-form-label">Accommodation
                                                    Confirmation Letter Copy (Attach)</label>
                                                <input class="form-control" type="file" id="accommodation_confirmation"
                                                    name="accommodation_confirmation">
                                                <input type="hidden" name="accommodation_confirmation_hidden" id="accommodation_confirmation_hidden">
                                            </div>
                                        </div>

                                        <div class="col-md-8" style="margin-top: 40px">
                                            <button class="btn btn-primary" type="button" id="save_section_6">Save Section 6</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="section-7" class="section" >
<!-- <div id="section-7" class="section" style="display: none;"> -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <p class="text-danger">07. Visa Details</p>
                                            <hr>
                                            <div class="col-md-4">
                                                <label for="visa_status" class="col-form-label">Visa Status</label>
                                                <select class="form-control" name="visa_status" id="visa_status">
                                                    <option value="">-- Select Visa Status --</option>
                                                    <option value="approved">Approved</option>
                                                    <option value="rejected">Rejected</option>
                                                </select>
                                            </div>


                                            <div class="col-md-4">
                                                <label for="visa_approved_date" class="col-form-label">Visa Approved
                                                    Date</label>
                                                <input class="form-control datepicker" type="text" id="visa_approved_date"
                                                    name="visa_approved_date" placeholder="Enter Visa Approved Date">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="beauro_training_date" class="col-form-label">Beauro Training Date</label>
                                                <input class="form-control datepicker" type="text" id="beauro_training_date"
                                                    name="beauro_training_date" placeholder="Beauro Training  Date">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="beauro_training_file" class="col-form-label">Beauro Certificate (Attach)</label>
                                                <input class="form-control" type="file" id="beauro_training_file"
                                                    name="beauro_training_file" placeholder="Enter Beauro Certificate">
                                                <input type="hidden" name="beauro_training_file_hidden" id="beauro_training_file_hidden">
                                            </div>



                                            <div class="col-md-4">
                                                <label for="final_approval_date" class="col-form-label">Final Approval
                                                    (Bureau) Date</label>
                                                <input class="form-control datepicker" type="text" id="final_approval_date"
                                                    name="final_approval_date"
                                                    placeholder="Enter Final Approval (Bureau) Date">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="final_bureau_date" class="col-form-label">Final Bureau Date</label>
                                                <input class="form-control datepicker" type="text" id="final_bureau_date"
                                                    name="final_bureau_date" placeholder="Enter Final Bureau Date">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="air_ticket_date" class="col-form-label">Air Ticket Date</label>
                                                <input class="form-control datepicker" type="text" id="air_ticket_date"
                                                    name="air_ticket_date" placeholder="Enter Air Ticket Date">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="air_ticket_copy" class="col-form-label">Air Ticket Copy
                                                    (Attach)</label>
                                                <input class="form-control" type="file" id="air_ticket_copy"
                                                    name="air_ticket_copy">
                                                <input type="hidden" name="air_ticket_copy_hidden" id="air_ticket_copy_hidden">
                                            </div>
                                        </div>

                                        <div class="col-md-8" style="margin-top: 40px">
                                            <button class="btn btn-primary" type="button" id="save_section_7">Save Section 7</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="section-8" class="section" >
<!-- <div id="section-8" class="section" style="display: none;"> -->
                                <div class="card  ">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="example-url-input" class="  col-form-label">Details Completed or
                                                    Not</label>
                                                <select class="form-control" name="is_completed" id="is_completed">
                                                    <option value="">-- Select student Status -- </option>

                                                    <option value="0"> Not Complete Details</option>
                                                    <option value="1"> Complete Details</option>

                                                </select>

                                            </div>
                                            <div class="col-md-8">
                                                <label for="example-url-input" class="  col-form-label"> Student
                                                    Note</label>

                                                <textarea class="form-control" id="note" name="note"></textarea>
                                            </div>

                                            <div class="col-md-8" style="margin-top: 40px">
                                                <button class="btn btn-primary" type="button" id="save_section_8">Save & Finish</button>
                                            </div>


                                            <input type="hidden" name="create">

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <input type="hidden" name="id" id="student_db_id" value="<?php echo $studentToEdit ? (int)$studentToEdit->id : ''; ?>">

                </form>

            </div>
        </div>
    </div>







    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

    <!-- plugins -->
    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>

    <!-- init js -->
    <script src="assets/js/pages/form-advanced.init.js"></script>

    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/js/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>


    <script src="ajax/js/agancy-student.js" type="text/javascript"></script>
    <script src="ajax/js/district.js" type="text/javascript"></script>
    <script src="ajax/js/dsdivision.js" type="text/javascript"></script>
    <script src="ajax/js/gramaniladari.js" type="text/javascript"></script>

    <script src="assets/js/app.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- JavaScript to show/hide related qualification fields -->

    <script>
        // Function to validate NIC number format
        function validateNIC(input) {
            const nic = input.value.trim();
            const isValid = /^([0-9]{9}[xXvV]|[0-9]{12})$/.test(nic);
            
            if (nic === '') {
                input.classList.remove('is-valid', 'is-invalid');
                return false;
            }
            
            input.classList.toggle('is-valid', isValid);
            input.classList.toggle('is-invalid', !isValid);
            
            return isValid;
        }
        
        // Function to check if NIC already exists in the database
        function checkNICExists(nic, callback) {
            // First validate the NIC format without DOM manipulation
            const nicRegex = /^([0-9]{9}[xXvV]|[0-9]{12})$/;
            const isValidFormat = nicRegex.test(nic.trim());
            
            if (!isValidFormat) {
                if (typeof callback === 'function') callback(false);
                return false;
            }
            
            return $.ajax({
                url: 'ajax/php/check-nic.php',
                type: 'POST',
                data: { 
                    nic: nic,
                    current_id: '<?php echo isset($_GET['id']) ? $_GET['id'] : 0; ?>'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.exists) {
                        const input = document.getElementById('nic');
                        input.classList.add('is-invalid');
                        const feedback = document.getElementById('nic-feedback');
                        feedback.textContent = 'This NIC number is already registered';
                        feedback.style.display = 'block';
                    }
                    if (typeof callback === 'function') callback(response.exists);
                },
                error: function(xhr, status, error) {
                    console.error('Error checking NIC:', status, error);
                    if (typeof callback === 'function') callback(false);
                }
            });
        }
        
        // Function to check if a mobile number already exists in the database
        function checkMobileNumberExists(number, field, callback) {
            if (!number || number.length !== 10) {
                callback(false);
                return;
            }
            
            $.ajax({
                url: 'ajax/php/check-mobile.php',
                type: 'POST',
                data: { 
                    number: number,
                    field: field,
                    current_id: '<?php echo isset($_GET['id']) ? $_GET['id'] : 0; ?>' // For edit mode
                },
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        console.error('Error checking mobile number:', response.error);
                        callback(false);
                    } else {
                        callback(response.exists);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                    callback(false);
                }
            });
        }

        // Function to validate and format phone numbers
        function validatePhoneNumber(input) {
            // Get the input element if a value was passed directly
            let inputElement = input;
            let value = input;
            
            if (input.value !== undefined) {
                // Handle direct element reference
                inputElement = input;
                value = input.value;
            } else if (typeof input === 'string') {
                // Handle string value (from inline oninput)
                inputElement = document.activeElement; // Get the currently focused input
                value = input;
            }
            
            // Remove any non-digit characters
            const digitsOnly = value.replace(/\D/g, '');
            
            // Limit to 10 digits
            const limitedDigits = digitsOnly.slice(0, 10);
            
            // Update the input field with only digits
            inputElement.value = limitedDigits;
            
            // Check if we have exactly 10 digits
            const isValid = /^\d{10}$/.test(limitedDigits);
            
            // Update visual feedback
            if (limitedDigits.length > 0) {
                inputElement.classList.toggle('is-invalid', !isValid);
                inputElement.classList.toggle('is-valid', isValid);
                
                // Show/hide error message
                const errorElement = inputElement.nextElementSibling;
                if (errorElement && errorElement.classList.contains('invalid-feedback')) {
                    errorElement.style.display = !isValid ? 'block' : 'none';
                }
            } else {
                inputElement.classList.remove('is-valid', 'is-invalid');
            }
            
            return isValid;
        }

        // Function to toggle passport fields based on retention selection
        function togglePassportFields() {
            const retention = document.getElementById('passport_retention').value;
            const passportFields = document.getElementsByClassName('passport_fields');

            // Convert HTMLCollection to array and update each element
            Array.from(passportFields).forEach(field => {
                if (retention === 'yes') {
                    field.style.display = 'block';
                } else {
                    field.style.display = 'none';
                    // Clear the fields when hiding
                    document.getElementById('passport_collected_date').value = '';
                    document.getElementById('passport_number').value = '';
                }
            });
        }

        // Initialize passport fields visibility when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            togglePassportFields();
        });

        document.getElementById('avb_qualification').addEventListener('change', function() {
            var relatedFields = document.querySelectorAll('.related-qualification-fields');

            // Check if "Yes" is selected
            if (this.value === 'yes') {
                // Show all related qualification fields
                relatedFields.forEach(function(field) {
                    field.style.display = 'block';
                });
            } else {
                // Hide all related qualification fields
                relatedFields.forEach(function(field) {
                    field.style.display = 'none';
                });
            }
        });

        function toggleOtherAgentFields() {
            const otherAgentCheck = document.getElementById('other_agent_check');
            const otherAgentFields = document.getElementsByClassName('other-agent-fields');
            const agentSelect = document.getElementById('agent_id');

            if (otherAgentCheck.checked) {
                // Show other agent fields and disable the agent select
                for (let field of otherAgentFields) {
                    field.style.display = 'block';
                }
                agentSelect.disabled = true;
                agentSelect.value = ''; // Clear the selection
            } else {
                // Hide other agent fields and enable the agent select
                for (let field of otherAgentFields) {
                    field.style.display = 'none';
                    // Clear the input fields when hiding
                    const inputs = field.getElementsByTagName('input');
                    for (let input of inputs) {
                        input.value = '';
                    }
                }
                agentSelect.disabled = false;
            }
        }
    </script>


    <script>
        $(function() {
            $(".datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                setDate: new Date() // This sets the default date to today's date
            });
        });
    </script>


    <script>
        $(function(e) {
            "use strict";
            $(".date-inputmask").inputmask("dd/mm/yyyy"),
                $(".phone-inputmask").inputmask("9999999999"),
                $(".email-inputmask").inputmask({
                    mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[*{2,6}][*{1,2}].*{1,}[.*{2,6}][.*{1,2}]",
                    greedy: !1,
                    onBeforePaste: function(n, a) {
                        return (e = e.toLowerCase()).replace("mailto:", "")
                    },
                    definitions: {
                        "*": {
                            validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~/-]",
                            cardinality: 1,
                            casing: "lower"
                        }
                    }
                })
        });
    </script>
    <script>
        $(document).ready(function() {

            $("#nic").focusout(function() {
                //Clear Existing Details
                $("#error").html("");
                $("#gender").html("");
                $("#year").html("");
                $("#month").html("");
                $("#day").html("");
                var NICNo = $("#nic").val();
                var dayText = 0;
                var year = "";
                var month = "";
                var day = "";
                var gender = "";
                if (NICNo.length != 10 && NICNo.length != 12) {
                    swal({
                        title: "Error!",
                        text: "Invalid NIC Number Please Check again..",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else if (NICNo.length == 10 && !$.isNumeric(NICNo.substr(0, 9))) {
                    alert("Invalid NIC No.");
                    $("#nic").focus();

                } else {
                    // Year
                    if (NICNo.length == 10) {
                        year = "19" + NICNo.substr(0, 2);
                        dayText = parseInt(NICNo.substr(2, 3));
                    } else {
                        year = NICNo.substr(0, 4);
                        dayText = parseInt(NICNo.substr(4, 3));
                    }

                    // Gender
                    if (dayText > 500) {
                        gender = "Female";
                        dayText = dayText - 500;
                    } else {
                        gender = "Male";
                    }

                    // Day Digit Validation
                    if (dayText < 1 && dayText > 366) {
                        $("#error").html("Invalid NIC No.");
                    } else {

                        //Month
                        if (dayText > 335) {
                            day = dayText - 335;
                            month = "12";
                        } else if (dayText > 305) {
                            day = dayText - 305;
                            month = "11";
                        } else if (dayText > 274) {
                            day = dayText - 274;
                            month = "10";
                        } else if (dayText > 244) {
                            day = dayText - 244;
                            month = "9";
                        } else if (dayText > 213) {
                            day = dayText - 213;
                            month = "8";
                        } else if (dayText > 182) {
                            day = dayText - 182;
                            month = "7";
                        } else if (dayText > 152) {
                            day = dayText - 152;
                            month = "6";
                        } else if (dayText > 121) {
                            day = dayText - 121;
                            month = "5";
                        } else if (dayText > 91) {
                            day = dayText - 91;
                            month = "4";
                        } else if (dayText > 60) {
                            day = dayText - 60;
                            month = "3";
                        } else if (dayText < 32) {
                            month = "1";
                            day = dayText;
                        } else if (dayText > 31) {
                            day = dayText - 31;
                            month = "2";
                        }



                        $("#gender").val(gender);
                        $("#birth_date").val(year + '/' + month + '/' + day);
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Show only section 1 initially
            $('.section').hide();
            $('#section-1').show();

            // Function to validate section 1 fields
            function validateSection1() {
                let isValid = true;
                const nic = $('#nic').val().trim();
                const phoneNumber = $('#phone_number').val().trim();
                const whatsappNumber = $('#whatsapp_number').val().trim();
                const registrationDate = $('#registration_date').val();
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                // Reset previous error states
                $('.is-invalid').removeClass('is-invalid');
                $('.duplicate-error').remove();
                $('.form-control').removeClass('is-valid');
                
                // Function to show error message
                function showError(field, message) {
                    const $field = $('#' + field);
                    $field.addClass('is-invalid');
                    $field.after('<div class="invalid-feedback duplicate-error" style="display: block;">' + message + '</div>');
                    $field.focus();
                    isValid = false;
                }
                
                // Function to mark field as valid
                function markValid(field) {
                    $('#' + field).addClass('is-valid');
                }
                
                // Validate NIC
                if (!nic) {
                    showError('nic', 'NIC number is required');
                } else if (!/^([0-9]{9}[xXvV]|[0-9]{12})$/.test(nic)) {
                    showError('nic', 'Please enter a valid NIC number (10 or 12 digits)');
                }
                
                // Validate Registration Date
                if (!registrationDate) {
                    showError('registration_date', 'Registration date is required');
                } else {
                    const selectedDate = new Date(registrationDate);
                    selectedDate.setHours(0, 0, 0, 0);
                    
                    if (selectedDate > today) {
                        showError('registration_date', 'Registration date cannot be in the future');
                    } else {
                        markValid('registration_date');
                    }
                }
                
                // Validate Phone Number
                if (!phoneNumber) {
                    showError('phone_number', 'Phone number is required');
                } else if (!/^[1-9]\d{9}$/.test(phoneNumber)) {
                    showError('phone_number', 'Please enter a valid 10-digit phone number (should not start with 0)');
                } else if (phoneNumber === whatsappNumber) {
                    showError('phone_number', 'Phone number and WhatsApp number cannot be the same');
                } else {
                    markValid('phone_number');
                }
                
                // Validate WhatsApp Number
                if (!whatsappNumber) {
                    showError('whatsapp_number', 'WhatsApp number is required');
                } else if (!/^[1-9]\d{9}$/.test(whatsappNumber)) {
                    showError('whatsapp_number', 'Please enter a valid 10-digit WhatsApp number (should not start with 0)');
                } else if (phoneNumber === whatsappNumber) {
                    showError('whatsapp_number', 'Phone number and WhatsApp number cannot be the same');
                } else {
                    markValid('whatsapp_number');
                }
                
                // Check for duplicate NIC
                if (isValid) {
                    return new Promise((resolve) => {
                        checkNICExists(nic, function(exists) {
                            if (exists) {
                                showError('nic', 'This NIC number is already registered');
                                resolve(false);
                            } else {
                                // Check for duplicate phone numbers
                                checkMobileNumberExists(phoneNumber, 'phone_number', function(phoneExists) {
                                    if (phoneExists) {
                                        showError('phone_number', 'This phone number is already registered');
                                        resolve(false);
                                    } else {
                                        checkMobileNumberExists(whatsappNumber, 'whatsapp_number', function(whatsappExists) {
                                            if (whatsappExists) {
                                                showError('whatsapp_number', 'This WhatsApp number is already registered');
                                                resolve(false);
                                            } else {
                                                resolve(true);
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    });
                }
                
                return Promise.resolve(isValid);
            }
            
            // Section navigation handlers (saving is handled in agancy-student.js)
            function goToSection(currentSection, nextSection) {
                $(`#${currentSection}`).fadeOut(300, function() {
                    $(`#${nextSection}`).fadeIn(300, function() {
                        $('html, body').animate({
                            scrollTop: $(`#${nextSection}`).offset().top - 20
                        }, 500);
                    });
                });
            }

            // Section 2
            $('#save_section_2').on('click', function() {
                goToSection('section-2', 'section-3');
            });

            // Section 3
            $('#save_section_3').on('click', function() {
                goToSection('section-3', 'section-4');
            });

            // Section 4
            $('#save_section_4').on('click', function() {
                goToSection('section-4', 'section-5');
            });

            // Section 5
            $('#save_section_5').on('click', function() {
                goToSection('section-5', 'section-6');
            });

            // Section 6
            $('#save_section_6').on('click', function() {
                goToSection('section-6', 'section-7');
            });

            $('#save_section_7').on('click', function() {
                $('#section-8').show();
                $('html, body').animate({
                    scrollTop: $("#section-8").offset().top
                }, 500);
            });
        });
    </script>


</body>

</html>