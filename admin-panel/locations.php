<?php
include '../class/include.php';
include './auth.php';

$count = 1;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Location Management | Solidrow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include './assets/main-css.php'; ?>
</head>

<body class="someBlock">
    <div id="layout-wrapper">
        <?php include './top-header.php'; ?>
        <?php include './navigation.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Create Location -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add New Location</h4>
                                    <form id="form-data" enctype="multipart/form-data">
                                        <input type="hidden" id="location_id" name="location_id">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Location Name</label>
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter location name" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Foreign Agent</label>
                                                <input type="text" id="agent" name="agent" class="form-control" placeholder="Enter agent name">
                                            </div>
                                            <div class="col-12 mt-2">
                                                <button type="submit" id="create" class="btn btn-primary">Save Location</button>
                                                <button type="submit" id="update" class="btn btn-success" style="display: none;">Update Location</button>
                                                <button type="button" id="new" class="btn btn-secondary">New</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Location List -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Location List</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Location Name</th>
                                                    <th>Foreign Agent</th>
                                                    <th>Active (Reg)</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $LOCATION = new Location(NULL);
                                                $locations = $LOCATION->all();

                                                if (!empty($locations)) {
                                                    foreach ($locations as $location) {
                                                        echo "<tr>";
                                                        echo "<td>" . $count++ . "</td>";
                                                        echo "<td>" . htmlspecialchars($location['name']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($location['agent'] ?? '') . "</td>";
                                                        echo "<td>";
                                                        if ($location['is_active_registration']) {
                                                            echo '<span class="badge bg-success">Active</span>';
                                                        } else {
                                                            echo '<button class="btn btn-sm btn-outline-info set-active-reg" data-id="' . htmlspecialchars($location['id']) . '">Set Active</button>';
                                                        }
                                                        echo "</td>";
                                                        echo "<td>";
                                                        echo "<button class='btn btn-sm btn-warning edit-location' data-id='" . htmlspecialchars($location['id']) . "' data-name='" . htmlspecialchars($location['name']) . "' data-agent='" . htmlspecialchars($location['agent'] ?? '') . "'><i class='mdi mdi-pencil'></i></button> ";
                                                        echo "<button class='btn btn-sm btn-danger delete-location' data-id='" . htmlspecialchars($location['id']) . "'><i class='mdi mdi-delete'></i></button>";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="3" class="text-center">No locations found</td></tr>';
                                                }
                                                ?>
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
    </div>

    <?php include './assets/main-js.php'; ?>
    <script src="ajax/js/location.js"></script>
    <script>
        $(document).ready(function() {
            // Handle form submission
            $('#form-data').on('submit', function(e) {
                e.preventDefault();

                if ($('#update').is(':visible')) {
                    // Trigger update handled in location.js
                } else {
                    // Trigger create handled in location.js
                }
            });

            // Handle edit button click
            $(document).on('click', '.edit-location', function(e) {
                e.preventDefault();

                var id = $(this).data('id');
                var name = $(this).data('name');
                var agent = $(this).data('agent');

                $('#location_id').val(id);
                $('#name').val(name);
                $('#agent').val(agent);

                $('#create').hide();
                $('#update').show();

                // Scroll to form
                $('html, body').animate({
                    scrollTop: $("#form-data").offset().top - 100
                }, 500);
            });

            // Handle set active for registration
            $(document).on('click', '.set-active-reg', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    url: 'ajax/php/location.php',
                    type: 'POST',
                    data: {
                        set_active: true,
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            location.reload();
                        } else {
                            swal("Error!", "Failed to update status", "error");
                        }
                    }
                });
            });

            // Handle delete button click
            $(document).on('click', '.delete-location', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                if (confirm('Are you sure you want to delete this location?')) {
                    $.ajax({
                        url: 'ajax/php/location.php',
                        type: 'POST',
                        data: {
                            delete: true,
                            id: id
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                location.reload();
                            } else {
                                swal({
                                    title: "Error!",
                                    text: "Failed to delete location. Please try again.",
                                    type: 'error',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        },
                        error: function() {
                            swal({
                                title: "Error!",
                                text: "An error occurred while deleting the location.",
                                type: 'error',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });

            // Handle new button click
            $('#new').click(function() {
                $('#form-data')[0].reset();
                $('#location_id').val('');
                $('#create').show();
                $('#update').hide();
                // Scroll to form
                $('html, body').animate({
                    scrollTop: $("#form-data").offset().top - 100
                }, 500);
            });
        });
    </script>
</body>

</html>
