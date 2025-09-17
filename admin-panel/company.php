<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Company Management | Youth Service LTD</title>
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
                    <!-- Create Company -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create Company</h4>
                                    <form id="form-data" enctype="multipart/form-data">
                                        <input type="hidden" id="company_id" name="company_id">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Name</label>
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter company name" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Short Description</label>
                                                <input type="text" id="short_desc" name="short_desc" class="form-control" placeholder="Enter short description">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Image</label>
                                                <input type="file" id="image_name" name="image_name" class="form-control" accept="image/*" onchange="previewImage(this)">
                                                <div id="image_preview" class="mt-2" style="display: none;">
                                                    <img id="company_image" src="#" alt="Company Image Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Site URL</label>
                                                <input type="text" id="page_url" name="page_url" class="form-control" placeholder="Enter Site URL (optional)">
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
                                                <button type="button" class="btn btn-danger delete-company">
                                                    <i class="uil uil-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Company List -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Companies</h4>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Name</th>
                                                <th>Short Description</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $COMPANY = new Company(NULL);
                                            foreach ($COMPANY->all() as $key => $company) {
                                                $key++;
                                            ?>
                                                <tr id="div<?php echo $company['id'] ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo htmlspecialchars($company['name']) ?></td>
                                                    <td><?php echo htmlspecialchars($company['short_desc']) ?></td>
                                                    <td>
                                                        <?php if (!empty($company['image_name'])) { ?>
                                                            <img src="../upload/company/<?php echo htmlspecialchars($company['image_name']) ?>" alt="Company Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <div class="badge bg-pill bg-soft-success font-size-14 select-company"
                                                            data-id="<?php echo $company['id'] ?>"
                                                            data-name="<?php echo htmlspecialchars($company['name']) ?>"
                                                            data-short_desc="<?php echo htmlspecialchars($company['short_desc']) ?>"
                                                            data-image_name="<?php echo htmlspecialchars($company['image_name']) ?>"
                                                            data-page_url="<?php echo htmlspecialchars($company['page_url']) ?>">
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
    <script src="ajax/js/company.js"></script>
    <script>
        function previewImage(input) {
            const preview = document.getElementById('image_preview');
            const image = document.getElementById('company_image');

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

        function removeImage() {
            const input = document.getElementById('image_name');
            const preview = document.getElementById('image_preview');
            input.value = '';
            preview.style.display = 'none';
        }
    </script>
</body>

</html>