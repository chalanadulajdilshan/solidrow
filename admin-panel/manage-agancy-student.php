<!doctype html>
<?php
include '../class/include.php';
include './auth.php';
$DEFULTDATA = new DefaultData();
 
$AGENCY_STUDENT  = new AgancyStudent(NULL);
$res = $AGENCY_STUDENT->getLastID();
$student_id = $res + 1;
$student_id = 'REG/01/'.$_SESSION['id'].$student_id;
?>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Create Agency Student  </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="#" name="description" />
    <meta content="NYSC" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- plugin css -->
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/libs/@chenfengyuan/datepicker/datepicker.min.css">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />

    <link href="plugin/sweetalert/sweetalert.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <style>
        .passport_fields {
            display: none;
            clear: both;
        }
    </style>
</head>

<body class="someBlock">

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->


    <?php include './top-header.php'; ?>
    <?php include './navigation.php'; ?>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Create Agency Student</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                     <!-- Add this after the form section in manage-agancy-student.php -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Students</h4>
                <table id="student-datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th> Reg No</th>
                            <th>Registration Date</th>
                            <th>Mobile Number</th>
                            <th>Passport Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $STUDENT = new AgancyStudent(NULL);
                        $students = [];
                        $loggedInUser = new User($_SESSION['id']);

                        if ($loggedInUser->type == 3 && !empty($loggedInUser->agent_user_id)) {
                            $students = $STUDENT->getByAgent($loggedInUser->agent_user_id);
                        } elseif ($loggedInUser->type == 2 && !empty($loggedInUser->staff_user_id)) {
                            $students = $STUDENT->getByStaff($loggedInUser->staff_user_id);
                        } else {
                            $students = $STUDENT->all();
                        }

                        if ($students) {
                            foreach ($students as $key=>$student) {
                                $key++;
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($key); ?></td>
                                <td><?php echo htmlspecialchars($student['registration_no']); ?></td>
                                <td><?php echo !empty($student['registration_date']) ? date('Y-m-d', strtotime($student['registration_date'])) : 'N/A'; ?></td>
                                <td><?php echo htmlspecialchars($student['phone_number'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($student['passport_number'] ?? 'N/A'); ?></td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                       href="create-agancy-student.php?id=<?php echo (int) $student['id']; ?>">
                                        <i class="fas fa-edit"></i> Manage
                                    </a>
                                </td>
                            </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="5" class="text-center">No students found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- View Student Modal -->
<div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewStudentModalLabel">Student Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="studentDetails">
                <!-- Student details will be loaded here via AJAX -->
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add this script section at the bottom of the file, before the closing body tag -->
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#student-datatable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print', 'colvis'
        ],
        order: [[0, 'desc']],
        pageLength: 10
    });

    // Handle view student button click
    $(document).on('click', '.view-student', function() {
        const studentId = $(this).data('id');
        const modal = $('#viewStudentModal');
        
        // Show loading state
        $('#studentDetails').html(`
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `);
        
        // Load student details via AJAX
        $.ajax({
            url: 'ajax/php/agancy-student.php',
            type: 'POST',
            data: { 
                get_student: true, 
                id: studentId 
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const student = response.student;
                    let html = `
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Candidate Reg No:</strong> ${student.student_id || 'N/A'}</p>
                                <p><strong>Registration Date:</strong> ${student.registration_date ? new Date(student.registration_date).toLocaleDateString() : 'N/A'}</p>
                                <p><strong>Full Name:</strong> ${student.full_name || 'N/A'}</p>
                                <p><strong>Name with Initials:</strong> ${student.name_with_initials || 'N/A'}</p>
                                <p><strong>Date of Birth:</strong> ${student.dob || 'N/A'}</p>
                                <p><strong>Gender:</strong> ${student.gender || 'N/A'}</p>
                                <p><strong>NIC/Passport No:</strong> ${student.nic_passport_no || 'N/A'}</p>
                                <p><strong>Passport Expiry Date:</strong> ${student.passport_expiry_date || 'N/A'}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Address:</strong> ${student.address || 'N/A'}</p>
                                <p><strong>Mobile Number:</strong> ${student.mobile || 'N/A'}</p>
                                <p><strong>WhatsApp Number:</strong> ${student.whatsapp || 'N/A'}</p>
                                <p><strong>Email:</strong> ${student.email || 'N/A'}</p>
                                <p><strong>Education Qualification:</strong> ${student.education_qualification || 'N/A'}</p>
                                <p><strong>Work Experience:</strong> ${student.work_experience || 'N/A'}</p>
                                <p><strong>Status:</strong> 
                                    <span class="badge ${student.is_active == 1 ? 'bg-success' : 'bg-danger'}">
                                        ${student.is_active == 1 ? 'Active' : 'Inactive'}
                                    </span>
                                </p>
                            </div>
                        </div>
                    `;
                    $('#studentDetails').html(html);
                } else {
                    $('#studentDetails').html(`
                        <div class="alert alert-danger" role="alert">
                            Error loading student details. Please try again.
                        </div>
                    `);
                }
            },
            error: function() {
                $('#studentDetails').html(`
                    <div class="alert alert-danger" role="alert">
                        Error loading student details. Please try again.
                    </div>
                `);
            }
        });
    });
});
</script>
                    </div>
                </div>

                <input type="hidden" name="id" id="student_db_id" value="">

                </form>

            </div>
        </div>
    </div>







    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

    <!-- plugins -->
    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>

    <!-- init js -->
    <script src="assets/js/pages/form-advanced.init.js"></script>

    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/js/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>


    <script src="ajax/js/agancy-student.js" type="text/javascript"></script>
    <script src="ajax/js/district.js" type="text/javascript"></script>
    <script src="ajax/js/dsdivision.js" type="text/javascript"></script>
    <script src="ajax/js/gramaniladari.js" type="text/javascript"></script>

    <script src="assets/js/app.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- JavaScript to show/hide related qualification fields -->

  


   

    


</body>

</html>