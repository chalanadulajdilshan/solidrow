<?php
class Course {
    public $id;
    public $name;
    public $price;
    public $image_name;
    public $short_description;
    public $description;
    public $staff_id;
    public $queue;

    private $upload_dir = '../../upload/course/';

    public function __construct($id = null) {
        if ($id) $this->load($id);
    }

    private function load($id) {
        $db = new Database();
        $id = (int)$id;
        $query = "SELECT * FROM `courses` WHERE `id` = $id";
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

        $name = mysqli_real_escape_string($db->DB_CON, $this->name);
        $price = (float)$this->price;
        $image_name = mysqli_real_escape_string($db->DB_CON, $this->image_name ?? '');
        $short_description = mysqli_real_escape_string($db->DB_CON, $this->short_description);
        $description = mysqli_real_escape_string($db->DB_CON, $this->description);
        $staff_id = (int)$this->staff_id;
        $queue = (int)$this->queue;

        $query = "INSERT INTO `courses` (`name`, `price`, `image_name`, `short_description`, `description`, `staff_id`, `queue`)
                  VALUES ('$name', '$price', '$image_name', '$short_description', '$description', '$staff_id', '$queue')";

        if ($db->readQuery($query)) {
            $this->id = mysqli_insert_id($db->DB_CON);
            return $this->id;
        }
        return false;
    }

    public function update() {
        if (!$this->id) return false;

        $db = new Database();

        $name = mysqli_real_escape_string($db->DB_CON, $this->name);
        $price = (float)$this->price;
        $image_name = mysqli_real_escape_string($db->DB_CON, $this->image_name ?? '');
        $short_description = mysqli_real_escape_string($db->DB_CON, $this->short_description);
        $description = mysqli_real_escape_string($db->DB_CON, $this->description);
        $staff_id = (int)$this->staff_id;
        $queue = (int)$this->queue;
        $id = (int)$this->id;

        $query = "UPDATE `courses` SET
                    `name` = '$name',
                    `price` = '$price',
                    `image_name` = '$image_name',
                    `short_description` = '$short_description',
                    `description` = '$description',
                    `staff_id` = '$staff_id',
                    `queue` = '$queue'
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
        $query = "DELETE FROM `courses` WHERE `id` = $id";
        return $db->readQuery($query);
    }

    public function all($orderBy = 'id', $order = 'DESC') {
        $db = new Database();
        $allowedColumns = ['id', 'name', 'price', 'queue'];
        $orderBy = in_array(strtolower($orderBy), $allowedColumns) ? $orderBy : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';

        $query = "SELECT * FROM `courses` ORDER BY `$orderBy` $order";
        $result = $db->readQuery($query);

        $courses = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $courses[] = $row;
        }

        return $courses;
    }
}
