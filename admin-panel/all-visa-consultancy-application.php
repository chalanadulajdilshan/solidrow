<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>User Type | Youth Service LTD </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
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
                  

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage All Applications</h4>

                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Full Name</th> 
                                                <th>Passport Number</th>
                                                <th>Mobile Number</th> 
                                                <th>Current Job</th>
                                                <th>Job Abroad</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $VISA_CONSULTANCY_APPLICATION = new VisaConsultancyApplication(NULL);
                                            foreach ($VISA_CONSULTANCY_APPLICATION->getApplicationsByWithOutStaffId() as $key => $visa_consultancy_application) {
                                                $key++;
                                                $JOB_ROLES = new JobRole($visa_consultancy_application['job_abroad']);
                                                ?>
                                                <tr id="div<?php echo $visa_consultancy_application['id'] ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td> <?php echo $visa_consultancy_application['full_name'] ?></td>
                                                    <td> <?php echo $visa_consultancy_application['passport_number'] ?></td>
                                                    <td> <?php echo $visa_consultancy_application['mobile_number'] ?></td> 
                                                    <td> <?php echo $visa_consultancy_application['current_job'] ?></td>
                                                    <td> <?php echo $JOB_ROLES->name?></td>
                                                    <td> <?php echo $visa_consultancy_application['created_at'] ?></td>
                                                    <td>
                                                        <a href="view-visa-consultancy-application.php?id=<?php echo $visa_consultancy_application['id'] ?>">

                                                            <div class="badge bg-pill bg-soft-success font-size-14"><i class="fas fa-eye p-1"></i></div>
                                                        </a>
                                                       
                                                        <?php

                                                        ?>
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


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <?php include './assets/main-js.php'; ?>
    
    <script src="ajax/js/user-type.js" type="text/javascript"></script>

</body>

</html>