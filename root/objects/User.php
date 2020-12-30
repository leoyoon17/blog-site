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

        }

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

        // Get user for Session use
        public function getUser($email) {
            $query = "SELECT
                    email, first_name, last_name, id
                    FROM " . $this->table_name . "
                    WHERE email = :email";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $result = $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->email = $row['email'];
            $this->firstName = $row['first_name'];
            $this->lastName = $row['last_name'];
            $this->id = $row['id'];
        }

        // Create New User (For DB)
        public function create($email, $firstName, $lastName, $pw) {
            // Check if email exists in DB
            $searchQuery = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
            $stmt = $this->conn->prepare($searchQuery);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            $searchResult = $stmt->execute();
            if ($stmt->rowCount() > 0) {
                // E-mail already registered.
                return False;

            } else {
                // Else, proceed with query
                $query = "INSERT INTO 
                        " . $this->table_name . "(email, first_name, last_name, password)
                        VALUES(:email, :firstName, :lastName, :password)
                        ";

                // Salt password
                $pw = password_hash($pw, PASSWORD_DEFAULT);

                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
                $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
                $stmt->bindParam(':password', $pw, PDO::PARAM_STR);

                $result = $stmt->execute();

                if (!$result) {
                    echo "Failed to insert into table: " . print_r($stmt->errorInfo());
                } else {
                    header("Location: " . ROOT_URL . '');
                }
            }
        }

        public function login($email, $pw) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $updateLoginState = "UPDATE " . $this->table_name . "
                                    SET login_status = 1
                                    WHERE email = :email";

            if ($user) {
                if(password_verify($pw, $user['password'])) {
                    $stmt = $this->conn->prepare($updateLoginState);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $result = $stmt->execute();
                    
                    // Valid Login, store email/username in session
                    session_start();
                    $_SESSION['username'] = $email;
                    $_SESSION['time'] = time();

                    if (!$result) {
                        echo "Failed to Login: " . print_r($stmt->errorInfo());
                    } else {
                        header("Location: " . ROOT_URL . '');
                    }

                } else {
                    // Invalid Password
                    return False;
                }
            } else {
                // Invalid Username
                return False;
            }
        }

        public function logout($email) {
            $query = "UPDATE " . $this->table_name . "
                        SET login_status = 0, last_login = CURRENT_TIMESTAMP
                        WHERE email = :email";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $result = $stmt->execute();

            if (!$result) {
                echo "Failed to Logout: " . print_r($stmt->errorInfo());
            } else {
                header("Location: " . ROOT_URL. '');
            }
        }

    }

?>