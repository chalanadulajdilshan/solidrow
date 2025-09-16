<?php

class Career
{
    public $id;
    public $name;
    public $mobile;
    public $address;
    public $position;
    public $experience;
    public $cv;
    public $created_at;

    public function __construct($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM `careers` WHERE `id` = " . (int)$id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            if ($result) {
                $this->id = $result['id'];
                $this->name = $result['name'];
                $this->mobile = $result['mobile'] ?? '';
                $this->address = $result['address'];
                $this->position = $result['position'];
                $this->experience = $result['experience'];
                $this->cv = $result['cv'];
                $this->created_at = $result['created_at'];
            }
        }
    }

    public function create()
    {
        $db = new Database();

        // Escape all input data
        $name = mysqli_real_escape_string($db->DB_CON, $this->name);
        $mobile = mysqli_real_escape_string($db->DB_CON, $this->mobile);
        $address = mysqli_real_escape_string($db->DB_CON, $this->address);
        $position = mysqli_real_escape_string($db->DB_CON, $this->position);
        $experience = mysqli_real_escape_string($db->DB_CON, $this->experience);
        $cv = mysqli_real_escape_string($db->DB_CON, $this->cv);

        $query = "INSERT INTO `careers` (
            `name`, `mobile`, `address`, `position`, `experience`, `cv`
        ) VALUES (
            '$name', '$mobile', '$address', '$position', '$experience', '$cv'
        )";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {
            return false;
        }
    }

    public function all()
    {
        $query = "SELECT * FROM `careers` ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);

        $array_res = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
}
