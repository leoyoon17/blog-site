<?php
    require_once(dirname(__FILE__) .'/config/config.php');
    require_once(DIR_BASE . 'config/db.php');
    require_once(DIR_BASE . 'objects/User.php');
    require_once(DIR_BASE . 'objects/Post.php');

?>

<?php include('inc/header.php'); ?>
    <div class='container'>
        <?php include('pages/displayPosts.php'); ?>
    </div>

<?php include('inc/footer.php'); ?>

        