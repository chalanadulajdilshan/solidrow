<?php

class Location
{
    public $id;
    public $name;

    public function __construct($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM `locations` WHERE `id` = " . (int)$id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            if ($result) {
                $this->id = $result['id'];
                $this->name = $result['name'];
            }
        }
    }

    // Get all locations
    public function all()
    {
        $query = "SELECT `id`, `name` FROM `locations` ORDER BY `name` ASC";
        $db = new Database();
        $result = $db->readQuery($query);

        $array_res = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function create()
    {
        $db = new Database();
        $query = "INSERT INTO `locations` (`name`) VALUES ('" . mysqli_real_escape_string($db->DB_CON, $this->name) . "')";
        $result = $db->readQuery($query);

        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {
            return false;
        }
    }

    public function update()
    {
        $db = new Database();
        $query = "UPDATE `locations` SET `name` = '" . mysqli_real_escape_string($db->DB_CON, $this->name) . "' WHERE `id` = " . (int)$this->id;
        return $db->readQuery($query);
    }

    public function delete()
    {
        $db = new Database();
        $query = "DELETE FROM `locations` WHERE `id` = " . (int)$this->id;
        return $db->readQuery($query);
    }
}
