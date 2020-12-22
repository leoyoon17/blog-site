<?php
    // Blog Object
    class Blog {
        private $conn;

        private $table_name = "blog";
        private $id;
        private $user_id;
        private $name;
        private $description;
        private $created_at;
        private $updated_at;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function create($name, $description, $user_id) {
            // Check if user has a blog already
            $searchQuery = "SELECT * FROM " . $this->table_name . "
                                WHERE user_id = :user_id";

            $stmt = $this->conn->prepare($searchQuery);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                $query = "INSERT INTO " . $this->table_name . "(name, description, user_id)
                        VALUES(:name, :description, :user_id)";

                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $result = $stmt->execute();

                if (!$result) {
                    echo "Failed to Create Blog: " . print_r($stmt->errorInfo());
                } else {
                    header("Location: " . ROOT_URL . '');
                }

            } else {
                // User already owns a blog
                echo "You already own a blog";
            }
        }

        
    }
?>