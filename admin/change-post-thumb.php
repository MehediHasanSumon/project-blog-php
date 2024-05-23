<?php
include('include/header.php');

$post_slug = $_GET['post'];
$data = get_single_data_array('posts', 'post_slug', $post_slug);
get_data_validate($data, '../error/404.php');

?>
<div class="container mt-3">
    <nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="create-post.php">Create Post</a></li>
            <li class="breadcrumb-item"><a href="change-post-thumb.php">Change post thumb</a></li>
        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-header"><strong class="fs-4">Edit Category</strong></div>
    <div class="card-body">
        <div style="width: 40%;margin:auto">
            <form action="request/post.php" method="post" enctype="multipart/form-data">
                <div class="previweimg mt-2 mb-2">
                    <img id="imagePreview" src="../images/15805684.jpg" alt="Image Preview">
                </div>
                <div class="form-group mb-2">
                    <label for="imageUpload" class="form-label">Post Thumbnail</label>
                    <input type="file" name="post_thumbnail" class="form-control" id="imageUpload" accept="image/*">
                </div>
                <div class="form-group mb-2">
                    <input type="hidden" name="post_slug" value="<?= $data['post_slug'] ?>" />
                    <input type="submit" class="btn btn-primary float-end" name="change_thumb" value="Change Post Image" />
                </div>
            </form>
        </div>
    </div>
</div>


<?php
include('include/footer.php');
?>