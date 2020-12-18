<?php
    require_once('../objects/User.php');
    require_once('../config/db.php');
    require_once('../config/config.php');

    $firstNameCheck = $lastNameCheck = $emailCheck = $passwordCheck = $passwordConfirmCheck = '';
    $passwordStrengthCheck = 'hidden';
    $passwordMatchCheck = 'hidden';
    $emailExists = False;
    
    if (isset($_POST['submit'])) {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['confirm_password'];

        $firstNameCheck = (!empty($firstName)) ? 'is-valid' : 'is-invalid';
        $lastNameCheck = (!empty($lastName)) ? 'is-valid' : 'is-invalid';
        $emailCheck = (!empty($email)) ? 'is-valid' : 'is-invalid';

        // Check if all fields are filled
        if ($firstNameCheck === $lastNameCheck &&
            $lastNameCheck === $emailCheck &&
            $emailCheck === 'is-valid') {

            // Check password strength
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);

            if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                // Insufficient password strength
                $passwordStrengthCheck = "visible";
                $passwordCheck = $passwordConfirmCheck = 'is-invalid';
                
            } else {
                // Check if passwords match
                if ($password === $passwordConfirm) {
                    $passwordCheck = $passwordConfirmCheck = 'is-valid';

                    // Run registration function
                    $db = new Database();
                    $db = $db->getConnection();
                    $user = new User($db, $firstName, $lastName, $email, $password);
                    $result = $user->create($email, $firstName, $lastName, $password);

                    if (!$result) {
                        // E-mail exists
                        $emailExists = True;
                        $emailCheck = 'is-invalid';
                    }

                } else {
                    $passwordMatchCheck = 'visible';
                    $passwordCheck = $passwordConfirmCheck = 'is-invalid';
                }
            }
        }
    }

?>

<?php include('../inc/header.php'); ?>
    <div class="container"> 
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ;?>" >
            <fieldset>
            <h1>Register</h1>
            <div class="form-group">
                <label>First Name</label>
                <input class="form-control <?php echo htmlspecialchars($firstNameCheck) ;?>" type="text" name="first_name" required="required" placeholder="First Name" value="<?php echo (isset($_POST['first_name'])) ? $_POST['first_name'] : "" ;?>">
                <label>Last Name</label>
                <input class="form-control <?php echo htmlspecialchars($lastNameCheck) ;?>" type="text" name="last_name" required="required" placeholder="Last Name" value="<?php echo (isset($_POST['last_name'])) ? $_POST['last_name'] : "" ;?>">
            </div>
            <div class="form-group">
                <label>E-mail</label>
                <input class="form-control <?php echo htmlspecialchars($emailCheck) ;?>" type="email" name="email" required="required" placeholder="E-mail" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : "" ;?>">
                <!-- Insert Warning for existing email address here -->
                <?php if ($emailExists) { include('../components/emailExistsWarning.php') ; } ?>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control <?php echo htmlspecialchars($passwordCheck) ;?>" type="password" name="password" required="required" placeholder="Password">
                <input class="form-control <?php echo htmlspecialchars($passwordConfirmCheck) ;?>" type="password" name="confirm_password" required="required" placeholder="Confirm Password">
            </div>

            <?php if ($passwordStrengthCheck == "visible") { include('../components/passwordStrengthWarning.php'); } else if ($passwordMatchCheck == "visible") { include('../components/passwordMatchWarning.php'); }?>
            

            <input class="btn btn-success" type="submit" value="Register" name="submit">
            <a class="btn btn-primary" type="button" value="Back" name="back" href="<?php echo ROOT_URL;?>"> Back </a>
            
            

            </fieldset>
        </form>
    </div>
<?php include('../inc/footer.php'); ?>