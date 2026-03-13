<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Manage Baddegama Registration | Solidrow </title>
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
                                <h4 class="mb-0">Baddegama Registration</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Manage Baddegama Registration</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                  

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage All Registrations</h4>

                                    <table id="baddegama-datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Full Name</th> 
                                                <th>NIC</th>
                                                <th>Mobile Number</th> 
                                                <th>Passport No</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $REGISTRATION = new BaddegamaRegistration(NULL);
                                            foreach ($REGISTRATION->all() as $key => $registration) {
                                                $key++;
                                                ?>
                                                <tr id="div<?php echo $registration['id'] ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td> <?php echo htmlspecialchars($registration['full_name']) ?></td>
                                                    <td> <?php echo htmlspecialchars($registration['nic']) ?></td>
                                                    <td> <?php echo htmlspecialchars($registration['mobile_number']) ?></td> 
                                                    <td> <?php echo htmlspecialchars($registration['passport_number'] ?? 'N/A') ?></td>
                                                    <td> <?php echo htmlspecialchars($registration['created_at']) ?></td>
                                                    <td>
                                                        <a href="view-baddegama-registration.php?id=<?php echo $registration['id'] ?>">
                                                            <div class="badge bg-pill bg-soft-success font-size-14"><i class="fas fa-eye p-1"></i></div>
                                                        </a>
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
    
    <script>
        $(document).ready(function() {
            $('#baddegama-datatable').DataTable({
                responsive: true,
                order: [[5, 'desc']] // Sort by Created At by default
            });
        });
    </script>

</body>

</html>
