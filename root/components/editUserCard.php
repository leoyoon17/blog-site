<?php

    // Make sure to check that session is running
    // and $_SESSION['username'] matches with
    // the username of the current user
    $db = new Database();
    $db = $db->getConnection();

    $user = new User($db);
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $isUser = False;

    if (isset($_SESSION['username'])) {
        if (isset($_GET['id'])) {
            $userID = $_GET['id'];
        }

        $user->getUserViaID($userID);
        $email = $user->getEmail();

        $username = $_SESSION['username'];

        $email = strtolower($email);
        $username = strtolower($username);

        if ($email == $username) {
            $isUser = True;

            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();
            $bio = $user->getBio();
            
            if (isset($_POST['submit'])) {
                $id = $user->getID();
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $bio = $_POST['bio'];
                $pw = $_POST['password'];

                $user->update($id, $firstName, $lastName, $pw, $bio);
                
            }

        }
    }
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<div class="edit-user-container">
    <div class="edit-user-body">
        <div class="edit-user-header">
            <h1>Edit User</h1>
        </div>
        
        <div class="edit-user-name">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" value="<?php echo $firstName; ?>" class="form-control" required="required" name="firstName" placeholder="First Name">
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input type="text" value="<?php echo $lastName; ?>" class="form-control" required="required" name="lastName" placeholder="last Name">
            </div>
        </div>

        <div class="edit-user-password">
            <div class="form-group">
                <label>Password</label>
                <input type="password"  class="form-control" required="required" name="password" placeholder="Password">

                <label>Confirm Password</label>
                <input type="password" class="form-control" required="required" name="confirmPassword" placeholder="Confirm Password">
            </div>
        </div>

        <div class="edit-user-bio">
            <div class="form-group">
                <label>Bio</label>
                <textarea class="form-control" rows="5" name="bio"><?php echo $bio; ?></textarea>
            </div>
        </div>

        <div class="login-buttons">
            <input class="login-button btn btn-success" type="submit" value="Edit" name="submit">
            <a class="login-button btn btn-primary" type="button" name="back" href="<?php echo ROOT_URL;?>">Back</a>
        </div>

    </div>

</div>
</form>





