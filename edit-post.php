<?php
include('include/header.php');

if (!authenticated()) {
  redirect('login.php', "Please login first.");
}
$user_id = $_SESSION['user_id'];
$post_slug = $_GET['post'];
$user = get_single_data_array('users', 'id', $user_id);
$post = get_single_data_array('posts', 'post_slug', $post_slug);
get_data_validate($post, 'error/404.php');
if ($post['user_id'] !== $user['id']) {
  redirect("index.php", "Problem occurred..");
}

$categories = get_all_data('categories');
?>

<div class="container mt-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="<?= 'change-thumb.php?post=' . $post['post_slug'] ?>">Change Thumb</a></li>

    </ol>
  </nav>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <div class="card mt-4">
        <div class="card-header"><strong>Update Post</strong></div>
        <div class="card-body">
          <form action="request/post.php" method="post" enctype="multipart/form-data">
            <div class="form-group mb-2">
              <label for="post-title" class="form-label">Post Title</label>
              <input type="text" class="form-control" id="post-title" name="post_title" placeholder="Post Title" value="<?= $post['post_title'] ?>" />
            </div>
            <div class="form-group mb-2">
              <label for="post-body" class="form-label">Post Body</label>
              <textarea class="form-control" name="post_body" id="post-body" rows="3"><?= $post['post_body'] ?></textarea>
            </div>
            <div class="form-group mb-2">
              <label for="post-category" class="form-label">Post Category</label>
              <select class="form-select" name="post_category" id="post-category" aria-label="Default select example">
                <?php
                foreach ($categories as $category) {
                  echo '<option value="' . $category['name'] . '"';
                  echo $post['category'] === $category['name'] ? ' selected' : '';
                  echo '>' . $category['name'] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group mb-2">
              <input type="hidden" name="post_slug" value="<?= $post['post_slug'] ?>" />
              <input type="submit" class="btn btn-primary float-end" name="update_post" value="Update Post" />
            </div>
          </form>
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