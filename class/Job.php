<?php

class Job
{
    public $id;
    public $title;
    public $description;
    public $country;
    public $image;
    public $respons_person;

    public function __construct($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM `jobs` WHERE `id` = " . (int)$id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            if ($result) {
                $this->id = $result['id'];
                $this->title = $result['title'];
                $this->description = $result['description'];
                $this->country = $result['country'];
                $this->image = $result['image'];
                $this->respons_person = $result['respons_person'];
            }
        }
    }

    public function create()
    {
        $query = "INSERT INTO `jobs` (
            `title`, `description`, `country`, `image`, `respons_person`
        ) VALUES (
            '$this->title', '$this->description', '$this->country', '$this->image', '$this->respons_person'
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
        $query = "UPDATE `jobs` SET 
            `title` = '$this->title',
            `description` = '$this->description',
            `country` = '$this->country',
            `image` = '$this->image',
            `respons_person` = '$this->respons_person'
        WHERE `id` = '$this->id'";

        $db = new Database();
        return $db->readQuery($query);
    }

    public function delete()
    {
        $query = "DELETE FROM `jobs` WHERE `id` = '$this->id'";
        $db = new Database();
        return $db->readQuery($query);
    }

    public function all()
    {
        $query = "SELECT * FROM `jobs` ORDER BY `id` DESC";
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
        $query = "SELECT * FROM `jobs` ORDER BY `id` DESC LIMIT 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['id'] ?? null;
    }
}
