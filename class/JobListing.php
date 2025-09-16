<?php

class JobListing
{
    public $id;
    public $name;
    public $position;
    public $description;
    public $image;
    public $is_active;

    public function __construct($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM `joblisting` WHERE `id` = " . (int)$id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            if ($result) {
                $this->id = $result['id'];
                $this->name = $result['name'];
                $this->position = $result['position'];
                $this->description = $result['description'];
                $this->image = $result['image'];
                $this->is_active = $result['is_active'];
            }
        }
    }

    public function create()
    {
        $query = "INSERT INTO `joblisting` (
            `name`, `position`, `description`, `image`, `is_active`
        ) VALUES (
            '$this->name', '$this->position', '$this->description', 
            '$this->image', '$this->is_active'
        )";

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
        $query = "UPDATE `joblisting` SET 
            `name` = '$this->name',
            `position` = '$this->position',
            `description` = '$this->description',
            `image" . ($this->image ? "` = '$this->image'" : "` = `image`") . ",
            `is_active` = '$this->is_active'
            WHERE `id` = '$this->id'";

        $db = new Database();
        return $db->readQuery($query);
    }

    public function delete()
    {
        $query = "DELETE FROM `joblisting` WHERE `id` = '$this->id'";
        $db = new Database();
        return $db->readQuery($query);
    }

    public function all()
    {
        $query = "SELECT * FROM `joblisting` ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);

        $array_res = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getActiveJobs()
    {
        $query = "SELECT * FROM `joblisting` WHERE `is_active` = 1 ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);

        $array_res = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function toggleStatus()
    {
        $this->is_active = $this->is_active ? 0 : 1;
        $query = "UPDATE `joblisting` SET `is_active` = '$this->is_active' WHERE `id` = '$this->id'";
        $db = new Database();
        return $db->readQuery($query);
    }
}
