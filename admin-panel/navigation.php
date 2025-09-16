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
                <li>
                    <a href="staff.php">
                        <i class="bx  bx-user"></i>
                        <span>Manage Staff</span>
                    </a>
                </li>

                <li class="menu-title">Main Panel</li>
                <li>
                    <a href="index.php">
                        <i class="bx bx-home "></i>
                        <span>Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="Company.php">
                        <i class="bx bx-building "></i>
                        <span>Company </span>
                    </a>
                </li>
                <li>
                    <a href="project.php">
                        <i class="bx bx-briefcase "></i>
                        <span>Project </span>
                    </a>
                </li>
                <li>
                    <a href="country.php">
                        <i class="bx bx-globe "></i>
                        <span>Country </span>
                    </a>
                </li>
                <li>
                    <a href="course.php">
                        <i class="bx bx-book-content "></i>
                        <span>Course </span>
                    </a>
                </li>
                <li>
                    <a href="jobs.php">
                        <i class="bx bx-book "></i>
                        <span>Job Category</span>
                    </a>
                </li>
                <li>
                    <a href="jobs.php">
                        <i class="bx bx-briefcase "></i>
                        <span>Job </span>
                    </a>
                </li>
                <li>
                    <a href="job-listings.php">
                        <i class="bx bx-list-ul "></i>
                        <span>Job Listings </span>
                    </a>
                </li>
                <li>
                    <a href="career-applications.php">
                        <i class="bx bx-file"></i>
                        <span>Career Applications </span>
                    </a>
                </li>

                <li class="menu-title">Solidrow Engineering (Pvt) Ltd</li>
                <li>
                    <a href="engineering-application.php">
                        <i class="bx bx-file "></i>
                        <span>Application Form</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="   bx bx-phone  "></i>
                        <span>Call Center</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="all-engineering-applications.php">Applications</a></li>
                        <li><a href="staff-engineering-applications.php">My Applications</a></li>
                </li>
                <li>
                    <a href="jobs.php">
                        <i class="bx bx-dollar-circle "></i>
                        <span>My Commissions </span>
                    </a>
                </li>
                <li class="menu-title">Solidrow Foreign Engineering Skills Training Institute</li>
                <li class="menu-title">Solidrow Foreign Employment Agency</li>
                <li class="menu-title">Solidrow Visa Consultancy Services</li>
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