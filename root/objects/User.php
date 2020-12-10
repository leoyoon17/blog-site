<?php 
    // User Object
    class User {
        private $firstName = NULL;
        private $lastName = NULL;
        private $email = NULL;
        private $username = NULL;
        private $pw = NULL;
        private $age = NULL;

        function __construct($firstName = NULL, $lastName = NULL, $email = NULL) {
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            // TODO: finish constructor
        }

        // TODO: Getters and Setters
        public function getFirstName() {    return $this->firstName;    }
        public function getLastName() {     return $this->lastName;     }
        public function getUsername() {     return $this->user;         }
        public function getAge() {          return $this->age;          }
        public function getEmail() {        return $this->email;        }

        public function setFirstName($firstName) {  $this->firstName = $firstName;  }
        public function setLastName($lastName) {    $this->lastName = $lastName;    }
        public function setusername($username) {    $this->username = $username;    }
        public function setAge($age) {              $this->age = $age;              }
        public function setEmail($email) {          $this->email = $email;          }

    }

?>