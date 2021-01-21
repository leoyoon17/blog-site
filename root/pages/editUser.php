<?php
    // Make sure to check that session is running
    // and $_SESSION['username'] matches with
    // the username of the current user

    require_once('../config/config.php');
    require_once(DIR_BASE . 'config/db.php');
    require_once(DIR_BASE . 'objects/User.php');
    require_once(DIR_BASE . 'objects/Blog.php');

?>

<?php include('../inc/header.php'); ?>

    <?php include('../components/editUserCard.php'); ?>

<?php include('../inc/footer.php'); ?>