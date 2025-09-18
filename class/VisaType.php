<?php

class VisaType
{
    public $id;
    public $name;

    public function __construct($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM `visa_type` WHERE `id` = " . (int)$id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            if ($result) {
                $this->id = $result['id'];
                $this->name = $result['name'];
            }
        }
    }

    // Create a new VisaType
    public function create()
    {
        $query = "INSERT INTO `visa_type` (`name`) VALUES ('" . $this->name . "')";
        $db = new Database();
        $result = $db->readQuery($query);

        return $result ? true : false;
    }

    // Update an existing VisaType
    public function update()
    {
        $query = "UPDATE `visa_type` SET `name` = '" . $this->name . "' WHERE `id` = '" . (int)$this->id . "'";
        $db = new Database();
        $result = $db->readQuery($query);

        return $result ? $this->__construct($this->id) : false;
    }

    // Get all VisaType records
    public function all()
    {
        $query = "SELECT * FROM `visa_type` ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);

        $array_res = [];
        while ($row = mysqli_fetch_array($result)) {
            $array_res[] = $row;
        }
        return $array_res;
    }

    // Delete a VisaType
    public function delete()
    {
        $query = "DELETE FROM `visa_type` WHERE `id` = '" . (int)$this->id . "'";
        $db = new Database();
        return $db->readQuery($query);
    }

    // Optional: Arrange queue (if needed)
    public function arrange($key, $id)
    {
        $query = "UPDATE `visa_type` SET `queue` = '" . (int)$key . "' WHERE `id` = '" . (int)$id . "'";
        $db = new Database();
        return $db->readQuery($query);
    }
}
