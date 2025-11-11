<?php
class Application
{
    public $id;
    public $fullname;
    public $NIC;
    public $passportnumber;
    public $married_status;
    public $mobile_number;
    public $whatsapp_number; 
    public $country;

    public function __construct($id = null)
    {
        if ($id) $this->load($id);
    }

    private function load($id)
    {
        $db = new Database();
        $id = (int)$id;
        $query = "SELECT * FROM `application` WHERE `id` = $id";
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

        $query = "INSERT INTO `application` 
                    (`fullname`, `NIC`, `passportnumber`, `married_status`, `mobile_number`, `whatsapp_number`, `country`)
                  VALUES 
                    ('$this->fullname', '$this->NIC', '$this->passportnumber', '$this->married_status', '$this->mobile_number', '$this->whatsapp_number', '$this->country')";

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

        $query = "UPDATE `application` SET
                    `fullname` = '$this->fullname',
                    `NIC` = '$this->NIC',
                    `passportnumber` = '$this->passportnumber',
                    `married_status` = '$this->married_status',
                    `mobile_number` = '$this->mobile_number',
                    `whatsapp_number` = '$this->whatsapp_number',
                    `country` = '$this->country'
                  WHERE `id` = $this->id";

        return $db->readQuery($query);
    }

    public function delete()
    {
        if (!$this->id) return false;

        $db = new Database();
        $query = "DELETE FROM `application` WHERE `id` = $this->id";
        return $db->readQuery($query);
    }

    public function all($orderBy = 'id', $order = 'DESC')
    {
        $db = new Database();
        $allowedColumns = ['id', 'fullname', 'NIC', 'country'];
        $orderBy = in_array(strtolower($orderBy), $allowedColumns) ? $orderBy : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';

        $query = "SELECT * FROM `application` ORDER BY `$orderBy` $order";
        $result = $db->readQuery($query);

        $applications = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $applications[] = $row;
        }

        return $applications;
    }
}
?>
