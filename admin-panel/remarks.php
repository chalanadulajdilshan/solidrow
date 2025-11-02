<?php
include '../class/include.php';
include './auth.php';

// Initialize variables
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

    <style>
        /* Force visibility fix if theme overrides select display */
        
    </style>
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
                                    <h4 class="card-title mb-4">Add New Remark</h4>
                                    <form id="form-data">
                                        <input type="hidden" id="remark_id" name="remark_id">




                                        <div class="mb-3 row">
                                            <label class="col-md-3 col-form-label">Remark</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="remark" name="remark" required>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-3 col-form-label">Status</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="status" id=" ">
                                                    <option value="1">Success</option>
                                                      <option value="2">Pending</option>
                                                    <option value="0">Unsuccess</option>
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" id="create" class="btn btn-primary">Save Remark</button>
                                            <button type="button" id="update" class="btn btn-success" style="display: none;">Update Remark</button>
                                            <button type="button" id="new" class="btn btn-secondary">New</button>
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
                                    <h4 class="card-title mb-4">Remark List</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Remark</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($remarks)): ?>
                                                    <?php foreach ($remarks as $remark): ?>
                                                        <tr>
                                                            <td><?= $count++; ?></td>
                                                            <td><?= htmlspecialchars($remark['remark']); ?></td>
                                                            <td>
                                                                <?= $remark['status'] == 1 ? '<span class="badge bg-success">Success</span>' : '<span class="badge bg-danger">Unsuccess</span>'; ?>
                                                            </td>
                                                            <td><?= htmlspecialchars($remark['created_at']); ?></td>
                                                            <td><?= htmlspecialchars($remark['updated_at']); ?></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-warning edit-remark"
                                                                    data-id="<?= htmlspecialchars($remark['id']); ?>"
                                                                    data-remark="<?= htmlspecialchars($remark['remark']); ?>"
                                                                    data-status="<?= htmlspecialchars($remark['status']); ?>">
                                                                    <i class="mdi mdi-pencil"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-danger delete-remark"
                                                                    data-id="<?= htmlspecialchars($remark['id']); ?>">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center text-muted">No remarks found</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- container-fluid -->
            </div> <!-- page-content -->
        </div> <!-- main-content -->
    </div> <!-- layout-wrapper -->

    <?php include './assets/main-js.php'; ?>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function() {
            // CREATE remark
            $('#form-data').on('submit', function(e) {
                e.preventDefault();

                const remark = $('#remark').val().trim();
                const status = $('#status').val();

                if (!remark) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Please enter a remark'
                    });
                    return;
                }

               

                const formData = new FormData(this);
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
                            }).then(() => location.reload());
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
                            text: 'Request failed while saving remark'
                        });
                    }
                });
            });

            // EDIT remark
            $(document).on('click', '.edit-remark', function() {
                const id = $(this).data('id');
                const remark = $(this).data('remark');
                const status = $(this).data('status');

                $('#remark_id').val(id);
                $('#remark').val(remark);
                $('#status').val(status);

                $('#create').hide();
                $('#update').show();

                $('html, body').animate({
                    scrollTop: $("#form-data").offset().top - 100
                }, 400);
            });

            // UPDATE remark
            $('#update').on('click', function() {
                const remark = $('#remark').val().trim();
                const status = $('#status').val();

                if (!remark) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Please fill all required fields'
                    });
                    return;
                }

                const formData = new FormData($('#form-data')[0]);
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
                                title: 'Updated!',
                                text: 'Remark updated successfully',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => location.reload());
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
                            text: 'Request failed while updating remark'
                        });
                    }
                });
            });

            // DELETE remark
            $(document).on('click', '.delete-remark', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to undo this!',
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
                                        text: 'Remark deleted successfully',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => location.reload());
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
                                    text: 'Request failed while deleting remark'
                                });
                            }
                        });
                    }
                });
            });

            // NEW button reset
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