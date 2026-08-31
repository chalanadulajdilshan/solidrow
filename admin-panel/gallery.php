<?php
include '../class/include.php';
include './auth.php';

$company = new Company();
$companies = $company->all();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Gallery Management | Solidrow Group</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include './assets/main-css.php'; ?>
    <style>
        .gallery-preview-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e9ecef;
        }
        .badge-photo { background: #0d6efd; }
        .badge-video { background: #dc3545; }
        .highlight-star {
            cursor: pointer;
            font-size: 1.3rem;
            transition: all 0.2s ease;
        }
        .highlight-star:hover { transform: scale(1.2); }
        .highlight-star.active { color: #ffc107; }
        .highlight-star.inactive { color: #d1d5db; }
        .upload-zone {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            background: #f8fafc;
            cursor: pointer;
        }
        .upload-zone:hover, .upload-zone.dragover {
            border-color: #0d6efd;
            background: #eff6ff;
        }
        .upload-zone i {
            font-size: 2.5rem;
            color: #94a3b8;
            margin-bottom: 10px;
        }
        .upload-preview {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-top: 10px;
        }
        .video-url-section { display: none; }
        .status-badge { cursor: pointer; }
        .thumbnail-section { display: none; }
    </style>
</head>

<body class="someBlock">
    <div id="layout-wrapper">
        <?php include './top-header.php'; ?>
        <?php include './navigation.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- Upload Gallery Media -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">
                                        <i class="bx bx-image-add me-2"></i>Upload Gallery Media
                                    </h4>
                                    <form id="gallery-form" enctype="multipart/form-data">
                                        <input type="hidden" id="gallery_id" name="gallery_id">
                                        <div class="row">
                                            <!-- Company Selection -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Company / Agency <span class="text-danger">*</span></label>
                                                <select id="company_id" name="company_id" class="form-control" required>
                                                    <option value="">Select Company</option>
                                                    <?php foreach ($companies as $c): ?>
                                                        <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            
                                            <!-- Media Type -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Media Type <span class="text-danger">*</span></label>
                                                <select id="media_type" name="media_type" class="form-control" required>
                                                    <option value="photo">📷 Photo</option>
                                                    <option value="video">🎬 Video</option>
                                                </select>
                                            </div>
                                            
                                            <!-- Title -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" id="title" name="title" class="form-control" placeholder="Enter title (optional)">
                                            </div>
                                            
                                            <!-- File Upload Zone -->
                                            <div class="col-md-6 mb-3" id="file-upload-section">
                                                <label class="form-label">Upload File <span class="text-danger">*</span></label>
                                                <div class="upload-zone" id="upload-zone" onclick="document.getElementById('media_file').click()">
                                                    <i class="bx bx-cloud-upload d-block"></i>
                                                    <p class="mb-0 text-muted" id="upload-text">Click or drag file to upload</p>
                                                    <small class="text-muted" id="upload-hint">Photos: JPG, PNG, WebP (max 10MB) | Videos: MP4, WebM (max 50MB)</small>
                                                    <img id="file-preview" class="upload-preview d-none" src="" alt="Preview">
                                                </div>
                                                <input type="file" id="media_file" name="media_file" class="d-none" accept="image/*">
                                            </div>
                                            
                                            <!-- YouTube URL (for videos) -->
                                            <div class="col-md-6 mb-3 video-url-section" id="video-url-section">
                                                <label class="form-label">YouTube / Video URL</label>
                                                <input type="url" id="video_url" name="video_url" class="form-control" placeholder="https://www.youtube.com/watch?v=...">
                                                <small class="text-muted">Paste a YouTube URL. Leave empty if uploading a video file directly.</small>
                                                <div id="youtube-preview" class="mt-2" style="display:none;">
                                                    <img id="youtube-thumb" src="" alt="YouTube Thumbnail" class="upload-preview">
                                                </div>
                                            </div>
                                            
                                            <!-- Video Thumbnail Upload (optional) -->
                                            <div class="col-md-6 mb-3 thumbnail-section" id="thumbnail-section">
                                                <label class="form-label">Video Thumbnail (Optional)</label>
                                                <input type="file" id="thumbnail_file" name="thumbnail_file" class="form-control" accept="image/*">
                                                <small class="text-muted">Optional thumbnail for video files. YouTube thumbnails are auto-extracted.</small>
                                            </div>
                                            
                                            <!-- Description -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter description (optional)"></textarea>
                                            </div>
                                            
                                            <!-- Highlight Checkbox -->
                                            <div class="col-md-6 mb-3 d-flex align-items-end">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="is_highlight" name="is_highlight">
                                                    <label class="form-check-label" for="is_highlight">
                                                        ⭐ Mark as Highlight (Show on Home Page)
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-12 text-end">
                                                <button type="button" class="btn btn-primary" id="btn-create">
                                                    <i class="bx bx-upload me-1"></i> Upload
                                                </button>
                                                <button type="button" class="btn btn-warning d-none" id="btn-update">
                                                    <i class="bx bx-save me-1"></i> Update
                                                </button>
                                                <button type="button" class="btn btn-secondary" id="btn-new">
                                                    <i class="bx bx-plus me-1"></i> New
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Items List -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="card-title mb-0">
                                            <i class="bx bx-images me-2"></i>Manage Gallery
                                        </h4>
                                        <div>
                                            <select id="filter-company" class="form-control form-control-sm" style="width: 250px; display: inline-block;">
                                                <option value="">All Companies</option>
                                                <?php foreach ($companies as $c): ?>
                                                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <table id="gallery-table" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="10%">Preview</th>
                                                <th width="20%">Title</th>
                                                <th width="20%">Company</th>
                                                <th width="8%">Type</th>
                                                <th width="8%">Highlight</th>
                                                <th width="8%">Status</th>
                                                <th width="10%">Date</th>
                                                <th width="11%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="gallery-tbody">
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

    <?php include './assets/main-js.php'; ?>
    
    <script>
    $(document).ready(function() {
        // Initialize DataTable
        var galleryTable = $('#gallery-table').DataTable({
            responsive: true,
            order: [[0, 'desc']],
            pageLength: 25
        });
        
        // Load gallery items
        loadGalleryItems();
        
        // Media type toggle
        $('#media_type').on('change', function() {
            var type = $(this).val();
            if (type === 'video') {
                $('#media_file').attr('accept', 'video/mp4,video/webm,video/mov');
                $('#upload-hint').text('Videos: MP4, WebM, MOV (max 50MB)');
                $('#video-url-section').show();
                $('#thumbnail-section').show();
            } else {
                $('#media_file').attr('accept', 'image/*');
                $('#upload-hint').text('Photos: JPG, PNG, WebP (max 10MB)');
                $('#video-url-section').hide();
                $('#thumbnail-section').hide();
                $('#video_url').val('');
            }
        });
        
        // File upload preview
        $('#media_file').on('change', function() {
            var file = this.files[0];
            if (file) {
                $('#upload-text').text(file.name);
                if (file.type.startsWith('image/')) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#file-preview').attr('src', e.target.result).removeClass('d-none');
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#file-preview').addClass('d-none');
                }
            }
        });
        
        // Drag and drop
        var uploadZone = document.getElementById('upload-zone');
        ['dragenter', 'dragover'].forEach(function(eventName) {
            uploadZone.addEventListener(eventName, function(e) {
                e.preventDefault();
                uploadZone.classList.add('dragover');
            });
        });
        ['dragleave', 'drop'].forEach(function(eventName) {
            uploadZone.addEventListener(eventName, function(e) {
                e.preventDefault();
                uploadZone.classList.remove('dragover');
            });
        });
        uploadZone.addEventListener('drop', function(e) {
            var files = e.dataTransfer.files;
            if (files.length > 0) {
                document.getElementById('media_file').files = files;
                $('#media_file').trigger('change');
            }
        });
        
        // YouTube URL preview
        $('#video_url').on('input', function() {
            var url = $(this).val();
            var videoId = extractYoutubeId(url);
            if (videoId) {
                var thumbUrl = 'https://img.youtube.com/vi/' + videoId + '/hqdefault.jpg';
                $('#youtube-thumb').attr('src', thumbUrl);
                $('#youtube-preview').show();
            } else {
                $('#youtube-preview').hide();
            }
        });
        
        // Create gallery item
        $('#btn-create').on('click', function() {
            var formData = new FormData($('#gallery-form')[0]);
            formData.append('create', true);
            
            if (!$('#company_id').val()) {
                swal("Warning", "Please select a company!", "warning");
                return;
            }
            
            var mediaType = $('#media_type').val();
            var hasFile = $('#media_file')[0].files.length > 0;
            var hasUrl = $('#video_url').val().trim() !== '';
            
            if (mediaType === 'photo' && !hasFile) {
                swal("Warning", "Please select a photo to upload!", "warning");
                return;
            }
            if (mediaType === 'video' && !hasFile && !hasUrl) {
                swal("Warning", "Please upload a video file or paste a YouTube URL!", "warning");
                return;
            }
            
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i> Uploading...');
            
            $.ajax({
                url: 'ajax/php/gallery.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 'success') {
                        swal("Success", "Gallery item uploaded successfully!", "success");
                        resetForm();
                        loadGalleryItems();
                    } else {
                        swal("Error", response.message || "Upload failed", "error");
                    }
                },
                error: function() {
                    swal("Error", "Server error occurred", "error");
                },
                complete: function() {
                    btn.prop('disabled', false).html('<i class="bx bx-upload me-1"></i> Upload');
                }
            });
        });
        
        // Update gallery item
        $('#btn-update').on('click', function() {
            var formData = new FormData($('#gallery-form')[0]);
            formData.append('update', true);
            
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i> Updating...');
            
            $.ajax({
                url: 'ajax/php/gallery.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 'success') {
                        swal("Success", "Gallery item updated successfully!", "success");
                        resetForm();
                        loadGalleryItems();
                    } else {
                        swal("Error", response.message || "Update failed", "error");
                    }
                },
                error: function() {
                    swal("Error", "Server error occurred", "error");
                },
                complete: function() {
                    btn.prop('disabled', false).html('<i class="bx bx-save me-1"></i> Update');
                }
            });
        });
        
        // New button - reset form
        $('#btn-new').on('click', function() {
            resetForm();
        });
        
        // Filter by company
        $('#filter-company').on('change', function() {
            loadGalleryItems();
        });
        
        // Delete gallery item
        $(document).on('click', '.delete-gallery', function() {
            var id = $(this).data('id');
            swal({
                title: "Are you sure?",
                text: "This will permanently delete this gallery item!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function() {
                $.ajax({
                    url: 'ajax/php/gallery.php',
                    type: 'POST',
                    data: { delete: true, gallery_id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            swal("Deleted!", "Gallery item has been deleted.", "success");
                            loadGalleryItems();
                        } else {
                            swal("Error", response.message || "Delete failed", "error");
                        }
                    }
                });
            });
        });
        
        // Toggle highlight
        $(document).on('click', '.toggle-highlight', function() {
            var id = $(this).data('id');
            var star = $(this);
            
            $.ajax({
                url: 'ajax/php/gallery.php',
                type: 'POST',
                data: { toggle_highlight: true, gallery_id: id },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        if (response.is_highlight == 1) {
                            star.removeClass('inactive').addClass('active');
                        } else {
                            star.removeClass('active').addClass('inactive');
                        }
                    }
                }
            });
        });
        
        // Toggle status
        $(document).on('click', '.toggle-status', function() {
            var id = $(this).data('id');
            var badge = $(this);
            
            $.ajax({
                url: 'ajax/php/gallery.php',
                type: 'POST',
                data: { toggle_status: true, gallery_id: id },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        if (response.item_status == 1) {
                            badge.removeClass('bg-danger').addClass('bg-success').text('Active');
                        } else {
                            badge.removeClass('bg-success').addClass('bg-danger').text('Hidden');
                        }
                    }
                }
            });
        });
        
        // Edit gallery item
        $(document).on('click', '.edit-gallery', function() {
            var data = $(this).data();
            
            $('#gallery_id').val(data.id);
            $('#company_id').val(data.companyId);
            $('#media_type').val(data.mediaType).trigger('change');
            $('#title').val(data.title);
            $('#description').val(data.description || '');
            $('#is_highlight').prop('checked', data.highlight == 1);
            
            if (data.videoUrl) {
                $('#video_url').val(data.videoUrl).trigger('input');
            }
            
            $('#btn-create').addClass('d-none');
            $('#btn-update').removeClass('d-none');
            
            $('html, body').animate({ scrollTop: 0 }, 500);
        });
        
        // Load gallery items into table
        function loadGalleryItems() {
            var companyFilter = $('#filter-company').val();
            
            $.ajax({
                url: 'ajax/php/gallery.php',
                type: 'GET',
                data: { list: true, company_id: companyFilter },
                dataType: 'html',
                success: function() {
                    // Since our AJAX returns JSON, we need to fetch data differently
                    // Load via PHP inline - we'll use a simpler approach
                },
                error: function() {}
            });
            
            // Direct fetch approach
            $.ajax({
                url: 'gallery-data.php' + (companyFilter ? '?company_id=' + companyFilter : ''),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    galleryTable.clear();
                    
                    $.each(data, function(index, item) {
                        var preview = getPreviewHtml(item);
                        var typeBadge = item.media_type === 'photo' 
                            ? '<span class="badge badge-photo">📷 Photo</span>' 
                            : '<span class="badge badge-video">🎬 Video</span>';
                        var highlightStar = '<i class="bx bxs-star highlight-star toggle-highlight ' + 
                            (item.is_highlight == 1 ? 'active' : 'inactive') + '" data-id="' + item.id + '"></i>';
                        var statusBadge = '<span class="badge status-badge toggle-status ' + 
                            (item.status == 1 ? 'bg-success' : 'bg-danger') + '" data-id="' + item.id + '">' + 
                            (item.status == 1 ? 'Active' : 'Hidden') + '</span>';
                        var date = item.created_at ? new Date(item.created_at).toLocaleDateString() : '-';
                        
                        var actions = '<button class="btn btn-sm btn-info edit-gallery me-1" ' +
                            'data-id="' + item.id + '" ' +
                            'data-company-id="' + item.company_id + '" ' +
                            'data-media-type="' + item.media_type + '" ' +
                            'data-title="' + escapeHtml(item.title || '') + '" ' +
                            'data-description="' + escapeHtml(item.description || '') + '" ' +
                            'data-video-url="' + escapeHtml(item.video_url || '') + '" ' +
                            'data-highlight="' + item.is_highlight + '">' +
                            '<i class="bx bx-edit"></i></button>' +
                            '<button class="btn btn-sm btn-danger delete-gallery" data-id="' + item.id + '">' +
                            '<i class="bx bx-trash"></i></button>';
                        
                        galleryTable.row.add([
                            item.id,
                            preview,
                            item.title || '<em class="text-muted">No title</em>',
                            item.company_name || '-',
                            typeBadge,
                            highlightStar,
                            statusBadge,
                            date,
                            actions
                        ]);
                    });
                    
                    galleryTable.draw();
                },
                error: function() {
                    console.log('Error loading gallery data');
                }
            });
        }
        
        function getPreviewHtml(item) {
            var src = '';
            if (item.media_type === 'photo' && item.file_name) {
                src = '../upload/gallery/' + item.file_name;
            } else if (item.thumbnail) {
                src = '../upload/gallery/' + item.thumbnail;
            } else if (item.video_url) {
                var ytId = extractYoutubeId(item.video_url);
                if (ytId) {
                    src = 'https://img.youtube.com/vi/' + ytId + '/default.jpg';
                }
            }
            
            if (src) {
                return '<img src="' + src + '" class="gallery-preview-img" alt="Preview">';
            }
            return '<div class="gallery-preview-img d-flex align-items-center justify-content-center bg-light"><i class="bx bx-image text-muted"></i></div>';
        }
        
        function extractYoutubeId(url) {
            if (!url) return null;
            var match = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
            return match ? match[1] : null;
        }
        
        function escapeHtml(text) {
            if (!text) return '';
            return text.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }
        
        function resetForm() {
            $('#gallery-form')[0].reset();
            $('#gallery_id').val('');
            $('#btn-create').removeClass('d-none');
            $('#btn-update').addClass('d-none');
            $('#file-preview').addClass('d-none');
            $('#upload-text').text('Click or drag file to upload');
            $('#youtube-preview').hide();
            $('#video-url-section').hide();
            $('#thumbnail-section').hide();
            $('#media_type').val('photo');
            $('#media_file').attr('accept', 'image/*');
            $('#upload-hint').text('Photos: JPG, PNG, WebP (max 10MB)');
        }
    });
    </script>
</body>

</html>
