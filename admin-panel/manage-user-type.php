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
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create User Type.</h4>
                                    <form id="form-data">
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Center Type Title</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="name" name="name" placeholder="Enter name">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                <button class="btn btn-primary " type="submit" id="create">Create</button>
                                                <input type="hidden" name="create">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage User Type</h4>

                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>User Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $USER_TYPE = new UserType(NULL);
                                            foreach ($USER_TYPE->all() as $key => $user_type) {
                                                $key++;
                                            ?>
                                                <tr id="div<?php echo $user_type['id'] ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td> <?php echo $user_type['name'] ?></td>
                                                    <td>
                                                        <a href="edit-user-type.php?id=<?php echo $user_type['id'] ?>">

                                                            <div class="badge bg-pill bg-soft-success font-size-14"><i class="fas fa-pencil-alt p-1"></i></div>
                                                        </a>
                                                        <!-- <a href="manage-courses.php?id=<?php echo $user_type['id'] ?>"><div class="badge bg-pill bg-soft-warning font-size-14"><i class="fas fa-address-card p-1"></i></div></a>   -->

                                                        <!--  <a href="#">
                                                            <div class="badge bg-pill bg-soft-danger font-size-14 delete-data" data-id="<?php echo $user_type['id']; ?>"><i class="fas fa-trash-alt p-1"></i></div>
                                                        </a>-->
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