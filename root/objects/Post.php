<?php

    // Posts Object
    class Post {
        private $conn;
        private $table_name = "post";

        public $id;
        public $userID;
        public $blogID;
        public $title;
        public $summary;
        public $content;
        public $created_at;
        public $updated_at;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read() {
            $query = "SELECT
                        title, summary, content, created_at, updated_at
                        FROM
                            " . $this->table_name ."
                     ORDER BY created_at";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        // Returns all information on ONE post to be displayed.
        public function getPost($id) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id= " . $id;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->userID = $rows['user_id'];
            $this->blogID = $rows['blog_id'];
            $this->title = $rows['title'];
            $this->summary = $rows['summary'];
            $this->content = $rows['content'];
            $this->created_at = $rows['created_at'];
            $this->updated_at = $rows['updated_at'];
        }

        // Returns all posts made by a specific user.
        public function getUserPosts($userID) {
            $query = "SELECT * FROM " . $this->table_name . "
                        WHERE user_id = :user_id ORDER BY created_at DESC";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchALL(PDO::FETCH_ASSOC);

            return $rows;
        }

        // Returns all the posts
        public function displayAll() {
            $query = "SELECT
                        *
                        FROM
                            " . $this->table_name . "
                     ORDER BY created_at DESC";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $rows;
        }

        // Add new Post
        public function create($title, $summary, $content, $userID, $blogID) {
            $query = "INSERT INTO
                        " . $this->table_name . "( title, summary, content, user_id, blog_id)
                        VALUES(:title, :summary, :content, :user_id, :blog_id)
                        ";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':summary', $summary, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
            $stmt->bindParam(':blog_id', $blogID, PDO::PARAM_INT);
            $result = $stmt->execute();

            if (!$result) {
                echo "Failed to insert into table: " . print_r($stmt->errorInfo());
            } else {
                header("Location: " . ROOT_URL . '');
            }

        }

        // Edit Post
        public function editPost($id, $content, $title, $summary) {

            $this->content = $content;
            $this->title = $title;
            $this->summary = $summary;
            $this->id = intval($id);

            $query = "UPDATE " . $this->table_name . "
                        SET content = :content, title = :title, summary = :summary, updated_at = CURRENT_TIMESTAMP
                        WHERE id = :id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':content', $this->content, PDO::PARAM_STR);
            $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindParam(':summary', $this->summary, PDO::PARAM_STR);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $result = $stmt->execute();

            if (!$result) {
                echo "Failed to update row: " . print_r($stmt->errorInfo());
            } else {
                header("Location: " . ROOT_URL . '');
            }
        }

        // Delete Post
        public function deletePost($id) {
            $this->id = $id;

            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $result = $stmt->execute();

            if (!$result) {
                echo "Failed to delete row: " . print_r($stmt->errorInfo());
            } else {
                header("Location: " . ROOT_URL . '');
            }
        }
  
    }
?>