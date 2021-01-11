<!-- Post Component: Displays a single post summary/thumbnail
    Requires Post::displayAll() or Post::getUserPosts() to fetch posts

    Note: $currDir may cause development issues on windows machines, as directories
            on windows devices use backslashes in directories instead of
            forward slashes -->
<?php
    // TODO: Fix directories issue with development on windows devices
    // Check last element of current working directory for pathing

    // require_once("config/config.php");
    // require_once(DIR_BASE . "config/db.php");
    // require_once(DIR_BASE . "objects/Post.php");
    // require_once(DIR_BASE . "objects/User.php");

    $currDir = preg_split("#/#", getcwd()); // For non-windows based OS
    
    var_dump($currDir);
    $readMorePath;
    var_dump($currDir[count($currDir) - 1]);
    switch ($currDir[count($currDir) - 1]) {
        case "pages":
            require_once("../config/config.php");
            require_once(DIR_BASE . "config/db.php");
            require_once(DIR_BASE . "objects/Post.php");
            require_once(DIR_BASE . "objects/User.php");

            $readMorePath = "post.php?id=";
            break;
        
        case "root":
            require_once("config/config.php");
            require_once("config/db.php");
            require_once("objects/Post.php");
            require_once("objects/User.php");

            $readMorePath = "pages/post.php?id=";
            break;
    }


    $db = new Database();
    $db = $db->getConnection();
    
    $user = new User($db);
    $post = new Post($db);

    $sqlTime = strtotime($row['created_at']);
    $date = date('Y-m-d', $sqlTime);

    $userID = $row['user_id'];
    $user->getUserViaID($userID);
    
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