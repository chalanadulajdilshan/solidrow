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
        $query = "SELECT `id`, `name`, `is_active_registration` FROM `locations` ORDER BY `name` ASC";
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

    public static function setActiveForRegistration($id)
    {
        $db = new Database();
        // Deactivate all first
        $query1 = "UPDATE `locations` SET `is_active_registration` = 0";
        $db->readQuery($query1);

        // Activate selected one
        $query2 = "UPDATE `locations` SET `is_active_registration` = 1 WHERE `id` = " . (int)$id;
        return $db->readQuery($query2);
    }

    public static function getActiveRegistrationLocation()
    {
        $query = "SELECT `id` FROM `locations` WHERE `is_active_registration` = 1 LIMIT 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));

        if ($result) {
            return $result['id'];
        }
        return 2; // Default fallback to ID 2 if none set
    }
}
