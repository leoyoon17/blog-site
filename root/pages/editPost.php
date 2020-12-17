<?php 
    require_once('../config/config.php');
    require_once('../config/db.php');
    require_once('../objects/Posts.php');

    $db = new Database();
    $db = $db->getConnection();
    
    $post = new Post($db);
    if (isset($_GET['id'])) {
        $id_0 = $_GET['id'];
        $post->getPost($_GET['id']);
        // echo $post->id;
    } else {
        // echo "id not set";
    }

    $titleCheck = $authorCheck = $summaryCheck = $contentCheck = '';

    if (isset($_POST['submit'])) {
        // Check for posted data
        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $content = $_POST['content'];
        $id = $_POST['id_0'];

        $titleCheck = (!empty($title)) ? 'is-valid' : 'is-invalid';
        $summaryCheck = (!empty($summary)) ? 'is-valid' : 'is-invalid';
        $contentCheck = (!empty($content)) ? 'is-valid' : 'is-invalid';

        // If all forms are filled, then continue with the query
        if ($titleCheck === $summaryCheck &&
            $summaryCheck === $contentCheck &&
            $contentCheck === 'is-valid') {

                // Edit Post
                $post->editPost($id, $content, $title, $summary);

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

    else if (isset($_POST['delete'])) {
        // TODO: Delete Confirmation Modal
        $id = $_POST['id_0'];
        $post->deletePost($id);
    }
?>


<?php include('../inc/header.php'); ?>

<div class="container">
    <h1>Edit Post</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <fieldset>
        <div class="form-group">
            <label>Title</label>
            <input type="text" value="<?php echo $post->title; ?>" class="form-control <?php echo htmlspecialchars($titleCheck); ?>" required="required" name="title"  placeholder="Title">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Summary</label>
            <input type="text" value="<?php echo $post->summary; ?>" class="form-control <?php echo htmlspecialchars($summaryCheck); ?>" required="required" name="summary" placeholder="Summary">
        </div>
        <div class="form-group">
            <label for="exampleTextarea">Body</label>
            <textarea class="form-control <?php echo htmlspecialchars($contentCheck); ?>" rows="5" required="required" style="margin-top: 0px; margin-bottom: 0px; height: 142px;" name="content"><?php echo $post->content; ?></textarea>
        </div>
        <input class="btn btn-success" type="submit" value="Save" name="submit">
        <input class="btn btn-danger" type="submit" value="Delete" name="delete">
        <input type="hidden" value="<?php echo $id_0; ?>" name="id_0">
        </fieldset>
    </form>
</div>

<?php include('../inc/footer.php'); ?> 