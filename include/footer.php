<?php
$user = authenticated();
?>
<footer class="bg-dark text-light pt-5 mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>About Us</h5>
                <p>A brief description of your blog and what it offers.</p>
            </div>
            <div class="col-md-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <?php
                    if ($user) {
                        echo '<li><a href="profile.php">Profile</a></li>
                    <li><a href="new-post.php">New Post</a></li>
                    <li><a href="change-password.php">Change Password</a></li>
                    <li><a href="logout.php">Logout (' . $_SESSION['user_name'] . ')</a></li>';
                    } else {
                        echo '<li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Registration</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Follow Us</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                </ul>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12 text-center">
                <p>&copy; 2024 Sumon. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script src="js/all.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/prism.min.js"></script>
<script src="js/prism-c.min.js"></script>
<script src="js/highlight.min.js"></script>
<script src="js/app.js"></script>
<script>
    hljs.highlightAll();
</script>
</body>

</html>