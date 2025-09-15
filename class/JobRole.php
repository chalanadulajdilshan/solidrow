<?php

class JobRole
{
    public $id;
    public $name;
    public $is_active;

    public function __construct($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM `job_role` WHERE `id` = " . (int)$id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            if ($result) {
                $this->id = $result['id'];
                $this->name = $result['name'];
                $this->is_active = $result['is_active'];
            }
        }
    }

    public function create()
    {
        $query = "INSERT INTO `job_role` (`name`, `is_active`) 
                  VALUES ('$this->name', '$this->is_active')";

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
        $query = "UPDATE `job_role` SET 
                  `name` = '$this->name',
                  `is_active` = '$this->is_active'
                  WHERE `id` = '$this->id'";

        $db = new Database();
        return $db->readQuery($query);
    }

    public function delete()
    {
        $query = "DELETE FROM `job_role` WHERE `id` = '$this->id'";
        $db = new Database();
        return $db->readQuery($query);
    }

    public function all()
    {
        $query = "SELECT * FROM `job_role` ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);

        $array_res = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getLastID()
    {
        $query = "SELECT * FROM `job_role` ORDER BY `id` DESC LIMIT 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['id'] ?? null;
    }
}
