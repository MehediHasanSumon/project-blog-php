<?php
$user = authenticated();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <h2>Sumon</h2>
        </a>
        <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            <?php
            if ($user) {
                echo '<a class="nav-link" href="profile.php">Profile</a>
                      <a class="nav-link" href="new-post.php">New Post</a>
                      <a class="nav-link" href="logout.php">Logout</a>';
            } else {
                echo '<a class="nav-link" href="login.php">Login</a>
                      <a class="nav-link" href="signup.php">Registration</a>';
            }
            ?>
        </div>
    </div>
</nav>