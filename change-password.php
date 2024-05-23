<?php
include('include/header.php');

if (!authenticated()) {
    redirect('login.php', "Please login first.");
}
$user_id = $_SESSION['user_id'];
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="login-form">
                <h2>Change Password</h2>
                <div id="msg"></div>
                <form action="request/authentication.php" method="POST">
                    <div class="form-group mb-2">
                        <label for="current-password">Current Password</label>
                        <input type="password" class="form-control" id="current-password" name="current_password" placeholder="Password" />
                    </div>
                    <div class="form-group mb-2">
                        <label for="new-password">New Password</label>
                        <input type="password" class="form-control" id="new-password" name="new_password" placeholder="Password" />
                    </div>
                    <div class="form-group mb-2">
                        <label for="password3">Re-type New Password</label>
                        <input type="password" class="form-control" id="password3" name="password3" placeholder="Re-type Password" />
                    </div>
                    <input type="hidden" name="user_id" value="<?= $user_id ?>" />
                    <input type="submit" id="login" name="change_password" class="btn btn-outline-success" style="width: 100%" value="Change Password">

                </form>
            </div>
        </div>
    </div>
</div>

<?php
include('include/footer.php');
?>