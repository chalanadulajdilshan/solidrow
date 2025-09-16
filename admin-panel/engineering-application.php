<?php
include '../class/include.php';
include './auth.php';
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
                                        <form id="form-data" > 
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
                                                        <select class="form-control" name="province_id" id="province_id"
                                                            required>
                                                            <option value="">-- Select your Province --</option>
                                                            <option value="Central">Central</option>
                                                            <option value="Eastern">Eastern</option>
                                                            <option value="North Central">North Central</option>
                                                            <option value="North Western">North Western</option>
                                                            <option value="Northern">Northern</option>
                                                            <option value="Sabaragamuwa">Sabaragamuwa</option>
                                                            <option value="Southern">Southern</option>
                                                            <option value="Uva">Uva</option>
                                                            <option value="Western">Western</option>
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
                                                            <option value="Unskilled Construction">නුපුහුණු ඉදිකිරීම් සේවක (Unskilled Construction Worker)</option>
                                                            <option value="Warehouse Helper"> ගබඩා සහයක (Warehouse Helper)</option>
                                                            <option value="Diesel Mechanic">ඩීසල් කාර්මිකයා (Diesel Mechanic)</option>
                                                            <option value="Diesel Mechanic">සැහැල්ලු වාහන කාර්මික (Car Mechanic Light Vehicle)</option>
                                                            <option value="Hydraulic Mechanic">හයිඩ්‍රලික් කාර්මිකයා (Hydraulic Mechanic)</option>
                                                            <option value="electrician">විදුලි කාර්මික ශිල්පී (Electrician - Insdustrial)</option>
                                                            <option value="Spray Painter">වාහන පින්තාරු ශිල්පී (Spray Painter) </option>
                                                            <option value="steel_fabricator">ලෝහ පිරිසැකසුම්වරයා (SteelFabricator)</option>
                                                            <option value="steel_fixer">කම්බි නැවුම් ශිල්පී (Steel Fixer / Bar Bender)</option>
                                                            <option value="shuttering_carpenter">සැටලින් වඩුකාර්මික (Shuttering Carpenter)</option>
                                                            <option value="tile_fixer">ටයිල් අතුරන්නා (Tile Fixer)</option>
                                                            <option value="block_mason">බිත්ති බදින්නා (Block Mason)</option>
                                                            <option value="plasterer">කපරාරුකරුවා (Plasterer)</option>
                                                            <option value="aluminium_fabricator">ඇලුමීනියම් පිරිසැකසුම් ශිල්පී (Aluminium Fabrication)</option>
                                                            <option value="pipe_fitter">පයිප්ප සවිකරන්නා (Pipe Fitter)</option>
                                                            <option value="plumber">ජලනල සවිකරන්නා (Plumber)</option>
                                                            <option value="wall_painter">බිත්ති පින්තාරු ශිල්පීයා (Wall Painter)</option>
                                                            <option value="foreman">වැඩ පරීක්ෂකවරයා (Foreman)</option>
                                                            <option value="civil_engineer">සිවිල් ඉංජිනේරුවරයා (Civil Engineer)</option>
                                                            <option value="finishing_carpenter">වඩුකාර්මික (Finishing Carpenter)</option>
                                                            <option value="Interlock"> ඉන්ටර්ලොක් අතුරන්නා (Interlock) </option>
                                                            <option value="Excavator Operator"> කැණීම් යන්ත්‍ර ක්‍රියාකරු (Excavator Operator)</option>
                                                            <option value="JCB Operator"> JBC ක්‍රියාකරු (JCB Operator)</option>
                                                            <option value="Grinder Operator">ඇඹරුම් යන්ත්‍ර ක්‍රියාකරු (Grinder Operator)</option>
                                                            <option value="Kitchen Helper"> හෝටල් මුළුතැන්ගෙයි සහායක (Kitchen Helper)</option>
                                                            <option value="Cleaner"> පිරිසිදු කරන්නා (Cleaner)</option>
                                                            <option value="Fastfood Worker"> ක්ෂණික ආහාර සේවකයා (Fastfood Worker)</option>
                                                            <option value="Cook"> කෝකිවරු (Cook) </option>
                                                            <option value="Barman"> බාර්මන් (Barman) </option>
                                                            <option value="Steward/Waiter"> භෝජනාගාර සේවකයා (Steward/Waiter) </option>
                                                            <option value=" Light Vehicle Driver"> සැහැල්ලු රියදුරු (Light Vehicle Driver)</option>
                                                            <option value="Heavy Vehicle Driver "> Heavy Vehicle Driver (බර වාහන රියදුරු)</option>
                                                            <option value="Car Washer"> වහන සෝදන්නා (Car Washer)</option>
                                                            <option value="MIG Welder">MIG පෑස්සුම් ශිල්පි (MIG Welder)</option>
                                                            <option value="TIG Welder">TIG පෑස්සුම් ශිල්පි (TIG Welder)</option>
                                                            <option value="Lathe Machine Operator"> Lathe Machine Operator </option>
                                                            <option value="CNC Operator"> CNC යන්ත්‍ර ක්‍රියාකරු (CNC Operator)</option>
                                                            <option value="Auto Electrician">වාහන විදුලි කාර්මික (Auto Electrician) </option>


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
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <?php include './assets/main-js.php'; ?>
    <script src="ajax/js/user.js" type="text/javascript"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>