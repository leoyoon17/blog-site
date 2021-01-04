<!-- Post Component: Displays a single post summary/thumbnail
    Requires Post::displayAll() or Post::getUserPosts() to fetch posts -->
<?php
    $sqlTime = strtotime($row['created_at']);
    $date = date('Y-m-d', $sqlTime);

    // Check last element of current working directory for pathing
    $currDir = preg_split("#/#", getcwd());
    $readMorePath;

    switch ($currDir[count($currDir) - 1]) {
        case "pages":
            $readMorePath = "post.php?id=";
            break;
        
        case "root":
            $readMorePath = "pages/post.php?id=";
            break;
    }
    
?>
<div class="blog-container">
    <!-- Post -->        
    <div class="my-blog-post">
        <div class="my-blog-post-picture-container"> </div>
        <div class="my-blog-post-details">
            <h1 class="my-blog-post-details"><?php echo $row['title']; ?></h1>
            <p class="my-blog-post-details"><?php echo $row['summary']; ?></p>
            <div class="my-blog-post-bottom-container">
                <p class="card-text" style="float: left;"><?php echo $date . " by " . $user->getFirstName($row['user_id']) . " " . $user->getLastName($row['user_id']);?></p>
                <a class="btn btn-outline-primary" style="float: right;" href="<?php echo $readMorePath; ?><?php echo $row['id']; ?>">Read More</a>
                
            </div>
        </div>
    </div>
</div>