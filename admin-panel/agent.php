<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Staff Management | Youth Service LTD</title>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create Agent</h4>
                                    <form id="form-data" enctype="multipart/form-data">
                                        <input type="hidden" id="agent_id" name="agent_id">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Name</label>
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter full name" required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Contact No</label>
                                                <input type="text" id="contact_no" name="contact_no" class="form-control" placeholder="Enter contact number" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>WhatsApp No</label>
                                                <input type="text" id="whatsapp_no" name="whatsapp_no" class="form-control" placeholder="Enter WhatsApp number">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>NIC</label>
                                                <input type="text" id="nic" name="nic" class="form-control" placeholder="Enter NIC number" required>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-end">
                                                <button type="button" class="btn btn-primary" id="create">
                                                    <i class="uil uil-save me-1"></i> Save
                                                </button>
                                                <button type="button" class="btn btn-warning" id="update" style="display: none;">
                                                    <i class="uil uil-save me-1"></i> Update
                                                </button>
                                                <button type="button" class="btn btn-secondary" id="new">
                                                    <i class="uil uil-plus me-1"></i> New
                                                </button>
                                                <button type="button" class="btn btn-danger delete-staff">
                                                    <i class="uil uil-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Staff</h4>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Name</th>
                                                <th>Job Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $AGENT = new Agent(NULL);
                                            foreach ($AGENT->all() as $key => $agent) {
                                                $key++;
                                            ?>
                                                <tr id="div<?php echo $agent['id'] ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo htmlspecialchars($agent['name']) ?></td>
                                                    <td><?php echo htmlspecialchars($agent['job_role']) ?></td>
                                                    <td>
                                                        <div class="badge bg-pill bg-soft-success font-size-14 select-staff"
                                                            data-id="<?php echo htmlspecialchars($agent['id']) ?>"
                                                            data-name="<?php echo htmlspecialchars($agent['name']) ?>"
                                                             data-contact_no="<?php echo htmlspecialchars($agent['contact_no']) ?>"
                                                            data-whatsapp_no="<?php echo htmlspecialchars($agent['whatsapp_no']) ?>"
                                                            data-nic="<?php echo htmlspecialchars($agent['nic']) ?>">
                                                            <i class="fas fa-pencil-alt p-1"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
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
    <div class="rightbar-overlay"></div>
    <?php include 'assets/main-js.php'; ?>
    <script src="ajax/js/agent.js"></script>
    <script>
        function previewIdCopy(input) {
            const preview = document.getElementById('id_copy_preview');
            const image = document.getElementById('id_copy_image');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    image.src = e.target.result;
                    preview.style.display = 'flex';
                    preview.style.alignItems = 'center';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeIdCopy() {
            const input = document.getElementById('id_copy');
            const preview = document.getElementById('id_copy_preview');
            input.value = '';
            preview.style.display = 'none';
        }
    </script>
</body>

</html>