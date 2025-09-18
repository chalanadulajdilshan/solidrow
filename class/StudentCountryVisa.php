<?php
class StudentCountryVisa
{
    public $id;
    public $country_id;
    public $visa_category;

    public function __construct($id = null)
    {
        if ($id) $this->load($id);
    }

    private function load($id)
    {
        $db = new Database();
        $id = (int)$id;
        $query = "SELECT * FROM `student_visa_country` WHERE `id` = $id";
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

        $query = "INSERT INTO `student_visa_country` (`country_id`, `visa_category`)
                  VALUES ('$this->country_id', '$this->visa_category')";

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

        $query = "UPDATE `student_visa_country` SET
                    `country_id` = '$this->country_id',
                    `visa_category` = '$this->visa_category'
                  WHERE `id` = $this->id";

        return $db->readQuery($query);
    }

    public function delete()
    {
        if (!$this->id) return false;

        $db = new Database();
        $query = "DELETE FROM `student_visa_country` WHERE `id` = $this->id";
        return $db->readQuery($query);
    }

    public function all($orderBy = 'id', $order = 'DESC')
    {
        $db = new Database();
        $allowedColumns = ['id', 'country_id', 'visa_category'];
        $orderBy = in_array(strtolower($orderBy), $allowedColumns) ? $orderBy : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';

        $query = "SELECT * FROM `student_visa_country` ORDER BY `$orderBy` $order";
        $result = $db->readQuery($query);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getByCountry($countryId)
    {
        $db = new Database();
        $countryId = (int)$countryId;
        
        $query = "SELECT DISTINCT `visa_category` FROM `student_visa_country` 
                 WHERE `country_id` = $countryId 
                 ORDER BY `visa_category` ASC";
        
        $result = $db->readQuery($query);
        
        $categories = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = [
                'visa_category' => $row['visa_category']
            ];
        }
        
        return $categories;
    }
}
