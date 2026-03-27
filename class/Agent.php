<?php
class Agent
{
    public $id;   
    public $name; 
    public $contact_no;
    public $whatsapp_no;
    public $nic; 

    public function __construct($id = null)
    {
        if ($id) $this->load($id);
    }

    private function load($id)
    {
        $db = new Database();
        $id = (int)$id;
        $query = "SELECT * FROM `agent` WHERE `id` = $id";
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

       $query = "INSERT INTO `agent` (
    `name`, `contact_no`, `whatsapp_no`, `nic`
) VALUES (
    '" . $this->name . "',
    '" . $this->contact_no . "',
    '" . $this->whatsapp_no . "',
    '" . $this->nic . "'
)";

        $result = $db->readQuery($query);

        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        }
        return false;
    }

 

  public function update()
{
    if (!$this->id) return false;

    $db = new Database();

    $query = "UPDATE `agent` SET
        `name` = '" . $this->name . "',
        `contact_no` = '" . $this->contact_no . "',
        `whatsapp_no` = '" . $this->whatsapp_no . "',
        `nic` = '" . $this->nic . "'
        WHERE `id` = " . (int)$this->id;

    return $db->readQuery($query);
}


    public function delete()
    { 

        $db = new Database();
        $query = "DELETE FROM `agent` WHERE `id` = " . (int)$this->id;
        return $db->readQuery($query);
    }

    public function all($orderBy = 'id', $order = 'DESC')
    {
        $db = new Database();
        $allowedColumns = ['id', 'name', 'contact_no', 'whatsapp_no', 'nic', 'is_active_registration'];
        $orderBy = in_array(strtolower($orderBy), $allowedColumns) ? $orderBy : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';

        $query = "SELECT * FROM `agent` ORDER BY `$orderBy` $order";
        $result = $db->readQuery($query);

        $staff = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $staff[] = $row;
        }

        return $staff;
    }

    public static function setActiveForRegistration($id)
    {
        $db = new Database();
        // Deactivate all first
        $query1 = "UPDATE `agent` SET `is_active_registration` = 0";
        $db->readQuery($query1);

        // Activate selected one
        $query2 = "UPDATE `agent` SET `is_active_registration` = 1 WHERE `id` = " . (int)$id;
        return $db->readQuery($query2);
    }

    public static function getActiveRegistrationAgent()
    {
        $query = "SELECT `id` FROM `agent` WHERE `is_active_registration` = 1 LIMIT 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));

        if ($result) {
            return $result['id'];
        }
        return null;
    }
}
