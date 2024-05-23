<?php
include('include/header.php');
$category_slug = $_GET['category'];
$data = get_single_data_array('categories', 'slug', $category_slug);
get_data_validate($data, '../error/404.php');

?>

<div class="card">
    <div class="card-header"><strong class="fs-4">Edit Category</strong></div>
    <div class="card-body">
        <div style="width: 40%;margin:auto">
            <form action="request/category.php" method="POST">
                <div class="form-group mb-2">
                    <label for="cat_id">Category ID</label>
                    <input type="text" class="form-control" id="cat_id" name="cat_id" value="<?= $data['id'] ?>" disabled />
                </div>
                <div class="form-group mb-2">
                    <label for="catName">Category Name</label>
                    <input type="text" class="form-control" id="catName" name="catName" value="<?= $data['name'] ?>" />
                </div>
                <div class="form-group mb-2">
                    <label for="slug">Category Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="<?= $data['slug'] ?>" disabled />
                </div>
                <div class="form-group mb-2">
                    <label for="created_at">Created At</label>
                    <input type="text" class="form-control" id="created_at" name="created_at" value="<?= $data['created_at'] ?>" disabled />
                </div>
                <div class="form-group mb-2">
                    <label for="updated_at">Updated At</label>
                    <input type="text" class="form-control" id="updated_at" name="updated_at" value="<?= $data['updated_at'] ?>" disabled />
                </div>
                <input type="hidden" name="catSlug" value="<?= $data['slug'] ?>" />
                <input type="submit" class="btn btn-primary" id='login' style="width: 100%" name="updateCat" value="Update">
            </form>
        </div>
    </div>
</div>


<?php
include('include/footer.php');
?>