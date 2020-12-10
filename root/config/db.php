<?php
    // $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // if (mysqli_connect_errno())
    // {
    //     echo 'Failed to connect to MySQL ' . mysqli_connect_errno();
    // }

    // Setup PDO
    class Database {
        private $DB_HOST = 'localhost';
        private $DB_NAME = 'blogs';
        private $DB_USER = 'jaeyeon';
        private $DB_PASS = 'P4sswoid1!';

        public $conn;

        public function getConnection() {
            $this->conn = null;

            try {
                $this->conn = new PDO("mysql:host=" . $this->DB_HOST . ";dbname=" . $this->DB_NAME, $this->DB_USER, $this->DB_PASS);
            } catch (PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
            }

            return $this->conn;

        }

    }
?>