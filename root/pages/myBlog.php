<?php
    require_once('../config/config.php');
    require_once(DIR_BASE . 'config/db.php');
    require_once(DIR_BASE . 'objects/Blog.php');
    require_once(DIR_BASE . 'objects/User.php');

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }

    $db = new Database();
    $db = $db->getConnection();
    $user = new User($db);
    $blog = new Blog($db);

    $user->getUser($username);
    $blog->getBlog($user->getID());
?>

<?php include('../inc/header.php'); ?>

<!-- Banner -->
<div class="my-banner-container">
    <div class="banner-profile-picture">
    </div>
    <div class="my-banner-text">
        <h1><?php echo $blog->getName(); ?></h1>
        <p><?php echo $blog->getDesription(); ?></p>
    </div>
</div>

<!-- Main Container -->
<div class="blog-container">
    <!-- Post -->        
    <div class="my-blog-post">
        <div class="my-blog-post-picture-container"> </div>
        <div class="my-blog-post-details">
            <h1 class="my-blog-post-details">Post Title</h1>
            <p class="my-blog-post-details">Post summary goes here...</p>
            <div class="my-blog-post-bottom-container">
                <a class="btn btn-outline-primary">Read More</a>
            </div>
        </div>
    </div>

    <div class="my-blog-post">
        <div class="my-blog-post-picture-container"> </div>
        <div class="my-blog-post-details">
            <h1 class="my-blog-post-details">Post Title</h1>
            <p class="my-blog-post-details">Post summary goes here...</p>
            <div class="my-blog-post-bottom-container">
                <a class="btn btn-outline-primary">Read More</a>
            </div>
        </div>
    </div>
    
</div>

<?php include('../inc/footer.php'); ?>