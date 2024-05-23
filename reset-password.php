<?php
include('include/header.php');

if (authenticated()) {
    redirect('index.php', "You're already logged in...");
}
delete_token();
$token = $_GET['token'];
$password_token = get_single_data_array('password_reset_token', 'token', $token);
validate_has_data($password_token, 'forget-password.php', 'Your token has been expired.');
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="login-form">
                <h2>Confirm Password</h2>
                <div id="msg"></div>
                <form action="request/authentication.php" method="POST">
                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" />
                    </div>
                    <div class="form-group mb-2">
                        <label for="password2">Re-type Password</label>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Re-type password" />
                    </div>
                    <input type="hidden" name="email" value="<?= $password_token['email'] ?>">
                    <input type="submit" class="btn btn-outline-success" id='login' style="width: 100%" name="confirm_password" value="Confirm Password">
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include('include/footer.php');
?>