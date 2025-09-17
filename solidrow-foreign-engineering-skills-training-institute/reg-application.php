<?php
include '../class/include.php';
?>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Register </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta
        content=" "
        name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png">

    
    <?php include '../admin-panel/assets/main-css.php'; ?>
</head>

<body class="authentication-bg someBlock">
    <div class="my-5 account-pages ">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="text-center">
                        <a href="#" class="mb-2 d-block auth-logo">
                            <img src="assets/images/logo-dark.jpg" alt="" width="100%" class="logo logo-dark"> 
                        </a>
                    </div>
                </div>
                <div class="col-lg-2"></div>

            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-8 col-xl-8">
                    <div class="card">

                        <div class="p-4 card-body">

                            <div class="mt-2 text-center">
                                <h5 class="text-primary"> Registration Form</h5>
                                <p class="text-muted">Fill your Personal Details and submit now.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form id="form-data">
                                    <hr>

                                    <div class="row">
                                        <!-- Full Name -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="full_name">සම්පූර්ණ නම (Full Name) <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="full_name" name="full_name"
                                                    placeholder="Enter your full name" required>
                                            </div>
                                        </div>

                                        <!-- NIC Number -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="nic">ජාතික හැඳුනුම්පත් අංකය (NIC Number)
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="nic" name="nic"
                                                    placeholder="Enter your national id number" required>
                                            </div>
                                        </div>

                                        <!-- Passport Number -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="passport_number">පාස්පෝට් අංකය (Passport
                                                    Number) </label>
                                                <input type="text" class="form-control" id="passport_number"
                                                    name="passport_number" placeholder="Enter your passport number"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Birthday -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="birthday">උපන් දිනය (Birthday) <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="birthday" name="birthday"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Age -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="age">වයස (Age) <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="age" name="age"
                                                    placeholder="Enter your age" required>
                                            </div>
                                        </div>

                                        <!-- Gender -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="gender">ස්ත්‍රී පුරුෂභාවය (Gender) <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="gender" name="gender" required>
                                                    <option value="">-- Select Gender --</option>
                                                    <option value="male">පුරුෂ (Male)</option>
                                                    <option value="female">ස්ත්‍රී (Female)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Marital Status -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="marital_status">විවාහක අවිවාහක බව
                                                    (Marital Status) <span class="text-danger">*</span></label>
                                                <select class="form-control" id="marital_status" name="marital_status"
                                                    required>
                                                    <option value="">-- Select Marital Status --</option>
                                                    <option value="single">අවිවාහක (Single)</option>
                                                    <option value="married">විවාහක (Married)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Mobile Number -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="mobile_number">ජංගම දුරකතන අංකය (Mobile
                                                    Number) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="mobile_number"
                                                    name="mobile_number" placeholder="Enter your mobile number"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Whatsapp Number -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="whatsapp_number">Whatsapp Number</label>
                                                <input type="text" class="form-control" id="whatsapp_number"
                                                    name="whatsapp_number" placeholder="Enter your WhatsApp number">
                                            </div>
                                        </div>

                                        <!-- Province -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="province_id">Select your Province <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="province_id" name="province_id" required>
                                                    <option value="">-- Select a Province --</option>
                                                    <?php
                                                    $province = new Province(NULL);
                                                    foreach ($province->all() as $province) {
                                                    ?>
                                                        <option value="<?php echo $province['id'] ?>"><?php echo $province['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Current Job -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="current_job">ඔබගේ වෘත්තීය (Your current
                                                    job)</label>
                                                <input type="text" class="form-control" id="current_job"
                                                    name="current_job" placeholder="Enter your current job">
                                            </div>
                                        </div>

                                        <!-- Job Intend to Do Abroad -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="job_abroad">ඔබ නියැලීමට බලාපොරොත්තු වන
                                                    විදේශ රැකියාව (The job you intend to do abroad) <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="job_abroad" name="job_abroad" required>
                                                    <option value="">-- Select a Job Role --</option>
                                                    <?php
                                                    $JobRole = new JobRole(NULL);

                                                    foreach ($JobRole->getActive() as $job_role) {
                                                    ?>
                                                        <option value="<?php echo $job_role['id'] ?>"><?php echo $job_role['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit"
                                            id="create">Register</button>
                                        <input type="hidden" name="create2">
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Development <i class="mdi mdi-heart text-danger"></i> by Solidrow (Pvt) Ltd.
                        </p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>



    <?php include '../admin-panel/assets/main-js.php'; ?>
    <script src="../ajax/js/skills-training-institute.js"></script>

</body>

</html>