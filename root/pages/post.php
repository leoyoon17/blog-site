<?php
    require_once('../config/config.php');
    require_once('../config/db.php');
    require_once("../objects/Posts.php");

    $db = new Database();
    $db = $db->getConnection();

    $post = new Post($db);
    $post->getPost($_GET['id']);
?>

<?php include('../inc/header.php');?>
    <div class="post-container">
        <div class="article-container">
            <div class="article">
                <div class="article-title"> 
                    <h2><?php echo $post->title; ?></h2>
                    
                </div>
                
                <div class="article-info"> 
                    <span class="article-info-publish-date"><?php if ($post->updated_at == NULL) {
                         echo "Published On " . $post->created_at; 
                        } else { 
                            echo "Last updated on " . $post->updated_at; }
                         ?></span>
                    <span class="article-info-author">By <?php echo $post->author;?></span>
                </div>

                <div class="article-body">
                    <p> <?php echo $post->content?> </p>
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