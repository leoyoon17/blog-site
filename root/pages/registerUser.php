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

    <?php include('../components/registerUserCard.php'); ?>

<?php include('../inc/footer.php'); ?>