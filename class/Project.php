<?php
class Project {
    public $id;
    public $title;
    public $image_name;
    public $short_description;
    public $project_date;

    private $upload_dir = '../../upload/project/';

    public function __construct($id = null) {
        if ($id) $this->load($id);
    }

    private function load($id) {
        $db = new Database();
        $id = (int)$id;
        $query = "SELECT * FROM `projects` WHERE `id` = $id";
        $result = mysqli_fetch_assoc($db->readQuery($query));

        if ($result) {
            foreach ($result as $key => $value) {
                $this->$key = $value;
            }
            return true;
        }
        return false;
    }

    public function create() {
        $db = new Database();

        $title = mysqli_real_escape_string($db->DB_CON, $this->title);
        $image_name = mysqli_real_escape_string($db->DB_CON, $this->image_name ?? '');
        $short_description = mysqli_real_escape_string($db->DB_CON, $this->short_description);
        $project_date = mysqli_real_escape_string($db->DB_CON, $this->project_date);

        $query = "INSERT INTO `projects` (`title`, `image_name`, `short_description`, `project_date`)
                  VALUES ('$title', '$image_name', '$short_description', '$project_date')";

        if ($db->readQuery($query)) {
            $this->id = mysqli_insert_id($db->DB_CON);
            return $this->id;
        }
        return false;
    }

    public function update() {
        if (!$this->id) return false;

        $db = new Database();

        $title = mysqli_real_escape_string($db->DB_CON, $this->title);
        $image_name = mysqli_real_escape_string($db->DB_CON, $this->image_name ?? '');
        $short_description = mysqli_real_escape_string($db->DB_CON, $this->short_description);
        $project_date = mysqli_real_escape_string($db->DB_CON, $this->project_date);
        $id = (int)$this->id;

        $query = "UPDATE `projects` SET
                    `title` = '$title',
                    `image_name` = '$image_name',
                    `short_description` = '$short_description',
                    `project_date` = '$project_date'
                  WHERE `id` = $id";

        return $db->readQuery($query);
    }

    public function delete() {
        if (!$this->id) return false;

        if (!empty($this->image_name)) {
            $file_path = $this->upload_dir . $this->image_name;
            if (file_exists($file_path)) unlink($file_path);
        }

        $db = new Database();
        $id = (int)$this->id;
        $query = "DELETE FROM `projects` WHERE `id` = $id";
        return $db->readQuery($query);
    }

    public function all($orderBy = 'id', $order = 'DESC') {
        $db = new Database();
        $orderBy = in_array(strtolower($orderBy), ['id', 'title', 'project_date']) ? $orderBy : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';

        $query = "SELECT * FROM `projects` ORDER BY `$orderBy` $order";
        $result = $db->readQuery($query);

        $projects = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $projects[] = $row;
        }

        return $projects;
    }
}
