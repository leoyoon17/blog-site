<?php
    require('inc/mysql_fix_string.php');

    $query = "SELECT * FROM posts ORDER BY created_at DESC";

    $result = mysqli_query($conn, $query);

    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    function get_post($conn, $var) {
        return $conn->real_escape_string($_POST[$var]);
    }

    
    function delete_post($conn, $var) {
        
        if (isset($_POST['delete']) && isset($_POST['submit'])) {
            $var = mysql_fix_string($conn, $var);
            
            $query = "DELETE FROM posts WHERE id='" . $var . "'";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo "DELETE Failed";
            } else {
                echo var_dump($var);
                // header("Refresh:0");
            }
        }
    }

    mysqli_free_result($result);
?>


<div class="container" style="padding-top: 10px">
    <h1> Posts </h1>
    <div class="card bg-light mb-3">
    <?php foreach($posts as $post) : ; ?>
            <div class="card-header">
            <h3><?php echo $post['title']; ?> </h3>
            </div>
            <div class="card-body">
            <p><?php echo $post['summary'];?></p>
            <p class="card-text" style="font-size: 85%"> Created on <?php echo $post['created_at']; ?> by <?php echo ($post['author'] == '') ? "Anonymous" : $post['author'];?> </p>
            <br>

            <a class="btn btn-default" href="pages/post.php?id=<?php echo $post['id']; ?>"> Read More </a>

            <!-- <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <input type="hidden" name="delete" value="yes">
            <input type="hidden" name="id" value="<?php delete_post($conn,$post['id']); ?>">
            <input type="submit" name="submit" class="btn btn-danger" style="margin-top:10px" value="Delete Post <?php echo $post['id']; ?>">
            </form> -->

            </div>
    <?php endforeach; ?>
    </div>
</div>