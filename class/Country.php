<?php

class Country
{
    public $id;
    public $name;
    public $is_active;
    public $commission_rate;

    public function __construct($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM `country` WHERE `id` = " . (int)$id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            if ($result) {
                $this->id = $result['id'];
                $this->name = $result['name'];
                $this->is_active = $result['is_active'];
                $this->commission_rate = $result['commission_rate'];
            }
        }
    }

    public function create()
    {
        $query = "INSERT INTO `country` (`name`, `is_active`, `commission_rate`) 
                  VALUES ('$this->name', '$this->is_active', '$this->commission_rate')";

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
        $query = "UPDATE `country` SET 
                  `name` = '$this->name',
                  `is_active` = '$this->is_active',
                  `commission_rate` = '$this->commission_rate'
                  WHERE `id` = '$this->id'";

        $db = new Database();
        return $db->readQuery($query);
    }

    public function delete()
    {
        $query = "DELETE FROM `country` WHERE `id` = '$this->id'";
        $db = new Database();
        return $db->readQuery($query);
    }

    public function all()
    {
        $query = "SELECT * FROM `country` ORDER BY `id` DESC";
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
        $query = "SELECT * FROM `country` ORDER BY `id` DESC LIMIT 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['id'] ?? null;
    }
}
