<?php
include '../class/include.php';
include './auth.php';

// Initialize variables to avoid undefined index notices
$countries = [];
$count = 1;

// Get all countries with default commission rate if not set
$COUNTRY = new Country(NULL);
$countries = $COUNTRY->all();

// Ensure each country has a commission_rate
foreach ($countries as &$country) {
    if (!isset($country['commission_rate'])) {
        $country['commission_rate'] = '0.00'; // Default commission rate
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Country Management | Solidrow</title>
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
                    <!-- Create Country -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add New Country</h4>
                                    <form id="form-data" enctype="multipart/form-data">
                                        <input type="hidden" id="country_id" name="country_id">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Country Name</label>
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter country name" required>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label>Commission Rate (LKR)</label>
                                                <div class="input-group">
                                                    <input type="number" step="0.01" id="commission_rate" name="commission_rate" class="form-control" placeholder="e.g., 5000.00" required>
                                                    <span class="input-group-text">LKR</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3 d-flex align-items-end">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="activeStatus" name="activeStatus" checked>
                                                    <label class="form-check-label" for="activeStatus">Active</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" id="create" class="btn btn-primary">Save Country</button>
                                                <button type="button" id="update" class="btn btn-success" style="display: none;">Update Country</button>
                                                <button type="button" id="new" class="btn btn-secondary">New</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Country List -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Country List</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Country Name</th>
                                                    <th>Commission Rate</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($countries)) {
                                                    foreach ($countries as $country) {
                                                        $status = $country['is_active'] ? 'Active' : 'Inactive';
                                                        $statusClass = $country['is_active'] ? 'success' : 'danger';
                                                        echo "<tr>";
                                                        echo "<td>" . $count++ . "</td>";
                                                        echo "<td>" . htmlspecialchars($country['name']) . "</td>";
                                                        echo "<td>LKR " . number_format(htmlspecialchars($country['commission_rate'] ?? '0.00'), 2) . "</td>";
                                                        echo "<td><span class='badge bg-$statusClass'>$status</span></td>";
                                                        echo "<td>";
                                                        echo "<button class='btn btn-sm btn-warning edit-country' data-id='" . htmlspecialchars($country['id']) . "' data-name='" . htmlspecialchars($country['name']) . "' data-rate='" . htmlspecialchars($country['commission_rate'] ?? '0.00') . "' data-status='" . $country['is_active'] . "'><i class='mdi mdi-pencil'></i></button> ";
                                                        echo "<button class='btn btn-sm btn-danger delete-country' data-id='" . htmlspecialchars($country['id']) . "'><i class='mdi mdi-delete'></i></button>";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="5" class="text-center">No countries found</td></tr>';
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
    <script src="ajax/js/country.js"></script>
    <script>
        $(document).ready(function() {
            // Handle edit button click
            $(document).on('click', '.edit-country', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var rate = $(this).data('rate');
                var status = $(this).data('status');

                $('#country_id').val(id);
                $('#name').val(name);
                $('#commission_rate').val(rate);
                $('#activeStatus').prop('checked', status == 1);

                $('#create').hide();
                $('#update').show();

                // Scroll to form
                $('html, body').animate({
                    scrollTop: $("#form-data").offset().top - 100
                }, 500);
            });

            // Handle delete button click
            $(document).on('click', '.delete-country', function() {
                var id = $(this).data('id');

                if (confirm('Are you sure you want to delete this country?')) {
                    $.ajax({
                        url: 'ajax/php/country.php',
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
                                alert('Error deleting country');
                            }
                        },
                        error: function() {
                            alert('Error deleting country');
                        }
                    });
                }
            });

            // Handle new button click
            $('#new').click(function() {
                $('#form-data')[0].reset();
                $('#country_id').val('');
                $('#create').show();
                $('#update').hide();
            });
        });
    </script>
</body>

</html>