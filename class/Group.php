<?php
class Group
{
    public $id;
    public $group_name;
    public $group_payment;
    public $document_charge;
    public $country;

    public function __construct($id = null)
    {
        if ($id) $this->load($id);
    }

    private function load($id)
    {
        $db = new Database();
        $id = (int)$id;
        $query = "SELECT * FROM `groups` WHERE `id` = $id";
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

        $query = "INSERT INTO `groups` (
            `group_name`, `group_payment`, `document_charge`, `country`
        ) VALUES (
            '" . $this->group_name . "',
            '" . $this->group_payment . "',
            '" . $this->document_charge . "',
            '" . $this->country . "'
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

        $query = "UPDATE `groups` SET
            `group_name` = '" . $this->group_name . "',
            `group_payment` = '" . $this->group_payment . "',
            `document_charge` = '" . $this->document_charge . "',
            `country` = '" . $this->country . "'
        WHERE `id` = " . (int)$this->id;

        return $db->readQuery($query);
    }

    public function delete()
    {
        if (!$this->id) return false;

        $db = new Database();
        $query = "DELETE FROM `groups` WHERE `id` = " . (int)$this->id;
        return $db->readQuery($query);
    }

    public function all($orderBy = 'id', $order = 'DESC')
    {
        $db = new Database();
        $allowedColumns = ['id', 'group_name', 'country', 'group_payment'];
        $orderBy = in_array(strtolower($orderBy), $allowedColumns) ? $orderBy : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';

        // Join with countries table to get country name if needed
        $query = "SELECT g.*, c.name as country_name 
                 FROM `groups` g 
                 LEFT JOIN country c ON g.country = c.id 
                 ORDER BY `$orderBy` $order";
                 
        $result = $db->readQuery($query);

        if (!$result) {
            // Log error and return empty array
            error_log("Error in Group::all(): " . mysqli_error($db->DB_CON));
            return [];
        }

        $groups = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $groups[] = [
                'id' => $row['id'],
                'group_name' => $row['group_name'],
                'group_payment' => $row['group_payment'],
                'document_charge' => $row['document_charge'],
                'formatted_group_payment' => number_format($row['group_payment'], 2),
                'formatted_document_charge' => number_format($row['document_charge'], 2),
                'country' => $row['country_name'] ?? $row['country']
            ];
        }

        return $groups;
    }
}
?>
