<?php
include('include/header.php');
?>

<div class="card">
    <div class="card-header"><strong class="fs-4">Create Category</strong></div>
    <div class="card-body">
        <div style="width: 40%;margin:auto">
            <form action="request/category.php" method="POST">
                <div class="form-group mb-2">
                    <label for="catName">Category Name</label>
                    <input type="text" class="form-control" id="catName" name="catName" placeholder="Category Name" />
                </div>
                <input type="submit" class="btn btn-primary" id='login' style="width: 100%" name="createCat" value="Create">
            </form>
        </div>
    </div>
</div>


<?php
include('include/footer.php');
?>