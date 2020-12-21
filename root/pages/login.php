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

<?php include('../inc/header.php') ;?>

<form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ;?>"> 
    <div class="container">
        <h1>Login</h1>
        <div class="form-group">
            <label>E-mail</label>
            <input class="form-control" type="email" name="email" required="required" placeholder="E-mail" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : "" ;?>">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" required="required" placeholder="Password">
            <?php if ($invalidEntry) { include('../components/invalidLoginCredentials.php'); }?>
        </div>

        <input class="btn btn-success" type="submit" value="Login" name="submit">
        <a class="btn btn-primary" type="button" name="back" href="<?php echo ROOT_URL;?>"> Back </a>

    </div>
</form>

<?php include('../inc/footer.php') ;?>
