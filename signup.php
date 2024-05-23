<?php
include('include/header.php');

if (authenticated()) {
  redirect('index.php', "You're already logged in...");
}
?>

<div class="container mt-4">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="login-form">
        <h2>Registration</h2>
        <div id="msg"></div>
        <form action="request/authentication.php" method="POST">
          <div class="form-group mb-2">
            <label for="email">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" />
          </div>
          <div class="form-group mb-2">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" />
          </div>
          <div class="form-group mb-2">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
          </div>
          <div class="form-group mb-2">
            <label for="password">Re-type Password</label>
            <input type="password" class="form-control" id="password2" placeholder="Re-type Password" />
          </div>
          <input type="submit" id="login" name="registrationBtn" class="btn btn-outline-success" style="width: 100%" value="Registration">

        </form>
      </div>
    </div>
  </div>
</div>

<?php
include('include/footer.php');
?>