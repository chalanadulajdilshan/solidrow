<?php
include '../class/include.php';
include './auth.php';

$GROUP = new Group(NULL);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Group Management | Youth Service LTD</title>
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

                    <!-- Create Group Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create Group</h4>
                                    <form id="form-data">
                                        <input type="hidden" id="group_id" name="group_id">

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Group Name</label>
                                                <input type="text" id="group_name" name="group_name" class="form-control" placeholder="Enter group name" required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Group Payment (Rs.)</label>
                                                <input type="number" step="0.01" id="group_payment" name="group_payment" class="form-control" placeholder="Enter payment amount" required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Document Charge (Rs.)</label>
                                                <input type="number" step="0.01" id="document_charge" name="document_charge" class="form-control" placeholder="Enter document charge" required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Country</label>
                                                <select id="country" name="country" class="form-select" required>
                                                    <option value="">Select Country</option>
                                                    <?php
                                                    $COUNTRY = new Country(NULL);
                                                    foreach ($COUNTRY->all() as $country) {
                                                        echo "<option value=\"{$country['id']}\">{$country['name']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-primary" id="create">
                                                    <i class="uil uil-save me-1"></i> Save
                                                </button>
                                                <button type="button" class="btn btn-warning" id="update" style="display:none;">
                                                    <i class="uil uil-save me-1"></i> Update
                                                </button>
                                                <button type="button" class="btn btn-secondary" id="new">
                                                    <i class="uil uil-plus me-1"></i> New
                                                </button>
                                               
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Manage Groups Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-md-6">
                                            <h4 class="card-title mb-3 mb-md-0">Manage Groups</h4>
                                        </div>
                                        <div class="col-md-4 ms-auto">
                                      
                                        </div>
                                    </div>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Group Name</th>
                                                <th>Country</th>
                                                <th>Payment (Rs.)</th>
                                                <th>Document Charge (Rs.)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            try {
                                                $groups = $GROUP->all();
                                                if (empty($groups)) {
                                                    echo '<tr><td colspan="6" class="text-center">No groups found. Create your first group using the form above.</td></tr>';
                                                } else {
                                                    foreach ($groups as $key => $group) {
                                            ?>
                                                        <tr id="group-row-<?php echo $group['id']; ?>">
                                                            <td><?php echo ($key + 1); ?></td>
                                                            <td><?php echo htmlspecialchars($group['group_name']); ?></td>
                                                            <td><?php echo htmlspecialchars($group['country']); ?></td>
                                                            <td class="text-end"><?php echo $group['formatted_group_payment']; ?></td>
                                                            <td class="text-end"><?php echo $group['formatted_document_charge']; ?></td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-outline-primary edit-group" 
                                                                    data-id="<?php echo $group['id']; ?>"
                                                                    data-group_name="<?php echo htmlspecialchars($group['group_name']); ?>"
                                                                    data-group_payment="<?php echo $group['group_payment']; ?>"
                                                                    data-document_charge="<?php echo $group['document_charge']; ?>"
                                                                    data-country="<?php echo htmlspecialchars($group['country']); ?>">
                                                                    <i class="fas fa-edit"></i> Edit
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-outline-danger delete-group" 
                                                                    data-id="<?php echo $group['id']; ?>">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                            <?php 
                                                    }
                                                }
                                            } catch (Exception $e) {
                                                echo '<tr><td colspan="6" class="text-center text-danger">Error loading groups: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- container-fluid -->
            </div> <!-- page-content -->
        </div> <!-- main-content -->
    </div>

    <div class="rightbar-overlay"></div>
    <?php include 'assets/main-js.php'; ?>
    <script src="ajax/js/group.js"></script>
</body>
</html>
