<?php
    require_once('inc/mysql_fix_string.php');
    require_once("config/db.php");
    require_once("objects/Post.php");
    require_once("objects/User.php");


    $db = new Database();
    $db = $db->getConnection();

    $user = new User($db);
    $post = new Post($db);

    $allPosts = $post->displayAll();
?>


<?php foreach($allPosts as $row) : ;?>
    <?php include('components/blogPost.php'); ?>
<?php endforeach; ?>
