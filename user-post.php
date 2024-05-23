<?php
include('include/header.php');

$limit = 10;
$total_rows = get_total_rows("posts");
$total_pages = ceil($total_rows / $limit);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $total_pages) $page = $total_pages;

$offset = max(($page - 1) * $limit, 0); // Ensure offset is non-negative

$user_id = null;

if (isset($_SESSION['user_id'])) {
  if (isset($_GET['user'])) {
    $user_id = $_GET['user'];
  } else {
    $user_id = $_SESSION['user_id'];
  }
} elseif (isset($_GET['user'])) {
  $user_id = $_GET['user'];
}

$user = get_single_data_array('users', 'id', $user_id);

$all_post = get_data_by_where_and_limit("posts", 'user_id', $user_id, $limit, $offset);

$user = get_single_data_array('users', 'id', $user_id);
$userInfo = get_single_data_array('users_info', 'user_id', $user_id);
get_data_validate($user, 'error/404.php');
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

<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <div class="card mt-4">
        <div class="card-header"><strong><?= isset($user['name']) ? $user['name'] : '' ?></strong></div>
        <div class="card-body">
          <?php

          if ($all_post === false) {
            echo 'No Post Available';
          } else {
            foreach ($all_post as $post) {
              echo '<a href="post.php?post=' . $post['post_slug'] . '">
                                    <div class="card mb-3">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="uploads/posts/' . $post['post_image'] . '" class="img-fluid rounded-start" alt="images" style="height: 100%" />
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">' . $post['post_title'] . '</h5>
                                                    <p class="card-text">
                                                        ' . substr($post['post_body'], 0, 150) . '....
                                                    </p>
                                                    <p class="card-text">
                                                        <small class="text-muted">Last updated ' . timeAgo($post['updated_at']) . '</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </a>';
            }
            render_pagination($page, $total_pages);
          }
          ?>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <?php
      include('include/category.php');
      ?>
    </div>
  </div>
</div>
<?php
include('include/footer.php');
?>