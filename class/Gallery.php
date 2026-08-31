<?php

class Gallery
{
    public $id;
    public $company_id;
    public $media_type;
    public $file_name;
    public $video_url;
    public $thumbnail;
    public $title;
    public $description;
    public $is_highlight;
    public $sort_order;
    public $status;
    public $created_at;
    public $updated_at;

    public function __construct($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM `gallery_media` WHERE `id` = " . (int)$id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            if ($result) {
                $this->id = $result['id'];
                $this->company_id = $result['company_id'];
                $this->media_type = $result['media_type'];
                $this->file_name = $result['file_name'];
                $this->video_url = $result['video_url'];
                $this->thumbnail = $result['thumbnail'];
                $this->title = $result['title'];
                $this->description = $result['description'];
                $this->is_highlight = $result['is_highlight'];
                $this->sort_order = $result['sort_order'];
                $this->status = $result['status'];
                $this->created_at = $result['created_at'];
                $this->updated_at = $result['updated_at'];
            }
        }
    }

    public function create()
    {
        $db = new Database();
        $title = $db->escapeString($this->title ?? '');
        $description = $db->escapeString($this->description ?? '');
        $file_name = $db->escapeString($this->file_name ?? '');
        $video_url = $db->escapeString($this->video_url ?? '');
        $thumbnail = $db->escapeString($this->thumbnail ?? '');

        $query = "INSERT INTO `gallery_media` 
                  (`company_id`, `media_type`, `file_name`, `video_url`, `thumbnail`, `title`, `description`, `is_highlight`, `sort_order`, `status`) 
                  VALUES (
                      " . (int)$this->company_id . ",
                      '" . $db->escapeString($this->media_type) . "',
                      '$file_name',
                      '$video_url',
                      '$thumbnail',
                      '$title',
                      '$description',
                      " . (int)($this->is_highlight ?? 0) . ",
                      " . (int)($this->sort_order ?? 0) . ",
                      " . (int)($this->status ?? 1) . "
                  )";

        $result = $db->readQuery($query);

        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        }
        return false;
    }

    public function update()
    {
        $db = new Database();
        $title = $db->escapeString($this->title ?? '');
        $description = $db->escapeString($this->description ?? '');
        $file_name = $db->escapeString($this->file_name ?? '');
        $video_url = $db->escapeString($this->video_url ?? '');
        $thumbnail = $db->escapeString($this->thumbnail ?? '');

        $query = "UPDATE `gallery_media` SET 
                  `company_id` = " . (int)$this->company_id . ",
                  `media_type` = '" . $db->escapeString($this->media_type) . "',
                  `file_name` = '$file_name',
                  `video_url` = '$video_url',
                  `thumbnail` = '$thumbnail',
                  `title` = '$title',
                  `description` = '$description',
                  `is_highlight` = " . (int)$this->is_highlight . ",
                  `sort_order` = " . (int)$this->sort_order . ",
                  `status` = " . (int)$this->status . "
                  WHERE `id` = " . (int)$this->id;

        return $db->readQuery($query);
    }

    public function delete()
    {
        $query = "DELETE FROM `gallery_media` WHERE `id` = " . (int)$this->id;
        $db = new Database();
        return $db->readQuery($query);
    }

    /**
     * Get all gallery media for a specific company
     */
    public function getByCompany($companyId, $limit = null)
    {
        $query = "SELECT gm.*, c.name as company_name 
                  FROM `gallery_media` gm 
                  LEFT JOIN `company` c ON gm.company_id = c.id 
                  WHERE gm.`company_id` = " . (int)$companyId . " 
                  AND gm.`status` = 1 
                  ORDER BY gm.`sort_order` ASC, gm.`created_at` DESC";
        
        if ($limit) {
            $query .= " LIMIT " . (int)$limit;
        }

        $db = new Database();
        $result = $db->readQuery($query);

        $items = [];
        while ($row = mysqli_fetch_array($result)) {
            $items[] = $row;
        }
        return $items;
    }

    /**
     * Get highlighted items across all companies
     */
    public function getHighlights($limit = 8)
    {
        $query = "SELECT gm.*, c.name as company_name 
                  FROM `gallery_media` gm 
                  LEFT JOIN `company` c ON gm.company_id = c.id 
                  WHERE gm.`is_highlight` = 1 
                  AND gm.`status` = 1 
                  ORDER BY gm.`updated_at` DESC 
                  LIMIT " . (int)$limit;

        $db = new Database();
        $result = $db->readQuery($query);

        $items = [];
        while ($row = mysqli_fetch_array($result)) {
            $items[] = $row;
        }
        return $items;
    }

    /**
     * Get latest gallery items across all companies
     */
    public function getLatest($limit = 8)
    {
        $query = "SELECT gm.*, c.name as company_name 
                  FROM `gallery_media` gm 
                  LEFT JOIN `company` c ON gm.company_id = c.id 
                  WHERE gm.`status` = 1 
                  ORDER BY gm.`created_at` DESC 
                  LIMIT " . (int)$limit;

        $db = new Database();
        $result = $db->readQuery($query);

        $items = [];
        while ($row = mysqli_fetch_array($result)) {
            $items[] = $row;
        }
        return $items;
    }

    /**
     * Get highlighted items first, then fill remaining slots with latest items
     * This is used for the home page Highlights section
     */
    public function getHighlightsAndLatest($limit = 8)
    {
        // First get highlighted items
        $highlights = $this->getHighlights($limit);
        $highlightIds = array_map(function($item) { return $item['id']; }, $highlights);
        
        // If we already have enough, return them
        if (count($highlights) >= $limit) {
            return array_slice($highlights, 0, $limit);
        }

        // Fill remaining slots with latest non-highlighted items
        $remaining = $limit - count($highlights);
        $excludeIds = !empty($highlightIds) ? implode(',', $highlightIds) : '0';
        
        $query = "SELECT gm.*, c.name as company_name 
                  FROM `gallery_media` gm 
                  LEFT JOIN `company` c ON gm.company_id = c.id 
                  WHERE gm.`status` = 1 
                  AND gm.`id` NOT IN ($excludeIds)
                  ORDER BY gm.`created_at` DESC 
                  LIMIT " . (int)$remaining;

        $db = new Database();
        $result = $db->readQuery($query);

        while ($row = mysqli_fetch_array($result)) {
            $highlights[] = $row;
        }

        return $highlights;
    }

    /**
     * Toggle highlight status for a gallery item
     */
    public function toggleHighlight($id)
    {
        $query = "UPDATE `gallery_media` SET `is_highlight` = NOT `is_highlight` WHERE `id` = " . (int)$id;
        $db = new Database();
        return $db->readQuery($query);
    }

    /**
     * Get all gallery items (for admin panel)
     */
    public function all($companyFilter = null)
    {
        $query = "SELECT gm.*, c.name as company_name 
                  FROM `gallery_media` gm 
                  LEFT JOIN `company` c ON gm.company_id = c.id";
        
        if ($companyFilter) {
            $query .= " WHERE gm.`company_id` = " . (int)$companyFilter;
        }
        
        $query .= " ORDER BY gm.`sort_order` ASC, gm.`created_at` DESC";

        $db = new Database();
        $result = $db->readQuery($query);

        $items = [];
        while ($row = mysqli_fetch_array($result)) {
            $items[] = $row;
        }
        return $items;
    }

    /**
     * Get the next sort order number
     */
    public function getNextSortOrder($companyId)
    {
        $query = "SELECT MAX(`sort_order`) as max_order FROM `gallery_media` WHERE `company_id` = " . (int)$companyId;
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return ($result['max_order'] ?? 0) + 1;
    }

    /**
     * Extract YouTube video ID from URL
     */
    public static function getYoutubeId($url)
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }

    /**
     * Get YouTube thumbnail URL
     */
    public static function getYoutubeThumbnail($url)
    {
        $videoId = self::getYoutubeId($url);
        if ($videoId) {
            return 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg';
        }
        return null;
    }

    /**
     * Get the display URL for a gallery item (thumbnail or file)
     */
    public function getDisplayUrl($basePath = '')
    {
        if ($this->media_type === 'photo' && $this->file_name) {
            return $basePath . 'upload/gallery/' . $this->file_name;
        }
        if ($this->thumbnail) {
            return $basePath . 'upload/gallery/' . $this->thumbnail;
        }
        if ($this->video_url) {
            return self::getYoutubeThumbnail($this->video_url);
        }
        return $basePath . 'assets/images/gallery-placeholder.jpg';
    }
}
