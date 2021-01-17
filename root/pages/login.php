<?php 
    require_once('../config/config.php');
    require_once('../config/db.php');
    require_once('../objects/User.php');
    require_once('../objects/Post.php');

    $invalidEntry = False;
    if (!isset($_SESSION['username'])) {
        if (isset($_POST['submit'])) {

            $db = new Database();
            $db = $db->getConnection();
            $user = new User($db);

            $email = $_POST['email'];
            $pw = $_POST['password'];

            $result = $user->login($email,$pw);
            
            // Handle invalid entry
            if (!$result) {
                $invalidEntry = True;
            }
        }
    }
    
?>

<?php include('../inc/header.php'); ?>

    <?php include('../components/loginCard.php'); ?>

<?php include('../inc/footer.php'); ?>
