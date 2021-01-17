<div class="register-container">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ;?>" >
        <div class="register-box">
            <div class="register-header">
                <h1>Register</h1>
            </div>

            <div class="register-body">
                <div class="register-email">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control <?php echo htmlspecialchars($emailCheck) ;?>" type="email" name="email" required="required" placeholder="E-mail" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : "" ;?>">
                        <!-- Insert Warning for existing email address here -->
                        <?php if ($emailExists) { include('../components/emailExistsWarning.php') ; } ?>
                    </div>
                </div>

                <div class="register-name">
                    <div class="form-group">
                        <label>First Name</label>
                        <input class="form-control <?php echo htmlspecialchars($firstNameCheck) ;?>" type="text" name="first_name" required="required" placeholder="First Name" value="<?php echo (isset($_POST['first_name'])) ? $_POST['first_name'] : "" ;?>">
                        <label>Last Name</label>
                        <input class="form-control <?php echo htmlspecialchars($lastNameCheck) ;?>" type="text" name="last_name" required="required" placeholder="Last Name" value="<?php echo (isset($_POST['last_name'])) ? $_POST['last_name'] : "" ;?>">
                    </div>
                </div>

                <div class="register-password">
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control <?php echo htmlspecialchars($passwordCheck) ;?>" type="password" name="password" required="required" placeholder="Password">
                        <input class="form-control <?php echo htmlspecialchars($passwordConfirmCheck) ;?>" type="password" name="confirm_password" required="required" placeholder="Confirm Password">
                    </div>
                </div>

                <div class="register-confirm-password">
                </div>

                <?php if ($passwordStrengthCheck == "visible") { include('../components/passwordStrengthWarning.php'); } else if ($passwordMatchCheck == "visible") { include('../components/passwordMatchWarning.php'); }?>

                <div class="register-buttons">
                    <input class="register-buttons btn btn-success" type="submit" value="Register" name="submit">
                    <a class="register-buttons btn btn-primary" type="button" value="Back" name="back" href="<?php echo ROOT_URL;?>"> Back </a>
                
                </div>

                <div class="register-to-login">
                    <p class="register-to-login">Already have an account?</p>
                    <a class="register-to-login btn btn-link" href="<?php echo ROOT_URL?>pages/login.php">Sign in</a>
                </div>
            
            </div>
        </div>
    </form>
</div>