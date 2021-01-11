<form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ;?>"> 

<div class="login-container">
    <div class="login-box">
        <div class="login-header">
            <h1>Login</h1>
        </div>

        <div class="login-body">
            <div class="login-email">
                <div class="form-group">
                    <label>E-mail</label>
                    <input class="form-control" type="email" name="email" required="required" placeholder="E-mail" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : "" ;?>">
                </div>
            </div>

            <div class="login-password">
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password" required="required" placeholder="Password">
                    <?php if ($invalidEntry) { include('../components/invalidLoginCredentials.php'); }?>
                </div>
            </div>

            <div class="login-buttons">
                <input class="login-button btn btn-success" type="submit" value="Login" name="submit">
                <a class="login-button btn btn-primary" type="button" name="back" href="<?php echo ROOT_URL;?>"> Back </a>
            </div>

            <div class="login-signup">
                <a class="login-signup btn btn-link" href="<?php echo ROOT_URL?>pages/registerUser.php">Sign Up</a>
            </div>
        </div>
    </div>
</div>

</form>