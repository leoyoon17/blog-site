<?php
    require_once(dirname(__FILE__) .'/config/config.php');
    require_once(DIR_BASE . 'config/db.php');
    require_once(DIR_BASE . 'objects/User.php');
    require_once(DIR_BASE . 'objects/Post.php');

    // echo "DIR_BASE: " . DIR_BASE . "<br";
    // echo "dirname(): "  . dirname(__FILE__);
?>

<?php include('inc/header.php'); ?>
    <div class='container'>
        <?php include('pages/displayPosts.php'); ?>
    </div>

<?php include('inc/footer.php'); ?>

        