<?php

include '../class/include.php';
include './auth.php';



?>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Sl Youth Sri Lanka </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> <!-- Load Data Labels Plugin -->
    <style>
        .modal-dialog {
            pointer-events: none !important;
        }
    </style>

</head>

<body class="someBlock">
    <!-- <body data-layout="horizontal" data-topbar="colored"> -->
    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php
        include './top-header.php';
        ?>
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
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="total-revenue-chart"></div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1">+<span data-plugin="counterup"><?= number_format($all_center_application_count_this_year, 0, 2) ?></span></h4>
                                <p class="text-muted mb-0">Total Applications</p>
                            </div>
                            <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>
                                    <?php
                                    $year = date("Y/m/d");
                                    echo $year;
                                    ?>
                                </span> since this year
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="orders-chart"> </div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1">+<span data-plugin="counterup">
                                        <?= number_format($all_center_student_count_this_year, 0, 2) ?>
                                    </span></h4>
                                <p class="text-muted mb-0">Total Students</p>
                            </div>
                            <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>
                                    <?php
                                    $year = date("Y/m/d");
                                    echo $year;
                                    ?></span> since this year
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="customers-chart"> </div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1">+<span data-plugin="counterup"> <?= number_format($all_center_student_count_nvq_this_year, 0, 2) ?> </span></h4>
                                <p class="text-muted mb-0"> Nvq Student</p>
                            </div>
                            <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>
                                    <?php
                                    $year = date("Y/m/d");
                                    echo $year;
                                    ?></span> since this year
                            </p>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">

                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="growth-chart"></div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1">+ <span data-plugin="counterup"> <?= number_format($all_center_student_count_non_nvq_this_year, 0, 2) ?> </span></h4>
                                <p class="text-muted mb-0">Non Nvq Students</p>
                            </div>
                            <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i> <?php
                                                                                                                                        $year = date("Y/m/d");
                                                                                                                                        echo $year;
                                                                                                                                        ?></span> since this year
                            </p>
                        </div>
                    </div>
                </div> <!-- end col-->



                <div class="row">
                    <div class="col-xl-12">

                        <div class="table-responsive mb-4">

                            <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">



                            </table>

                        </div>

                    </div>

                </div>


            </div>

        </div>
    </div>
    


 




    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $(window).on('load', function() {
                $('#exampleModalCenter').modal('show');

            });
            $('#closeButton').on('click', function() {
                $('#exampleModalCenter').modal('hide');
            });
        });
    </script>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>

    <script src="ajax/js/student-password.js" type="text/javascript"></script>


    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <script src="ajax/js/applications.js" type="text/javascript"></script>
    <script src="ajax/js/dashboard.js" type="text/javascript"></script>

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- init js -->
    <script src="assets/js/pages/ecommerce-datatables.init.js"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <!-- App js -->
    <script src="ajax/js/send-message.js" type="text/javascript"></script>
    <!--<script src="ajax/js/get-live-count.js" type="text/javascript"></script>-->

    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!-- ckeditor -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.2.2/tinymce.min.js"></script>
    <script src="ajax/js/submit-document.js" type="text/javascript"></script>


    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>
        $(document).ready(function() {
            const ctx = document.getElementById('applicationsChart').getContext('2d');

            let applicationsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                            label: "Applications",
                            data: [],
                            backgroundColor: "rgba(54, 162, 235, 0.7)",
                            barThickness: 40,
                            borderRadius: 3
                        },
                        {
                            label: "Total Students",
                            data: [],
                            backgroundColor: "rgba(255, 159, 64, 0.7)",
                            barThickness: 40,
                            borderRadius: 3
                        },
                        {
                            label: "Pass Students",
                            data: [],
                            backgroundColor: "rgba(75, 192, 192, 0.7)",
                            barThickness: 40,
                            borderRadius: 3
                        },
                        {
                            label: "Fail Students",
                            data: [],
                            backgroundColor: "rgba(255, 99, 132, 0.7)",
                            barThickness: 40,
                            borderRadius: 3
                        },
                        {
                            label: "Drop out Students",
                            data: [],
                            backgroundColor: "rgba(153, 102, 255, 0.7)",
                            barThickness: 40,
                            borderRadius: 3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'NonNvq Students Performance Report',
                            font: {
                                size: 18
                            },
                            padding: {
                                top: 10,
                                bottom: 20
                            },
                            color: '#333'
                        },
                        datalabels: {
                            display: true,
                            color: '#000',
                            font: {
                                weight: 'bold',
                                size: 10
                            },
                            formatter: (value) => value,
                            anchor: 'end',
                            align: 'start',
                            offset: 5
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            function fetchData(startYear, endYear, course_type = '', chart_batch = '') {
                if (!startYear || !endYear) {
                    alert("Please select both Start Year and End Year.");
                    return;
                }

                // Show loader before fetching data
                $("#loader").show();

                $.ajax({
                    url: 'ajax/php/chart.php',
                    type: 'POST',
                    data: {
                        start_year: startYear,
                        end_year: endYear,
                        course_type: course_type,
                        chart_batch: chart_batch
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        let years = Object.keys(data);
                        let applications = [],
                            totalStudents = [],
                            passStudents = [],
                            failStudents = [],
                            drop_out_students = [];

                        years.forEach(year => {
                            applications.push(data[year].applications || 0);
                            totalStudents.push(data[year].students || 0);
                            passStudents.push(data[year].pass_students || 0);
                            failStudents.push(data[year].fail_students || 0);
                            drop_out_students.push(data[year].drop_out_students || 0);
                        });

                        applicationsChart.data.labels = years;
                        applicationsChart.data.datasets[0].data = applications;
                        applicationsChart.data.datasets[1].data = totalStudents;
                        applicationsChart.data.datasets[2].data = passStudents;
                        applicationsChart.data.datasets[3].data = failStudents;
                        applicationsChart.data.datasets[4].data = drop_out_students;
                        applicationsChart.update();
                    },
                    error: function() {
                        alert('Error fetching data');
                    },
                    complete: function() {
                        // Hide loader after fetching data
                        $("#loader").hide();
                    }
                });
            }


            let defaultStartYear = $('#start_year').val() ? $('#start_year').val() : 2023;
            let defaultEndYear = $('#end_year').val() ? $('#end_year').val() : new Date().getFullYear();
            fetchData(defaultStartYear, defaultEndYear);

            $('#start_year, #end_year, #course_type, #chart_batch').change(function() {
                let startYear = $('#start_year').val();
                let endYear = $('#end_year').val();
                let course_type = $('#course_type').val() || '';
                let chart_batch = $('#chart_batch').val() || '';

                if (!startYear || !endYear) {
                    alert("Please select both Start Year and End Year.");
                    return;
                }

                if (parseInt(startYear) > parseInt(endYear)) {
                    alert("Start year must be before or equal to End year.");
                    return;
                }


                fetchData(startYear, endYear, course_type, chart_batch);
            });

        });
    </script>




</body>

</html>