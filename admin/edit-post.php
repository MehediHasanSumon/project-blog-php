<?php
include('include/header.php');
$categories = get_all_data('categories');
$post_slug = $_GET['post'];
$data = get_single_data_array('posts', 'post_slug', $post_slug);
$post_id = $data['id'];
$featured_post = get_single_data_array('featured_posts', 'post_id', $post_id);
$hot_post = get_single_data_array('hot_posts', 'post_id', $post_id);
get_data_validate($data, '../error/404.php');

?>
<div class="container mt-3">
    <nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="create-post.php">Create Post</a></li>
            <li class="breadcrumb-item"><a href="<?= 'change-post-thumb.php?post=' . $data['post_slug'] ?>">Change post thumb</a></li>
        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-header"><strong class="fs-4">Edit Category</strong></div>
    <div class="card-body">
        <div style="width: 40%;margin:auto">
            <form action="request/post.php" method="post" enctype="multipart/form-data">
                <div class="form-group mb-2">
                    <label for="post-title" class="form-label">Post Title</label>
                    <input type="text" class="form-control" id="post-title" name="post_title" placeholder="Post Title" value="<?= $data['post_title'] ?>" />
                </div>
                <div class="form-group mb-2">
                    <label for="post-body" class="form-label">Post Body</label>
                    <textarea class="form-control" name="post_body" id="post-body" rows="3"><?= $data['post_body'] ?></textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="post-category" class="form-label">Post Category</label>
                    <select class="form-select" name="post_category" id="post-category" aria-label="Default select example">
                        <?php
                        foreach ($categories as $category) {
                            echo '<option value="' . $category['name'] . '"';
                            echo $data['category'] === $category['name'] ? ' selected' : '';
                            echo '>' . $category['name'] . '</option>';
                        }
                        ?>

                    </select>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="featured_posts" value="1" id="featuredPosts" <?= isset($featured_post['post_id']) && $post_id === $featured_post['post_id'] ? 'checked' : '' ?>>

                    <label class="form-check-label" for="featuredPosts">
                        Featured Post
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hot_posts" value="1" id="hotPosts" <?= isset($hot_post['post_id']) && $post_id === $hot_post['post_id'] ? 'checked' : '' ?>>
                    <label class="form-check-label" for="hotPosts">
                        Hot Post
                    </label>
                </div>

                <div class="form-group mb-2">
                    <input type="hidden" name="post_slug" value="<?= $data['post_slug'] ?>" />
                    <input type="hidden" name="post_id" value="<?= $data['id'] ?>" />
                    <input type="submit" class="btn btn-primary float-end" name="update_post" value="Update Post" />
                </div>
            </form>
        </div>
    </div>
</div>


<?php
include('include/footer.php');
?>