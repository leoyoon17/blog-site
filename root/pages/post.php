<?php
    require('../config/config.php');
    require('../config/db.php');
    require('../inc/mysql_fix_string.php');

    $id = mysql_entities_fix_string($conn, $_GET['id']);

    $query = "SELECT * FROM posts WHERE id=" . $id;

    $result = mysqli_query($conn,$query);

    $post = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
?>

<?php include('../inc/header.php');?>
    <div class="post-container">
        <div class="article-container">
            <div class="article">
                <div class="article-title"> 
                    <h2><?php echo $post['title']; ?></h2>
                    <!-- <h2>This is a test article title to show what the title is going to look like!</h2> -->
                </div>
                
                <div class="article-info"> 
                    <span class="article-info-publish-date"><?php if ($post['updated_at'] == NULL) {
                         echo "Published On " . $post['created_at']; 
                        } else { 
                            echo "Last updated on " . $post['updated_at']; }
                         ?></span>
                    <span class="article-info-author">By <?php echo $post['author'];?></span>
                    <!-- <span class="article-info-author-image"><img src="../images/stock-user-profile.png"></span> -->
                </div>

                <div class="article-body">
                    <p> <?php echo $post['content']?> </p>
                </div>
            </div>            
        </div>

        <div class="side-bar-container">
            <div class="side-bar"> 
                <img class="user-image" src="../images/stock-user-profile.png"> 
                <div class="user-bio">
                    <!-- TODO: Replace with real user Bio -->
                    <p> This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. 
                    This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. 
                    This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. This is user Bio. 
                    </p>
                </div>

            </div>
        </div>
    </div>
<?php include('../inc/footer.php');?>