<?php
    require_once(dirname(__FILE__) .'/config/config.php');
    require_once(DIR_BASE . 'config/db.php');
    require_once(DIR_BASE . 'objects/User.php');
    require_once(DIR_BASE . 'objects/Post.php');

    $bannerTitle = "Welcome to Jae-yeon's Blog";
    $bannerDescription = "This blog was created for educational purposes";
?>

<?php include('inc/header.php'); ?>
    <?php include('components/banner.php'); ?>
    <?php include('pages/displayPosts.php'); ?>

<?php include('inc/footer.php'); ?>

        