<?php
$US = new User($_SESSION['id']);

?>

<div class="vertical-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" width="70%">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" width="70%">
            </span>
        </a>
        <a href="index.php" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" width="70%">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" width="70%">
            </span>
        </a>
    </div>
    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>
    <div data-simplebar class="sidebar-menu-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">



                <li class="menu-title">User Management</li>
                <li>
                    <a href="create-users.php ">
                        <i class="bx bx bx-user-plus  "></i>
                        <span>Manage Users</span>
                    </a>
                </li>
                <li>
                    <a href="manage-user-type.php">
                        <i class="bx  bx-user"></i>
                        <span>Manage User Type</span>
                    </a>
                </li>


                <li class="menu-title">Navigation</li>
                <li>
                    <a href="index.php">
                        <i class="bx bx-home "></i>
                        <span>Dashboard </span>
                    </a>
                </li>


                <li class="menu-title">MIS Management Panel</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="   bx bx-book  "></i>
                        <span>Courses</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="manage-course-trade.php">Manage Course Trade</a></li>
                        <li><a href="create-courses.php">Create Courses</a></li>
                        <li><a href="manage-courses.php">Manage Courses</a></li>
                        <!--<li><a href="manage-courses-by-centers.php">Drop Out By Course</a></li>-->

                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>