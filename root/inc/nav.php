
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top" style="background-color: #041e41; color: #ffcd00;">
  <a class="navbar-brand" href="<?php echo ROOT_URL;?>">JYY Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo ROOT_URL;?>">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo ROOT_URL?>pages/addPost.php">Add Post</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
        <?php if (!isset($_SESSION['username'])) {; ?>
            <ul class="navbar-nav mr-auto" style="padding-right: 10px;">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ROOT_URL?>pages/registerUser.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ROOT_URL?>pages/login.php">Login</a>
                </li>
            </ul>
        <?php } else {; ?>
            <ul class="navbar-nav mr-auto" style="padding-right: 10px;">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ROOT_URL?>pages/userPage.php"><?php echo $firstName; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ROOT_URL?>components/logout.php">Logout</a>
                </li>
                <!-- If user has a blog already, provide a link to their blog page, otherwise, display, "Create Blog" -->
                <?php if (!$getBlogResult) { ;?>
                  <li class="nav-item">
                      <a class="nav-link" href="<?php echo ROOT_URL?>pages/createBlog.php">Create Blog</a>
                  </li>
                <?php } else { ;?>
                  <li class="nav-item">
                      <a class="nav-link" href="<?php echo ROOT_URL?>pages/myBlog.php">My Blog</a>
                  </li>

                <?php } ;?>
            </ul>
        <?php }; ?>



        <input class="form-control mr-sm-2" type="text" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>

    </form>
  </div>
</nav>