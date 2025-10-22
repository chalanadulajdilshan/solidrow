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
        $allowedColumns = ['id', 'name', 'contact_no', 'whatsapp_no', 'nic'];
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
}
