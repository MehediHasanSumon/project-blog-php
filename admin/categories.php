<?php
include('include/header.php');

$categories = get_all_data("categories");
?>
<div class="container mt-3">
    <nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="create-category.php">Create Category</a></li>
        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-header"><strong class="fs-4">Categories</strong></div>
    <div class="card-body">


        <?php
        if ($categories === false) {
            echo 'No category avilable';
        } else {
            echo ' <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($categories as $category) {
                echo '<tr>
                        <th scope="row">' . $category['id'] . '</th>
                        <td>' . $category['name'] . '</td>
                        <td>' . $category['slug'] . '</td>
                        <td>' . $category['created_at'] . '</td>
                        <td>' . $category['updated_at'] . '</td>
                        <td>
                            <a href="edit-category.php?category=' . $category['slug'] . '" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="request/category.php" method="POST" style="display:inline;">
                                <input type="hidden" name="slug" value="' . $category['slug'] . '">
                                <button type="submit" name="delete" id="delete" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>

                        </td>
                    </tr>';
            }

            echo '</tbody>
                </table>';
        }
        ?>
    </div>
</div>


<?php
include('include/footer.php');
?>