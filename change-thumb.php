<?php
include('include/header.php');

if (!authenticated()) {
    redirect('login.php', "Please login first.");
}
$user_id = $_SESSION['user_id'];
$post_slug = $_GET['post'];
$user = get_single_data_array('users', 'id', $user_id);
$post = get_single_data_array('posts', 'post_slug', $post_slug);
$categories = get_all_data('categories');
get_data_validate($post, 'error/404.php');
?>

<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="change-thumb.php">Change Thumb</a></li>

        </ol>
    </nav>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="card mt-4">
                <div class="card-header"><strong>Change Post Image</strong></div>
                <div class="card-body">
                    <form action="request/post.php" method="post" enctype="multipart/form-data">
                        <div class="imagepreview mt-2 mb-2">
                            <img id="imagePreview" src="<?= 'uploads/posts/' . $post['post_image'] ?>" alt="Image Preview">
                        </div>
                        <div class="form-group mb-2">
                            <label for="imageUpload" class="form-label">Post Thumbnail</label>
                            <input type="file" name="post_thumbnail" class="form-control" id="imageUpload" accept="image/*">
                        </div>
                        <div class="form-group mb-2">
                            <input type="hidden" name="post_slug" value="<?= $post['post_slug'] ?>" />
                            <input type="submit" class="btn btn-primary float-end" name="change_thumb" value="Change Post Image" />
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