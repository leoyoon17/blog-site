<?php
    // require_once("../config/config.php");

    // Posts Object
    class Post {
        private $conn;
        private $table_name = "posts";

        public $id;
        public $author;
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
                        author, title, summary, content, created_at, updated_at
                        FROM
                            " . $this->table_name ."
                     ORDER BY created_at";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function getPost($id) {
            $query = "SELECT * FROM posts WHERE id= " . $id;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->author = $rows['author'];
            $this->title = $rows['title'];
            $this->summary = $rows['summary'];
            $this->content = $rows['content'];
            $this->created_at = $rows['created_at'];
            $this->updated_at = $rows['updated_at'];
        }

        // Returns all the posts
        public function displayAll() {
            $query = "SELECT
                        author, title, summary, created_at, id
                        FROM
                            " . $this->table_name . "
                     ORDER BY created_at DESC";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $rows;
        }

        // Add new Post
        public function addPost($author, $title, $summary, $content) {
            $query = "INSERT INTO
                        posts(author, title, summary, content)
                        VALUES(:author, :title, :summary, :content)
                        ";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':summary', $summary, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $result = $stmt->execute();

            if (!$result) {
                echo "Failed to insert into table: " . mysqli_error($this->conn);
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
            var_dump($this->id);

            $query = "UPDATE posts
                        SET content = :content, title = :title, summary = :summary, updated_at = CURRENT_TIMESTAMP
                        WHERE id = :id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':content', $this->content, PDO::PARAM_STR);
            $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindParam(':summary', $this->summary, PDO::PARAM_STR);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $result = $stmt->execute();

            if (!$result) {
                echo "Failed to update row: " . mysqli_error($this->conn);
            } else {
                header("Location: " . ROOT_URL . '');
            }

        }

        // Delete Post
        public function deletePost($id) {

        }

        
    }
?>