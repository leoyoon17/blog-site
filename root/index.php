<?php
    require_once('config/config.php');
    require_once(DIR_BASE . 'config/db.php');
    require_once(DIR_BASE . 'objects/User.php');
    require_once(DIR_BASE . 'objects/Post.php');
?>

<?php include('inc/header.php'); ?>
<!-- <?php include('inc/nav.php');?> -->
    <div class='container'>
        <?php include('pages/displayPosts.php'); ?>
    </div>

<?php include('inc/footer.php'); ?>

        