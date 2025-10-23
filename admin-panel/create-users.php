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
                                                <select class="form-control" name="type" id="type">
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

                                        <!-- Staff Dropdown (shown when user type is 2) -->
                                        <div class="mb-3 row d-none" id="staff-container">
                                            <label for="staff_id" class="col-md-2 col-form-label">Staff Member</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="staff_id" id="staff_id">
                                                    <option value="">-- Select Staff Member -- </option>
                                                    <?php
                                                    $Staff = new Staff(NULL);
                                                    foreach ($Staff->all() as $staff) {
                                                    ?>
                                                        <option value="<?php echo $staff['id'] ?>"><?php echo $staff['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Agent Dropdown (shown when user type is 3) -->
                                        <div class="mb-3 row d-none" id="agent-container">
                                            <label for="agent_id" class="col-md-2 col-form-label">Agent</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="agent_id" id="agent_id">
                                                    <option value="">-- Select Agent -- </option>
                                                    <?php
                                                    $Agent = new Agent(NULL);
                                                    foreach ($Agent->all() as $agent) {
                                                    ?>
                                                        <option value="<?php echo $agent['id'] ?>"><?php echo $agent['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">User Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="username" name="username" placeholder="Enter username">
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

                    <!-- User List Table -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">User List</h4>
                                    <table id="user-datatable" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>User Type</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $USER = new User(NULL);
                                            $users = $USER->all();
                                            if ($users) {
                                                foreach ($users as $user) {
                                                    $userType = '';
                                                    $name = '';
                                                    
                                                    // Get user type name
                                                    $USER_TYPE = new UserType($user['type']);
                                                    $typeName = $USER_TYPE->name;
                                                    
                                                    // Get user's name based on type
                                                    if ($user['type'] == 2 && !empty($user['staff_user_id'])) {
                                                        $staff = new Staff($user['staff_user_id']);
                                                        $name = $staff->name;
                                                    } elseif ($user['type'] == 3 && !empty($user['agent_user_id'])) {
                                                        $agent = new Agent($user['agent_user_id']);
                                                        $name = $agent->name;
                                                    } else {
                                                        $name = 'N/A';
                                                    }
                                                    
                                                    // Status badge
                                                    $statusBadge = $user['isActive'] == 1 
                                                        ? '<span class="badge bg-success">Active</span>'
                                                        : '<span class="badge bg-danger">Inactive</span>';
                                            ?>
                                                    <tr>
                                                        <td><?php echo $user['id']; ?></td>
                                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                                        <td><?php echo htmlspecialchars($typeName); ?></td>
                                                        <td><?php echo htmlspecialchars($name); ?></td>
                                                        <td><?php echo $statusBadge; ?></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning edit-user" data-id="<?php echo $user['id']; ?>">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-danger delete-user" data-id="<?php echo $user['id']; ?>">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo '<tr><td colspan="6" class="text-center">No users found</td></tr>';
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

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <?php include './assets/main-js.php'; ?>
    <script src="ajax/js/user.js" type="text/javascript"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userTypeSelect = document.getElementById('type');
            const staffContainer = document.getElementById('staff-container');
            const agentContainer = document.getElementById('agent-container');
            const staffSelect = document.getElementById('staff_id');
            const agentSelect = document.getElementById('agent_id');

            userTypeSelect.addEventListener('change', function() {
                const selectedType = parseInt(this.value);
                
                // Hide both containers first
                staffContainer.classList.add('d-none');
                agentContainer.classList.add('d-none');
                
                // Clear selections
                staffSelect.required = false;
                agentSelect.required = false;
                
                // Show the appropriate container based on user type
                if (selectedType === 2) {
                    staffContainer.classList.remove('d-none');
                    staffSelect.required = true;
                } else if (selectedType === 3) {
                    agentContainer.classList.remove('d-none');
                    agentSelect.required = true;
                }
            });
        });
    </script>

    <!-- DataTables JS -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    
    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit-user-form">
                    <div class="modal-body">
                        <input type="hidden" id="edit_user_id" name="id">
                        
                        <div class="mb-3 row">
                            <label class="col-md-3 col-form-label">User Type</label>
                            <div class="col-md-9">
                                <select class="form-control" name="type" id="edit_type" required>
                                    <option value="">-- Select User type --</option>
                                    <?php
                                    $USER_TYPE = new UserType(NULL);
                                    foreach ($USER_TYPE->all() as $user_type) {
                                        echo '<option value="' . $user_type['id'] . '">' . $user_type['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row d-none" id="edit-staff-container">
                            <label class="col-md-3 col-form-label">Staff Member</label>
                            <div class="col-md-9">
                                <select class="form-control" name="staff_user_id" id="edit_staff_id">
                                    <option value="">-- Select Staff Member --</option>
                                    <?php
                                    $Staff = new Staff(NULL);
                                    foreach ($Staff->all() as $staff) {
                                        echo '<option value="' . $staff['id'] . '">' . $staff['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row d-none" id="edit-agent-container">
                            <label class="col-md-3 col-form-label">Agent</label>
                            <div class="col-md-9">
                                <select class="form-control" name="agent_user_id" id="edit_agent_id">
                                    <option value="">-- Select Agent --</option>
                                    <?php
                                    $Agent = new Agent(NULL);
                                    foreach ($Agent->all() as $agent) {
                                        echo '<option value="' . $agent['id'] . '">' . $agent['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-3 col-form-label">Username</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="edit_username" name="username" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-3 col-form-label">Status</label>
                            <div class="col-md-9">
                                <select class="form-control" name="isActive" id="edit_isActive">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var userTable = $('#user-datatable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                ],
                order: [[0, 'desc']],
                pageLength: 25
            });

            // Handle edit button click
            $(document).on('click', '.edit-user', function() {
                const userId = $(this).data('id');
                
                // Fetch user data via AJAX
                $.ajax({
                    url: 'ajax/php/user.php',
                    type: 'POST',
                    data: { get_user: true, id: userId },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            const user = response.user;
                            
                            // Populate form fields
                            $('#edit_user_id').val(user.id);
                            $('#edit_username').val(user.username);
                            $('#edit_type').val(user.type);
                            $('#edit_isActive').val(user.isActive);
                            
                            // Handle staff/agent selection based on type
                            if (user.type == 2) {
                                $('#edit-staff-container').removeClass('d-none');
                                $('#edit_agent_id').val('').trigger('change');
                                $('#edit_staff_id').val(user.staff_user_id).trigger('change');
                            } else if (user.type == 3) {
                                $('#edit-agent-container').removeClass('d-none');
                                $('#edit_staff_id').val('').trigger('change');
                                $('#edit_agent_id').val(user.agent_user_id).trigger('change');
                            }
                            
                            // Show the modal
                            $('#editUserModal').modal('show');
                        } else {
                            alert('Error loading user data');
                        }
                    },
                    error: function() {
                        alert('Error loading user data');
                    }
                });
            });

            // Handle user type change in edit form
            $('#edit_type').on('change', function() {
                const type = $(this).val();
                
                // Hide both containers first
                $('#edit-staff-container').addClass('d-none');
                $('#edit-agent-container').addClass('d-none');
                
                // Show the appropriate container based on user type
                if (type == 2) {
                    $('#edit-staff-container').removeClass('d-none');
                } else if (type == 3) {
                    $('#edit-agent-container').removeClass('d-none');
                }
            });

            // Handle edit form submission
            $('#edit-user-form').on('submit', function(e) {
                e.preventDefault();
                
                // Show loading state
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
                
                // Submit form via AJAX
                $.ajax({
                    url: 'ajax/php/user.php',
                    type: 'POST',
                    data: $(this).serialize() + '&update=true',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Show success message
                            alert('User updated successfully');
                            // Close modal and refresh table
                            $('#editUserModal').modal('hide');
                            location.reload();
                        } else {
                            alert(response.message || 'Error updating user');
                        }
                    },
                    error: function() {
                        alert('Error updating user');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalText);
                    }
                });
            });

            // Handle delete button click
            $(document).on('click', '.delete-user', function() {
                const userId = $(this).data('id');
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: 'ajax/php/user.php',
                        type: 'POST',
                        data: { delete: true, id: userId },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                alert('User deleted successfully');
                                location.reload();
                            } else {
                                alert(response.message || 'Error deleting user');
                            }
                        },
                        error: function() {
                            alert('Error deleting user');
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>