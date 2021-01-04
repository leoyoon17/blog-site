<?php
    require_once('../config/config.php');
    require_once(DIR_BASE . 'config/db.php');
    require_once(DIR_BASE . 'objects/Blog.php');
    require_once(DIR_BASE . 'objects/Post.php');
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
    $post = new Post($db);

    $user->getUser($username);
    $blog->getBlog($user->getID());
    $userPosts = $post->getUserPosts($user->getID());
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

<?php foreach ($userPosts as $row) :?>
        <?php include('../components/blogPost.php');?>
<?php endforeach;?>

<?php include('../inc/footer.php'); ?>