<?php

class Company
{
    public $id;
    public $name;
    public $short_desc;
    public $image_name;
    public $page_url;

    public function __construct($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM `company` WHERE `id` = " . (int)$id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            if ($result) {
                $this->id = $result['id'];
                $this->name = $result['name'];
                $this->short_desc = $result['short_desc'];
                $this->image_name = $result['image_name'];
                $this->page_url = $result['page_url'];
            }
        }
    }

    public function create()
    {
        $query = "INSERT INTO `company` (`name`, `short_desc`, `image_name`, `page_url`) 
                  VALUES ('$this->name', '$this->short_desc', '$this->image_name', '$this->page_url')";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        }
        return false;
    }

    public function update()
    {
        $query = "UPDATE `company` SET 
                  `name` = '$this->name',
                  `short_desc` = '$this->short_desc',
                  `image_name` = '$this->image_name',
                  `page_url` = '$this->page_url'
                  WHERE `id` = '$this->id'";

        $db = new Database();
        return $db->readQuery($query);
    }

    public function delete()
    {
        $query = "DELETE FROM `company` WHERE `id` = '$this->id'";
        $db = new Database();
        return $db->readQuery($query);
    }

    public function all()
    {
        $query = "SELECT * FROM `company` ORDER BY `id` DESC";
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
        $query = "SELECT * FROM `company` ORDER BY `id` DESC LIMIT 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['id'] ?? null;
    }
}
