<?php
class Notification
{
    public $id;
    public $title;
    public $description;
    public $created_at;

    public function __construct($id = null)
    {
        if ($id) $this->load($id);
    }

    private function load($id)
    {
        $db = new Database();
        $id = (int)$id;
        $query = "SELECT * FROM `notifications` WHERE `id` = $id";
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
        $title = mysqli_real_escape_string($db->DB_CON, $this->title);
        $description = mysqli_real_escape_string($db->DB_CON, $this->description);

        $query = "INSERT INTO `notifications` (`title`, `description`, `created_at`)
                  VALUES ('$title', '$description', NOW())";

        $result = $db->readQuery($query);
        return $result ? mysqli_insert_id($db->DB_CON) : false;
    }

    public function update()
    {
        if (!$this->id) return false;

        $db = new Database();
        $title = mysqli_real_escape_string($db->DB_CON, $this->title);
        $description = mysqli_real_escape_string($db->DB_CON, $this->description);

        $query = "UPDATE `notifications` SET 
                    `title` = '$title',
                    `description` = '$description'
                  WHERE `id` = $this->id";

        return $db->readQuery($query);
    }

    public function delete()
    {
        if (!$this->id) return false;
        $db = new Database();
        $query = "DELETE FROM `notifications` WHERE `id` = $this->id";
        return $db->readQuery($query);
    }

    public function all($orderBy = 'id', $order = 'DESC')
    {
        $db = new Database();
        $query = "SELECT `id`, `title`, `description`, `created_at` 
                  FROM `notifications` ORDER BY `$orderBy` $order";
        $result = $db->readQuery($query);

        $notifications = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $notifications[] = $row;
        }

        return $notifications;
    }
}
