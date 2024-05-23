<?php
include('include/header.php');
$categories = get_all_data('categories');
?>

<div class="card">
    <div class="card-header"><strong class="fs-4">Create Post</strong></div>
    <div class="card-body">
        <div style="width: 40%;margin:auto">
            <form action="request/post.php" method="post" enctype="multipart/form-data">
                <div class="form-group mb-2">
                    <label for="post-title" class="form-label">Post Title</label>
                    <input type="text" class="form-control" id="post-title" name="post_title" placeholder="Post Title" />
                </div>
                <div class="form-group mb-2">
                    <label for="post-thumbnail" class="form-label">Post Thumbnail</label>
                    <input type="file" class="form-control" name="post_thumbnail" id="post-thumbnail" accept="image/*" />
                </div>
                <div class="form-group mb-2">
                    <label for="post-body" class="form-label">Post Body</label>
                    <textarea class="form-control" name="post_body" id="post-body" rows="3"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="post-category" class="form-label">Post Category</label>
                    <select class="form-select" name="post_category" id="post-category" aria-label="Default select example">
                        <option selected>Selete One --</option>
                        <?php
                        foreach ($categories as  $category) {
                            echo '<option value="' . $category['name'] . '">' . $category['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <input type="hidden" name="user_id" value="<?= isset($user['id']) ? $user['id'] : '' ?>" />
                    <input type="submit" class="btn btn-primary float-end" name="publish_post" value="Publish Post" />
                </div>
            </form>
        </div>
    </div>
</div>


<?php
include('include/footer.php');
?>