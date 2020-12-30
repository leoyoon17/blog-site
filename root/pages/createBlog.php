<?php
    require_once('../config/config.php');
    require_once(DIR_BASE . 'config/db.php');
    require_once(DIR_BASE . 'objects/Blog.php');
    require_once(DIR_BASE . 'objects/User.php');

    if (session_status() == PHP_SESSION_NONE) {
        session_start();

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];

        }

    } else {
        // TODO: Session expired
    }

    $db = new Database();
    $db = $db->getConnection();
    $user = new User($db);
    $blog = new Blog($db);

    $titleCheck = $descriptionCheck = '';

    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];

        $titleCheck = (!empty($title)) ? 'is-valid' : 'is-invalid';
        $descriptionCheck = (!empty($description)) ? 'is-valid' : 'is-invalid';

        if ($titleCheck === $descriptionCheck &&
            $descriptionCheck === 'is-valid') {
                
                $user->getUser($username);
                $blog->create($title, $description, $user->id);
                
        }
    }

?>

<?php include('../inc/header.php'); ?>

<div class="container">
    <h1>Create Blog</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <fieldset>
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control <?php echo htmlspecialchars($titleCheck); ?>" required="required" name="title"  placeholder="Title">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control <?php echo htmlspecialchars($descriptionCheck); ?>" rows="3" required="required" style="margin-top: 0px; margin-bottom: 0px; height: 142px;" name="description"></textarea>
            </div>
            <input class="btn btn-success" type="submit" value="Post" name="submit">
        </fieldset>
    </form>
</div>

<?php include('../inc/footer.php'); ?>