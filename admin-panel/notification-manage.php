<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Notification Management | Youth Service LTD</title>
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

                    <!-- Form Section -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Create Notification</h4>
                            <form id="notification-form">
                                <input type="hidden" id="id" name="id">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label>Title</label>
                                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter notification title">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Description</label>
                                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-primary" id="create">Create</button>
                                    <button type="button" class="btn btn-warning" id="update" style="display:none;">Update</button>
                                    <button type="button" class="btn btn-secondary" id="new">New</button>
                                    <button type="button" class="btn btn-danger delete-notification">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Notification List -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Manage Notifications</h4>
                            <table class="table table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $NOTIF = new Notification();
                                    foreach ($NOTIF->all() as $key => $n) {
                                        $key++;
                                        echo "
                                        <tr>
                                            <td>{$key}</td>
                                            <td>" . htmlspecialchars($n['title']) . "</td>
                                            <td>" . htmlspecialchars($n['description']) . "</td>
                                            <td>{$n['created_at']}</td>
                                            <td>
                                                <div class='badge bg-soft-success select-notification'
                                                    data-id='{$n['id']}'
                                                    data-title='" . htmlspecialchars($n['title']) . "'
                                                    data-description='" . htmlspecialchars($n['description']) . "'>
                                                    <i class='fas fa-pencil-alt'></i>
                                                </div>
                                            </td>
                                        </tr>";
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

    <div class="rightbar-overlay"></div>
    <?php include './assets/main-js.php'; ?>
    <script src="ajax/js/notification.js"></script>
</body>
</html>
