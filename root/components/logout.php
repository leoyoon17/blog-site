<?php

    require_once('../config/config.php');
    require_once('../config/db.php');
    require_once('../objects/User.php');

    $db = new Database();
    $db = $db->getConnection();
    $user = new User($db);

    // TODO: set last login for user
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $email = $_SESSION['username'];
    echo $email;
    $user->logout($email);

    if (isset($_SESSION['username'])) {
        unset($_SESSION['username']);
    }
?>