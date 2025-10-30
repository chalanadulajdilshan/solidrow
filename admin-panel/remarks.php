<?php
include '../class/include.php';
include './auth.php';

// Initialize variables to avoid undefined index notices
$remarks = [];
$count = 1;

// Get all remarks
$REMARK = new Remark(NULL);
$remarks = $REMARK->all();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Remark Management | Solidrow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include './assets/main-css.php'; ?>
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="someBlock">
    <div id="layout-wrapper">
        <?php include './top-header.php'; ?>
        <?php include './navigation.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Create Remark -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add New Remark</h4>
                                    <form id="form-data">
                                        <input type="hidden" id="remark_id" name="remark_id">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label>Remark</label>
                                                <textarea id="remark" name="remark" class="form-control" placeholder="Enter remark" rows="3" required></textarea>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" id="create" class="btn btn-primary">Save Remark</button>
                                                <button type="button" id="update" class="btn btn-success" style="display: none;">Update Remark</button>
                                                <button type="button" id="new" class="btn btn-secondary">New</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Remark List -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Remark List</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Remark</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($remarks)) {
                                                    foreach ($remarks as $remark) {
                                                        echo "<tr>";
                                                        echo "<td>" . $count++ . "</td>";
                                                        echo "<td>" . htmlspecialchars($remark['remark']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($remark['created_at']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($remark['updated_at']) . "</td>";
                                                        echo "<td>";
                                                        echo "<button class='btn btn-sm btn-warning edit-remark' data-id='" . htmlspecialchars($remark['id']) . "' data-remark='" . htmlspecialchars($remark['remark']) . "'><i class='mdi mdi-pencil'></i></button> ";
                                                        echo "<button class='btn btn-sm btn-danger delete-remark' data-id='" . htmlspecialchars($remark['id']) . "'><i class='mdi mdi-delete'></i></button>";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="5" class="text-center">No remarks found</td></tr>';
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
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle form submission for create
            $('#form-data').on('submit', function(e) {
                e.preventDefault();
                
                var remark = $('#remark').val().trim();
                if (!remark) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Please enter a remark'
                    });
                    $('#remark').focus();
                    return;
                }
                
                var formData = new FormData(this);
                formData.append('create', true);

                $.ajax({
                    url: 'ajax/php/remark.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Remark saved successfully',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error saving remark'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error saving remark'
                        });
                    }
                });
            });

            // Handle edit button click
            $(document).on('click', '.edit-remark', function() {
                var id = $(this).data('id');
                var remark = $(this).data('remark');

                $('#remark_id').val(id);
                $('#remark').val(remark);

                $('#create').hide();
                $('#update').show();

                // Scroll to form
                $('html, body').animate({
                    scrollTop: $("#form-data").offset().top - 100
                }, 500);
            });

            // Handle update button click
            $('#update').on('click', function() {
                var remark = $('#remark').val().trim();
                if (!remark) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Please enter a remark'
                    });
                    $('#remark').focus();
                    return;
                }
                
                var formData = new FormData($('#form-data')[0]);
                formData.append('update', true);

                $.ajax({
                    url: 'ajax/php/remark.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Remark updated successfully',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error updating remark'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error updating remark'
                        });
                    }
                });
            });

            // Handle delete button click
            $(document).on('click', '.delete-remark', function() {
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'ajax/php/remark.php',
                            type: 'POST',
                            data: {
                                delete: true,
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: 'Remark has been deleted.',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Error deleting remark'
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error deleting remark'
                                });
                            }
                        });
                    }
                });
            });

            // Handle new button click
            $('#new').click(function() {
                $('#form-data')[0].reset();
                $('#remark_id').val('');
                $('#create').show();
                $('#update').hide();
            });
        });
    </script>
</body>

</html>
