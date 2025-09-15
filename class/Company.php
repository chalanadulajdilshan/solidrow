<?php
class Company
{
    public $id;
    public $name;
    public $short_desc;
    public $image_name;
    public $image_url;

    private $upload_dir = '../../upload/company/';

    public function __construct($id = null)
    {
        if ($id) {
            $this->load($id);
        }
    }

    private function load($id)
    {
        $db = new Database();
        $id = (int)$id;
        $query = "SELECT * FROM `company` WHERE `id` = $id";
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
        
        $name = mysqli_real_escape_string($db->DB_CON, $this->name);
        $short_desc = mysqli_real_escape_string($db->DB_CON, $this->short_desc);
        $image_name = mysqli_real_escape_string($db->DB_CON, $this->image_name ?? '');
        $image_url = mysqli_real_escape_string($db->DB_CON, $this->image_url ?? '');

        $query = "INSERT INTO `company` 
                 (`name`, `short_desc`, `image_name`, `image_url`) 
                 VALUES 
                 ('$name', '$short_desc', '$image_name', '$image_url')";

        // var_dump($query);
        // exit();

        if ($db->readQuery($query)) {
            $this->id = mysqli_insert_id($db->DB_CON);
            return $this->id;
        }
        return false;
    }

    public function update()
    {
        if (!$this->id) {
            return false;
        }

        $db = new Database();
        
        $name = mysqli_real_escape_string($db->DB_CON, $this->name);
        $short_desc = mysqli_real_escape_string($db->DB_CON, $this->short_desc);
        $image_name = mysqli_real_escape_string($db->DB_CON, $this->image_name ?? '');
        $image_url = mysqli_real_escape_string($db->DB_CON, $this->image_url ?? '');
        $id = (int)$this->id;

        $query = "UPDATE `company` SET 
                 `name` = '$name',
                 `short_desc` = '$short_desc',
                 `image_name` = '$image_name',
                 `image_url` = '$image_url'
                 WHERE `id` = $id";

        return $db->readQuery($query);
    }

    public function delete()
    {
        if (!$this->id) {
            return false;
        }

        $this->deleteImage();
        $db = new Database();
        $id = (int)$this->id;
        $query = "DELETE FROM `company` WHERE `id` = $id";
        
        return $db->readQuery($query);
    }

    public function deleteImage()
    {
        if (!empty($this->image_name)) {
            $file_path = $this->upload_dir . $this->image_name;
            if (file_exists($file_path) && is_file($file_path)) {
                return unlink($file_path);
            }
        }
        return false;
    }

    public function all($orderBy = 'id', $order = 'DESC')
    {
        $db = new Database();
        $orderBy = in_array(strtolower($orderBy), ['id', 'name', 'created_at']) ? $orderBy : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
        
        $query = "SELECT * FROM `company` ORDER BY `$orderBy` $order";
        $result = $db->readQuery($query);

        $companies = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $companies[] = $row;
        }

        return $companies;
    }
}