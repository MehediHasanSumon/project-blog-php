<?php
include('include/header.php');

if (authenticated()) {
  redirect('index.php', "You're already logged in...");
}
delete_token();
?>

<div class="container mt-4">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="login-form">
        <h2>Forget Password</h2>
        <div id="msg"></div>
        <form action="request/authentication.php" method="POST">
          <div class="form-group mb-2">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" />
          </div>
          <input type="submit" class="btn btn-outline-success" id='login' style="width: 100%" name="send_reset_mail" value="Send Reset Mail">
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include('include/footer.php');
?>