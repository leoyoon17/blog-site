<?php 
    // require_once('config/config.php');
    require_once(DIR_BASE . 'config/db.php');
    require_once(DIR_BASE . 'objects/User.php');
    require_once(DIR_BASE . 'objects/Post.php');
    require_once(DIR_BASE . 'objects/Blog.php');

    $db = new Database();
    $db = $db->getConnection();
    $user = new User($db);
    $blog = new Blog($db);

    if (session_status() == PHP_SESSION_NONE) {
        session_start();

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $user->getUser($_SESSION['username']);
            $firstName = $user->getFirstName();
            $getBlogResult = $blog->getBlog($user->id);
        }
    }

?>

<!DOCTYPE html>

<html>
    <head>
        <title> JYY Blog </title>
        <link rel='stylesheet' href='css/bootstrap.min.css'>
        <link rel='stylesheet' href='../css/bootstrap.min.css'>
        <link rel='stylesheet' href='css/style.css'>
        <link rel='stylesheet' href='../css/style.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Bad Script'>
    </head>
    <body>
        <?php if (!@include('inc/nav.php')) {   include('../inc/nav.php');  }   ?>