<?php 
    // User Object
    class User {
        private $conn;
        private $table_name = "user";

        private $firstName;
        private $lastName;
        private $email;
        private $username;
        private $pw;
        private $age;

        // For the Constructor, you only need the DB unless you want to add other information
        function __construct($db, $firstName = NULL, $lastName = NULL, $email = NULL, $pw = NULL) {
            $this->conn = $db;

            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->username = $email; // Username and email are the same thing for now.

            // TODO: finish constructor?
        }

        // TODO: Getters and Setters
        public function getFirstName() {    return $this->firstName;    }
        public function getLastName() {     return $this->lastName;     }
        public function getUsername() {     return $this->user;         }
        public function getAge() {          return $this->age;          }
        public function getEmail() {        return $this->email;        }
        public function getPW() {           return $this->pw;           }

        public function setFirstName($firstName) {  $this->firstName = $firstName;  }
        public function setLastName($lastName) {    $this->lastName = $lastName;    }
        public function setusername($username) {    $this->username = $username;    }
        public function setAge($age) {              $this->age = $age;              }
        public function setEmail($email) {          $this->email = $email;          }
        public function setPW($pw) {                $this->pw = $pw;                }

        // Create New User (For DB)
        public function registerUser($email, $firstName, $lastName, $pw) {
            
        }




    }

?>