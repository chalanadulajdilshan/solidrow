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
                                <div class="card-body">

                                    <h4 class="card-title">Add User</h4>
                                    <form id="form-data">
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">User Type</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="type" id="type" onchange="loadUsersByType(this.value)">
                                                    <option value="">-- Select User type -- </option>
                                                    <?php
                                                    $USER_TYPE = new UserType(NULL);
                                                    foreach ($USER_TYPE->all() as $user_type) {
                                                    ?>
                                                        <option value="<?php echo $user_type['id'] ?>"><?php echo $user_type['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="fullname" class="col-md-2 col-form-label">Full Name</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="fullname" id="fullname" required>
                                                    <option value="">-- Select User type first --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">User Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="url" id="username" name="username" placeholder="Enter username">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Password</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="password" id="password" name="password" placeholder="Enter password">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 text-end">
                                                <button class="btn btn-primary" type="submit" id="create">Create</button>
                                                <input type="hidden" name="create">
                                            </div>
                                        </div>
                                    </form>

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