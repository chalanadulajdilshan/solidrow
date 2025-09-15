<?php

class Province
{
    public $id;
    public $name;
    public $queue;

    public function __construct($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM `provinces` WHERE `id` = " . (int)$id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            if ($result) {
                $this->id = $result['id'];
                $this->name = $result['name'];
                $this->queue = $result['queue'];
            }
        }
    }

    // Get all provinces
    public function all()
    {
        $query = "SELECT `id`, `name`, `queue` FROM `provinces` ORDER BY `queue` ASC";
        $db = new Database();
        $result = $db->readQuery($query);

        $array_res = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
}
