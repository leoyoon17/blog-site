<?php
    // TODO:If session's username and $_GET's username are equal,
    // allow edits.
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }

    $db = new Database();
    $db = $db->getConnection();

    $user = new User($db);
    $blog = new Blog($db);

    $user->getUserViaID($_GET['id']);
    $blog->getBlog($_GET['id']);

    $blogName = $blog->getName();
    $firstName = $user->getFirstName();
    $lastName = $user->getLastName();
    $email = $user->getEmail();
    $created_at = $user->getCreatedAt();

    $sqlTime = strtotime($created_at);
    $created_at = date('Y-m-d', $sqlTime);
?>

<div class="user-page-container">
    <div class="user-page-body">
        <div class="user-page-left">
            <div class="user-page-profile-image-container">
                <img id="user-profile-picture" src="../images/stock-user-profile.png">
            </div>

            <div class="user-details">
                <p class="user-email"><?php echo $email; ?></p>
                <p>Joined On <?php echo $created_at;?></p>
                
            </div>

        </div>

        <div class="user-page-right">
            <div class="user-page-name">
                <h1><?php echo $firstName; ?> <?php echo $lastName;?></h1>
                <p><?php echo $blogName; ?></p>
            </div>


        </div>
    </div>
</div>