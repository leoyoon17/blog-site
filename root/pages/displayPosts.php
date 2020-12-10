<?php
    require_once('inc/mysql_fix_string.php');
    require_once("config/db.php");
    require_once("objects/Posts.php");

    $db = new Database();
    $db = $db->getConnection();

    $post = new Post($db);

    $allPosts = $post->displayAll();
?>


<div class="container" style="padding-top:10px;">
    <h1 style="margin-top:10px; margin-bottom:10px;"> Posts </h1>
    <div class="card text-white bg-secondary mb-3" style="margin-bottom: 10px;">
    <?php foreach($allPosts as $row) : ;?>
        <div class="card-header"><?php echo $row['title'] ; ?></div>
            <div class="card-body">
            <h4 class="card-title"><?php echo $row['summary'] ;?></h4>
            <p class="card-text"><?php echo "Created on " . $row['created_at'] . " by " . $row['author'] ?></p>
            <a class="btn btn-default1" href="pages/post.php?id=<?php echo $row['id']; ?>"> Read More </a>
            </div>
            <br>
    <?php endforeach; ?>
</div>