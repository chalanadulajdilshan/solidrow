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
                                                <th>Reg No</th>
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
                                                    <td class="text-primary fw-bold"> <?php echo htmlspecialchars($registration['registration_code']) ?></td>
                                                    <td> <?php echo htmlspecialchars($registration['nic']) ?></td>
                                                    <td> <?php echo htmlspecialchars($registration['mobile_number']) ?></td> 
                                                    <td> <?php echo htmlspecialchars($registration['passport_number'] ?? 'N/A') ?></td>
                                                    <td> <?php echo htmlspecialchars($registration['created_at']) ?></td>
                                                    <td>
                                                        <a href="view-baddegama-registration.php?id=<?php echo $registration['id'] ?>">
                                                            <div class="badge bg-pill bg-soft-success font-size-14"><i class="fas fa-eye p-1"></i></div>
                                                        </a>
                                                        <a href="view-baddegama-registration.php?id=<?php echo $registration['id'] ?>&edit=true">
                                                            <div class="badge bg-pill bg-soft-info font-size-14"><i class="fas fa-pencil-alt p-1"></i></div>
                                                        </a>
                                                        <a href="javascript:void(0);" class="delete-registration" data-id="<?php echo $registration['id']; ?>">
                                                            <div class="badge bg-pill bg-soft-danger font-size-14"><i class="fas fa-trash-alt p-1"></i></div>
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
                order: [[6, 'desc']] // Sort by Created At (index 6) by default
            });

            $('.delete-registration').on('click', function() {
                var id = $(this).data('id');
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this registration data!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function() {
                    $.ajax({
                        url: '../ajax/php/baddegama-registration.php',
                        type: 'POST',
                        data: {
                            id: id,
                            action: 'delete'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                swal({
                                    title: "Deleted!",
                                    text: response.message,
                                    type: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                }, function() {
                                    window.location.reload();
                                });
                            } else {
                                swal("Error!", response.message, "error");
                            }
                        },
                        error: function() {
                            swal("Error!", "Request failed. Please try again.", "error");
                        }
                    });
                });
            });
        });
    </script>

</body>

</html>
