<?php
include('include/header.php');

$tables = ['posts|p', 'users|u'];
$columns = [
  'p.id AS post_id',
  'p.post_title',
  'p.post_body',
  'p.post_slug',
  'p.category',
  'p.post_image',
  'p.user_id AS post_user_id',
  'p.created_at AS post_created_at',
  'p.updated_at AS post_updated_at',
  'u.id AS user_id',
  'u.name',
];
$join_conditions = [
  'u.id = p.user_id'
];

$post_slug = mysqli_real_escape_string($conn, $_GET['post']);

$where_condition = "p.post_slug = '$post_slug'";

$data = get_single_data($tables, $columns, $join_conditions, $where_condition);
$post_user_id = $data['post_user_id'];
$post_user = get_single_data_array('users_info', 'user_id', $post_user_id);

$post_id = $data['post_id'];

get_data_validate($data, 'error/404.php');

$category = get_single_data_array('categories', 'name', $data['category']);
$category_slug = $category['slug'];
?>

<div class="container mt-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="<?= "category.php?category=" . $category_slug  ?>"><?= $data['category']; ?></a></li>
      <li class="breadcrumb-item active" aria-current="page">
        <?= $data['post_title']; ?>
      </li>
    </ol>
  </nav>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <article class="mt-4">
        <h2> <?= $data['post_title']; ?></h2>
        <p class="text-muted mx-5">By <?= $data['name']; ?> | <?= timeAgo($data['post_created_at']); ?></p>

        <div class="card">
          <div class="card-body">
            <img src="<?= 'uploads/posts/' . $data['post_image']; ?>" class="img-fluid rounded mb-4" alt="Post Image" />
            <p class="lead">
            <h1> <?= $data['post_title']; ?></h1>
            <?= $data['post_body']; ?>
            </p>

            <?php

            if (isset($_SESSION['user_id'])) {
              if ($data['post_user_id'] === $_SESSION['user_id']) {
                echo '<a href="edit-post.php?post=' . $data['post_slug'] . '" class="btn btn-primary btn-sm">
              <i class="fas fa-edit"></i> Edit
            </a>';
              }
            }

            ?>

          </div>
        </div>
      </article>
      <hr />
      <div class="card my-4">
        <div class="card-header">
          <strong> Author </strong>
        </div>
        <div class="card-body d-flex">
          <div class="author-dp">
            <?php if (isset($post_user['profile_image']) && !empty($post_user['profile_image'])) : ?>
              <img src="<?= 'uploads/user/' . htmlspecialchars($post_user['profile_image']); ?>" alt="author" />
            <?php else : ?>
              <img src="images/User_Icon.png" alt="author" />
            <?php endif; ?>
          </div>
          <div class="border-dp mx-2 px-2">
            <?php
            if (isset($_SESSION['user_id'])) {
              if ($data['post_user_id'] === $_SESSION['user_id']) {
                echo '<h5 class="card-title"><a href="user-post.php">' . $data['name'] . '</a></h5>';
              } else {
                echo '<h5 class="card-title"><a href="user-post.php?user=' . $data['post_user_id'] . '">' . $data['name'] . '</a></h5>';
              }
            } else {
              echo '<h5 class="card-title"><a href="user-post.php?user=' . $data['post_user_id'] . '">' . $data['name'] . '</a></h5>';
            }
            ?>
            <span><?= isset($post_user['bio']) ? htmlspecialchars($post_user['bio']) : ''; ?></span><br>
            <span><?= isset($post_user['institute']) ? htmlspecialchars($post_user['institute']) : ''; ?></span><br>
            <span class="text-muted"><?= timeAgo($data['post_created_at']); ?></span>
          </div>
        </div>
      </div>
      <hr />
      <div class="comments mt-4">
        <h4>Comments</h4>
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <?php
            if (authenticated()) {
            ?>
              <form action="request/post.php" method="POST">
                <div class="form-group">
                  <textarea class="form-control" rows="3" name="comment_text" placeholder="Enter your comment here"></textarea>
                </div>
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                <input type="hidden" name="post_id" value="<?= $data['post_id'] ?>">
                <input type="submit" class="btn btn-primary mt-2 float-end" name="comment" value="Comment" />
              </form>
            <?php
            } else {
              echo 'Please <a href="login.php">logged in</a> first.';
            }
            ?>
          </div>
        </div>
        <?php
        include('comment.php');
        ?>
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