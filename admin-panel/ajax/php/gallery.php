<?php

include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Upload directory
$upload_dir = __DIR__ . '/../../../upload/gallery/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

/**
 * Handle file upload for gallery media
 */
function handleGalleryUpload($file, $prefix = 'photo') {
    global $upload_dir;
    
    if (!isset($file['name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed_images = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $allowed_videos = ['mp4', 'webm', 'mov'];
    
    $all_allowed = array_merge($allowed_images, $allowed_videos);
    if (!in_array($file_extension, $all_allowed)) {
        return null;
    }
    
    // Max file size: 50MB for videos, 10MB for images
    $max_size = in_array($file_extension, $allowed_videos) ? 50 * 1024 * 1024 : 10 * 1024 * 1024;
    if ($file['size'] > $max_size) {
        return null;
    }
    
    $file_name = $prefix . '_' . time() . '_' . mt_rand(1000, 9999) . '.' . $file_extension;
    $file_path = $upload_dir . $file_name;
    
    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        return $file_name;
    }
    
    return null;
}

/**
 * Delete a file from the gallery upload directory
 */
function deleteGalleryFile($filename) {
    global $upload_dir;
    if ($filename && file_exists($upload_dir . $filename)) {
        unlink($upload_dir . $filename);
    }
}

// ========================================
// CREATE - Upload new gallery media
// ========================================
if (isset($_POST['create'])) {
    $response = ["status" => "error", "message" => ""];
    
    try {
        $gallery = new Gallery(null);
        $gallery->company_id = (int)$_POST['company_id'];
        $gallery->media_type = $_POST['media_type'] ?? 'photo';
        $gallery->title = $_POST['title'] ?? '';
        $gallery->description = $_POST['description'] ?? '';
        $gallery->is_highlight = isset($_POST['is_highlight']) ? 1 : 0;
        $gallery->status = 1;
        
        // Get next sort order
        $gallery->sort_order = $gallery->getNextSortOrder($gallery->company_id);
        
        if ($gallery->media_type === 'photo') {
            // Handle photo upload
            if (isset($_FILES['media_file']) && $_FILES['media_file']['error'] === UPLOAD_ERR_OK) {
                $gallery->file_name = handleGalleryUpload($_FILES['media_file'], 'photo');
                if (!$gallery->file_name) {
                    throw new Exception("Failed to upload photo. Check file type and size (max 10MB).");
                }
            } else {
                throw new Exception("Please select a photo to upload.");
            }
        } else {
            // Handle video - either file upload or YouTube URL
            $video_url = $_POST['video_url'] ?? '';
            
            if (!empty($video_url)) {
                // YouTube URL
                $gallery->video_url = $video_url;
                $gallery->thumbnail = ''; // Will use YouTube thumbnail
            } elseif (isset($_FILES['media_file']) && $_FILES['media_file']['error'] === UPLOAD_ERR_OK) {
                // Direct video upload
                $gallery->file_name = handleGalleryUpload($_FILES['media_file'], 'video');
                if (!$gallery->file_name) {
                    throw new Exception("Failed to upload video. Check file type and size (max 50MB).");
                }
            } else {
                throw new Exception("Please provide a video file or YouTube URL.");
            }
            
            // Handle thumbnail upload (optional for videos)
            if (isset($_FILES['thumbnail_file']) && $_FILES['thumbnail_file']['error'] === UPLOAD_ERR_OK) {
                $gallery->thumbnail = handleGalleryUpload($_FILES['thumbnail_file'], 'thumb');
            }
        }
        
        $res = $gallery->create();
        
        if ($res) {
            $response = ["status" => "success", "id" => $res, "message" => "Gallery item created successfully"];
        } else {
            throw new Exception("Failed to save gallery item.");
        }
    } catch (Exception $e) {
        $response["message"] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit();
}

// ========================================
// UPDATE - Update existing gallery media
// ========================================
if (isset($_POST['update'])) {
    $response = ["status" => "error", "message" => ""];
    
    try {
        $gallery = new Gallery((int)$_POST['gallery_id']);
        
        if (!$gallery->id) {
            throw new Exception("Gallery item not found.");
        }
        
        $gallery->company_id = (int)$_POST['company_id'];
        $gallery->media_type = $_POST['media_type'] ?? $gallery->media_type;
        $gallery->title = $_POST['title'] ?? '';
        $gallery->description = $_POST['description'] ?? '';
        $gallery->is_highlight = isset($_POST['is_highlight']) ? 1 : 0;
        
        if ($gallery->media_type === 'photo') {
            // Handle new photo upload (replace existing)
            if (isset($_FILES['media_file']) && $_FILES['media_file']['error'] === UPLOAD_ERR_OK) {
                deleteGalleryFile($gallery->file_name);
                $gallery->file_name = handleGalleryUpload($_FILES['media_file'], 'photo');
                if (!$gallery->file_name) {
                    throw new Exception("Failed to upload new photo.");
                }
            }
        } else {
            $video_url = $_POST['video_url'] ?? '';
            
            if (!empty($video_url)) {
                // Update YouTube URL
                if ($gallery->file_name) {
                    deleteGalleryFile($gallery->file_name);
                    $gallery->file_name = '';
                }
                $gallery->video_url = $video_url;
            } elseif (isset($_FILES['media_file']) && $_FILES['media_file']['error'] === UPLOAD_ERR_OK) {
                // Replace video file
                deleteGalleryFile($gallery->file_name);
                $gallery->file_name = handleGalleryUpload($_FILES['media_file'], 'video');
                if (!$gallery->file_name) {
                    throw new Exception("Failed to upload new video.");
                }
            }
            
            // Handle thumbnail update
            if (isset($_FILES['thumbnail_file']) && $_FILES['thumbnail_file']['error'] === UPLOAD_ERR_OK) {
                deleteGalleryFile($gallery->thumbnail);
                $gallery->thumbnail = handleGalleryUpload($_FILES['thumbnail_file'], 'thumb');
            }
        }
        
        $res = $gallery->update();
        $response = ["status" => $res ? "success" : "error", "message" => $res ? "Updated successfully" : "Update failed"];
        
    } catch (Exception $e) {
        $response["message"] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit();
}

// ========================================
// DELETE - Delete gallery media
// ========================================
if (isset($_POST['delete'])) {
    $response = ["status" => "error", "message" => ""];
    
    try {
        $gallery_id = (int)($_POST['gallery_id'] ?? $_POST['id'] ?? 0);
        
        if (!$gallery_id) {
            throw new Exception("Gallery ID is required.");
        }
        
        $gallery = new Gallery($gallery_id);
        
        if (!$gallery->id) {
            throw new Exception("Gallery item not found.");
        }
        
        // Delete files
        deleteGalleryFile($gallery->file_name);
        deleteGalleryFile($gallery->thumbnail);
        
        $res = $gallery->delete();
        $response = ["status" => $res ? "success" : "error", "message" => $res ? "Deleted successfully" : "Delete failed"];
        
    } catch (Exception $e) {
        $response["message"] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit();
}

// ========================================
// TOGGLE HIGHLIGHT
// ========================================
if (isset($_POST['toggle_highlight'])) {
    $response = ["status" => "error", "message" => ""];
    
    try {
        $gallery_id = (int)($_POST['gallery_id'] ?? 0);
        
        if (!$gallery_id) {
            throw new Exception("Gallery ID is required.");
        }
        
        $gallery = new Gallery();
        $res = $gallery->toggleHighlight($gallery_id);
        
        // Get the new highlight status
        $updated = new Gallery($gallery_id);
        
        $response = [
            "status" => $res ? "success" : "error",
            "is_highlight" => $updated->is_highlight,
            "message" => $res ? "Highlight toggled" : "Toggle failed"
        ];
        
    } catch (Exception $e) {
        $response["message"] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit();
}

// ========================================
// TOGGLE STATUS (active/inactive)
// ========================================
if (isset($_POST['toggle_status'])) {
    $response = ["status" => "error", "message" => ""];
    
    try {
        $gallery_id = (int)($_POST['gallery_id'] ?? 0);
        
        if (!$gallery_id) {
            throw new Exception("Gallery ID is required.");
        }
        
        $db = new Database();
        $query = "UPDATE `gallery_media` SET `status` = NOT `status` WHERE `id` = " . $gallery_id;
        $res = $db->readQuery($query);
        
        $updated = new Gallery($gallery_id);
        
        $response = [
            "status" => $res ? "success" : "error",
            "item_status" => $updated->status,
            "message" => $res ? "Status toggled" : "Toggle failed"
        ];
        
    } catch (Exception $e) {
        $response["message"] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit();
}
