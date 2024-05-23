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
      <li class="breadcrumb-item active" aria-current="page">
        <?= isset($user['name']) ? $user['name'] : '' ?>
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
                <a href="edit-profile.php" class="btn btn-primary">Edit Profile</a>
                <a href="user-post.php" class="btn btn-outline-success">See Post</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Full Name</h6>
              </div>
              <div class="col-sm-9 text-secondary"><?= isset($user['name']) ? $user['name'] : '' ?></div>
            </div>
            <hr />
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Email</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?= isset($user['email']) ? $user['email'] : '' ?>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Mobile Number</h6>
              </div>
              <div class="col-sm-9 text-secondary"><?= isset($userInfo['mobile_number']) ? $userInfo['mobile_number'] : '' ?></div>
            </div>
            <hr />
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Institute</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?= isset($userInfo['institute']) ? $userInfo['institute'] : '' ?>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Address</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?= isset($userInfo['address']) ? $userInfo['address'] : '' ?>
              </div>
            </div>
            <hr />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include('include/footer.php');
?>