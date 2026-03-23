<?php
include '../class/include.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Registration Form | Solidrow Festi (Pvt) Ltd</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Registration Form" name="description" />
    <meta content="Solidrow" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../admin-panel/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="../admin-panel/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../admin-panel/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css -->
    <link href="../admin-panel/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- SweetAlert2 -->
    <link href="../admin-panel/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <style>
        body {
            background-color: #f4f7fe;
        }

        .header-banner {
            background: linear-gradient(90deg, #051937, #004d7a, #008793, #00bf72, #a8eb12);
            /* Fallback or specific Solidrow styling if needed */
            background-image: url('../admin-panel/assets/images/header-bg.png'); /* Assuming there's a header background */
            background-size: cover;
            background-position: center;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-bottom: 20px;
            border-radius: 0 0 15px 15px;
        }

        .header-logo {
            max-width: 100%;
            height: auto;
        }

        .registration-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 50px;
        }

        .card-title-main {
            color: #5b73e8;
            font-weight: 600;
            text-align: center;
            margin-top: 20px;
        }

        .card-subtitle-main {
            text-align: center;
            color: #74788d;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
        }

        .btn-register {
            background-color: #5b73e8;
            border-color: #5b73e8;
            padding: 10px 30px;
            font-weight: 600;
        }

        .btn-register:hover {
            background-color: #465ed1;
            border-color: #465ed1;
        }
        
        /* Banner Mimic from Image */
        .banner-container {
            background-color: #001f3f;
            padding: 20px;
            text-align: center;
            color: white;
            border-radius: 5px 5px 0 0;
        }
        
        .banner-logo {
            max-height: 100px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body class="someBlock">

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Updated Banner matching screenshot -->
                <div class="banner-container d-flex align-items-center p-0" style="background-color: #0000007d; border-radius: 15px 15px 0 0;">
                   <div style="width: 100%; padding: 0px 20px 20px; display: flex; align-items: center; justify-content: center; position: relative;">
                        <div style="display: flex; flex-direction: column; align-items: center; z-index: 2; width: 100%; max-width: 800px; justify-content: center;">
                            <img src="Agency Logo 2026 New.png" alt="SOLIDROW" style="max-height: 150px;">
                            <div class="text-center">
                                <h1 style="color: white; font-weight: 700; margin: 0; font-size: 2.8rem; letter-spacing: 1px;">SOLIDROW FESTI (PVT) LTD</h1>
                                <h4 style="color: #ffcc00; font-weight: 700; margin: 10px 0 5px; font-size: 1.4rem; text-transform: uppercase;">FOREIGN EMPLOYMENT AGENCY</h4>
                                <p style="color: white; margin: 0; font-size: 1.1rem; font-weight: 500;">LICENCE NUMBER. - 3583</p>
                            </div>
                        </div>
                   </div>
                </div>

                <div class="card registration-card">
                    <div class="card-body p-4">
                        <h3 class="card-title-main">Registration Form</h3>
                        <p class="card-subtitle-main">Fill your Personal Details and submit now.</p>

                        <form id="form-data">
                            <div class="row">
                                <!-- Personal Details Section -->
                                <div class="col-12">
                                    <h5 class="mb-3 text-primary border-bottom pb-2">Personal Details</h5>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="full_name">සම්පූර්ණ නම (Full Name) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your full name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nic">ජාතික හැඳුනුම්පත් අංකය (NIV Number) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nic" name="nic" placeholder="Enter your national id number">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="passport_number">පාස්පෝට් අංකය (Passport Number)</label>
                                    <input type="text" class="form-control" id="passport_number" name="passport_number" placeholder="Enter your passport number">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="birthday">උපන් දිනය (Birthday) <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="birthday" name="birthday">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="age">වයස (Age) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="age" name="age" placeholder="Enter your age">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="gender">ස්ත්‍රී පුරුෂභාවය (Gender) <span class="text-danger">*</span></label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">-- Select Gender --</option>
                                        <option value="male">පුරුෂ (Male)</option>
                                        <option value="female">ස්ත්‍රී (Female)</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="marital_status">විවාහක අවිවාහක බව (Marital Status) <span class="text-danger">*</span></label>
                                    <select class="form-control" id="marital_status" name="marital_status">
                                        <option value="">-- Select Marital Status --</option>
                                        <option value="single">අවිවාහක (Single)</option>
                                        <option value="married">විවාහක (Married)</option>
                                    </select>
                                </div>

                                <!-- Contact Details -->
                                <div class="col-12 mt-3">
                                    <h5 class="mb-3 text-primary border-bottom pb-2">Contact Details</h5>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="mobile_number">ජංගම දුරකතන අංකය (Mobile Number) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter your mobile number">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="whatsapp_number">Whatsapp Number</label>
                                    <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" placeholder="Enter your WhatsApp number">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="province_id">Select your Province <span class="text-danger">*</span></label>
                                    <select class="form-control" name="province_id" id="province_id">
                                        <option value="">-- Select your Province --</option>
                                        <?php
                                        $PROVINCE = new Province(NULL);
                                        foreach ($PROVINCE->all() as $province) {
                                            echo "<option value='{$province['id']}'>{$province['name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Professional & Travel Details -->
                                <div class="col-12 mt-3">
                                    <h5 class="mb-3 text-primary border-bottom pb-2">Professional & Travel Details</h5>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="current_job">ඔබගේ වෘත්තීය (Your current job)</label>
                                    <input type="text" class="form-control" id="current_job" name="current_job" placeholder="Enter your current job">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="experience">සේවා පළපුරුද්ද (Working exp. years)</label>
                                    <input type="number" class="form-control" id="experience" name="experience" placeholder="Enter your years of experience">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="destination_country">බලාපොරොත්තු වන රට (Destination country)</label>
                                    <select class="form-control" id="destination_country" name="destination_country">
                                        <option value="">-- Select Destination Country --</option>
                                        <?php
                                        $Country = new Country(NULL);
                                        foreach ($Country->all() as $country) {
                                            echo "<option value='{$country['id']}'>{$country['name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-end">
                                    <button type="submit" id="create" class="btn btn-primary btn-register">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="../admin-panel/assets/libs/jquery/jquery.min.js"></script>
    <script src="../admin-panel/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../admin-panel/assets/libs/sweetalert2/sweetalert2.min.js"></script>
    
    <style>
        .custom-preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Poppins', sans-serif;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-bottom: 15px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
    <!-- Preloader Implementation -->
    <script>
        $.fn.preloader = function(action) {
            if (action === 'remove') {
                $('.custom-preloader').fadeOut(300, function() {
                    $(this).remove();
                });
            } else {
                if ($('.custom-preloader').length === 0) {
                    var loader = $('<div class="custom-preloader"><div class="spinner"></div><div style="font-weight: 600; font-size: 1.1rem; letter-spacing: 1px;">PROCESSING...</div></div>');
                    $('body').append(loader.hide().fadeIn(300));
                }
            }
        };
    </script>

    <script src="../ajax/js/baddegama-registration.js"></script>

</body>

</html>
