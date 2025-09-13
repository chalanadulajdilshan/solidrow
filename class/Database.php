<?php

/**
 * Description of User
 *
 * @author Suharshana DsW
 * @web www.nysc.lk
 * */
class Database {

    private $host = 'localhost';
    private $name = 'solidrow';
    private $user = 'root';
    private $password = '';
    public $DB_CON = NULL;

    public function __construct() {
        // Establish database connection
        $this->DB_CON = mysqli_connect($this->host, $this->user, $this->password, $this->name);

        // Check for connection errors
        if (mysqli_connect_errno()) {
            throw new Exception('Failed to connect to MySQL: ' . mysqli_connect_error());
        }

        // Set the character set to UTF-8 to support Sinhala characters
        if (!mysqli_set_charset($this->DB_CON, "utf8mb4")) {
            throw new Exception('Error loading character set utf8mb4: ' . mysqli_error($this->DB_CON));
        }
    }

    // Function to execute read queries (SELECT)
    public function readQuery($query) {
        $result = mysqli_query($this->DB_CON, $query);
        if (!$result) {
            throw new Exception('Query failed: ' . mysqli_error($this->DB_CON));
        }
        return $result;
    }

    // Function to execute write queries (INSERT, UPDATE, DELETE)
    public function readQuery1($query) {
        $result = mysqli_query($this->DB_CON, $query);
        if ($result === TRUE) {
            // If query was successful, return the last inserted ID
            return $this->DB_CON->insert_id;
        } elseif (!$result) {
            // If query fails, throw an exception with the error message
            throw new Exception('Query failed: ' . mysqli_error($this->DB_CON));
        }
        return $result;
    }

    // Close the database connection
    public function closeConnection() {
        if ($this->DB_CON) {
            mysqli_close($this->DB_CON);
        }
    }
}
