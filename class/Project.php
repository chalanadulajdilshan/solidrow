<?php
class Project
{
    public $id;
    public $title;
    public $image_name;
    public $short_description;
    public $project_date;

    private $upload_dir = '../../upload/project/';

    public function __construct($id = null)
    {
        if ($id) $this->load($id);
    }

    private function load($id)
    {
        $db = new Database();
        $id = (int)$id;
        $query = "SELECT * FROM `projects` WHERE `id` = $id";
        $result = mysqli_fetch_assoc($db->readQuery($query));

        if ($result) {
            foreach ($result as $key => $value) {
                $this->$key = $value;
            }
            return true;
        }
        return false;
    }

    public function create()
    {
        $db = new Database();

        $query = "INSERT INTO `projects` (`title`, `image_name`, `short_description`, `project_date`)
                  VALUES (' $this->title', '$this->image_name', '$this->short_description', '$this->project_date')";

        $result = $db->readQuery($query);

        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {
            return false;
        }
    }

    public function update()
    {
        if (!$this->id) return false;

        $db = new Database();

        $query = "UPDATE `projects` SET
                    `title` = '$this->title',
                    `image_name` = '$this->image_name',
                    `short_description` = '$this->short_description',
                    `project_date` = '$this->project_date'
                  WHERE `id` = $this->id";

        return $db->readQuery($query);
    }
    public function delete()
    {
        $query = "DELETE FROM `projects` WHERE `id` = '$this->id'";
        $db = new Database();
        return $db->readQuery($query);
    }

    public function all($orderBy = 'id', $order = 'DESC')
    {
        $db = new Database();
        $orderBy = in_array(strtolower($orderBy), ['id', 'title', 'project_date']) ? $orderBy : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';

        $query = "SELECT * FROM `projects` ORDER BY `$orderBy` $order";
        $result = $db->readQuery($query);

        $projects = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $projects[] = $row;
        }

        return $projects;
    }
}
