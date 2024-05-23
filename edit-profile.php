<?php
include('include/header.php');
if (!authenticated()) {
  redirect('login.php', "Please login first.");
}
$user_id = $_SESSION['user_id'];
$user = get_single_data_array('users', 'id', $user_id);
$userInfo = get_single_data_array('users_info', 'user_id', $user_id);

?>
<div class="container mt-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="profile.php"><?= isset($user['name']) ? $user['name'] : '' ?></a></li>
      <li class="breadcrumb-item active" aria-current="page">
        Edit Profile
      </li>
    </ol>
  </nav>
</div>

<div class="container">
  <div class="main-body">
    <div class="row gutters-sm">
      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <div class="previweimg mt-2 mb-2">
                <img src="<?php
                          if (isset($userInfo['profile_image'])) {
                            echo "uploads/user/" . $userInfo['profile_image'];
                          } else {
                            echo "images/User_Icon.png";
                          }
                          ?>" alt="Admin" id="imagePreview" />
              </div>
              <div class="mt-3">
                <h4><?= isset($user['name']) ? $user['name'] : '' ?></h4>
                <p class="text-secondary mt-2 mb-2"><?= isset($userInfo['bio']) ? $userInfo['bio'] : '' ?></p>
                <a href="profile.php" class="btn btn-primary">Profile</a>
                <a href="change-profile-picture.php" class="btn btn-outline-success">Change Profile Picture</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <form action="request/user.php" method="POST">
              <div class="row">
                <div class="form-group mb-2">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="<?= isset($user['name']) ? $user['name'] : '' ?>" />
                </div>
              </div>
              <div class="row">
                <div class="form-group mb-2">
                  <label for="email">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= isset($user['email']) ? $user['email'] : '' ?>" />
                </div>
              </div>
              <div class="row">
                <div class="form-group mb-2">
                  <label for="mobile-number">Mobile Number</label>
                  <input type="text" class="form-control" id="mobile-number" name="mobile_number" placeholder="Mobile Number" value="<?= isset($userInfo['mobile_number']) ? $userInfo['mobile_number'] : '' ?>" />
                </div>
              </div>
              <div class="row">
                <div class="form-group mb-2">
                  <label for="institute">Institute</label>
                  <input type="text" class="form-control" id="institute" name="institute" placeholder="Institute" value="<?= isset($userInfo['institute']) ? $userInfo['institute'] : '' ?>" />
                </div>
              </div>
              <div class="row">
                <div class="form-group mb-2">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?= isset($userInfo['address']) ? $userInfo['address'] : '' ?>" />
                </div>
              </div>
              <div class="row">
                <div class="form-group mb-2">
                  <label for="bio">Bio</label>
                  <input type="text" class="form-control" id="bio" name="bio" placeholder="Bio" value="<?= isset($userInfo['bio']) ? $userInfo['bio'] : '' ?>" />
                </div>
              </div>
              <input type="hidden" name="user_id" value="<?= isset($user['id']) ? $user['id'] : '' ?>" />
              <input type="submit" class="btn btn-outline-success float-end" name="save" value="Save">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="bg-dark text-light pt-5 mt-4">
  <div class="container">
    <d class="row">
      <div class="col-md-6">
        <h5>About Us</h5>
        <p>A brief description of your blog and what it offers.</p>
      </div>
      <div class="col-md-3">
        <h5>Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="#">Home</a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">New Post</a></li>
          <li><a href="#">Logout</a></li>
          <li><a href="#">Login</a></li>
          <li><a href="#">Registration</a></li>
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
      </ <div class="row">
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
<script src="js/app.js"></script>
</body>

</html>