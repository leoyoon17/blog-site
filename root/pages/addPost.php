<?php
    require_once('../config/config.php');
    require_once(DIR_BASE . 'config/db.php');
    require_once(DIR_BASE . 'inc/mysql_fix_string.php');
    require_once(DIR_BASE . 'objects/User.php');
    require_once(DIR_BASE . 'objects/Blog.php');
    require_once(DIR_BASE . 'objects/Post.php');
    

    $db = new Database();
    $db = $db->getConnection();
    $user = new User($db);
    $blog = new Blog($db);
    $post = new Post($db);

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if user is logged in (User can only add a new post if they are logged in)
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $user->getUser($username);
        $blog->getBlog($user->getID());

        $blogID = $blog->getID();
        $userID = $user->getID();

        $titleCheck = $summaryCheck = $contentCheck = '';
    
        if (isset($_POST['submit'])) {
            // Check for posted data
            $title = $_POST['title'];
            $summary = $_POST['summary'];
            $content = $_POST['content'];

            $titleCheck = (!empty($title)) ? 'is-valid' : 'is-invalid';
            $summaryCheck = (!empty($summary)) ? 'is-valid' : 'is-invalid';
            $contentCheck = (!empty($content)) ? 'is-valid' : 'is-invalid';

            // If all forms are filled, then continue with the query
            if ($titleCheck === $summaryCheck &&
                $summaryCheck === $contentCheck &&
                $contentCheck === 'is-valid') {

                    $post->create($title, $summary, $content, $userID, $blogID);

            } else {

                echo <<<_END
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4 class="alert-heading">Warning!</h4>
                    <p class="mb-0">Please fill in all fields</p>
                </div>
                _END;
            }
        }
            
        } else {
            echo "Not logged in.";
            // TODO: User is not logged in.
        }

?>
<?php include('../inc/header.php'); ?>

<div class="container">
    <h1>Add Post</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <fieldset>
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control <?php echo htmlspecialchars($titleCheck); ?>" required="required" name="title"  placeholder="Title">
            </div>
            <div class="form-group">
                <label>Summary</label>
                <input type="text" class="form-control <?php echo htmlspecialchars($summaryCheck); ?>" required="required" name="summary" placeholder="Summary">
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea class="form-control <?php echo htmlspecialchars($contentCheck); ?>" rows="3" required="required" style="margin-top: 0px; margin-bottom: 0px; height: 142px;" name="content"></textarea>
            </div>
            <input class="btn btn-success" type="submit" value="Post" name="submit">
        </fieldset>
    </form>
</div>

<?php include('../inc/footer.php'); ?>