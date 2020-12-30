<?php
    require_once('../config/config.php');
    require_once(DIR_BASE . 'config/db.php');
    require_once(DIR_BASE . 'objects/Blog.php');
    require_once(DIR_BASE . 'objects/User.php');

    if (session_status() == PHP_SESSION_NONE) {
        session_start();

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }
    }

    $db = new Database();
    $db = $db->getConnection();
    $user = new User($db);
    $blog = new Blog($db);
?>

<?php include('../inc/header.php'); ?>

<!-- Banner -->
<div class="banner-container">
    <div class="banner-profile-picture">
    </div>
    <div class="banner-text">
        <h1>Test Title</h1>
        <p>Test description</p>
    </div>
</div>
<!-- Main Container -->
<div class="container">
    

</div>

<?php include('../inc/footer.php'); ?>