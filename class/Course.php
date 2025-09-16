<?php
class Course
{
    public $id;
    public $name;
    public $price;
    public $image_name;
    public $short_description;
    public $description;
    public $staff_id;
    public $queue;

    private $upload_dir = '../../upload/course/';

    public function __construct($id = null)
    {
        if ($id) $this->load($id);
    }

    private function load($id)
    {
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

    public function create()
    {
        $db = new Database();

        $query = "INSERT INTO `courses` (`name`, `price`, `image_name`, `short_description`, `description`, `staff_id`, `queue`)
                  VALUES ('$this->name', '$this->price', '$this->image_name', '$this->short_description', '$this->description', '$this->staff_id', '$this->queue')";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {
            return false;
        }
    }

    public function update()
    {
        if (!$this->id) return false;

        $db = new Database();

        $query = "UPDATE `courses` SET
                    `name` = '$this->name',
                    `price` = '$this->price',
                    `image_name` = '$this->image_name',
                    `short_description` = '$this->short_description',
                    `description` = '$this->description',
                    `staff_id` = '$this->staff_id',
                    `queue` = '$this->queue'
                  WHERE `id` = $this->id";

        $db = new Database();
        return $db->readQuery($query);
    }

    public function delete()
    {
        if (!$this->id) return false;

        if (!empty($this->image_name)) {
            $file_path = $this->upload_dir . $this->image_name;
            if (file_exists($file_path)) unlink($file_path);
        }

        $db = new Database();
        $query = "DELETE FROM `courses` WHERE `id` = $this->id";
        return $db->readQuery($query);
    }

    public function all($orderBy = 'id', $order = 'DESC')
    {
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
