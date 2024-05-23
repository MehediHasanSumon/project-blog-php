<?php
include('include/header.php');

$posts = get_all_data("posts");
?>
<div class="container mt-3">
    <nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="create-post.php">Create Post</a></li>
        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-header"><strong class="fs-4">Posts</strong></div>
    <div class="card-body">
        <?php
        if ($posts === false) {
            echo 'No post avilable';
        } else {
            echo '<table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">SL.</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
            foreach ($posts as $post) {
                echo '<tr>
                        <th scope="row">' . $post['id'] . '</th>
                        <td>' . $post['post_title'] . '</td>
                        <td>' . $post['category'] . '</td>
                        <td>
                            <a href="edit-post.php?post=' . $post['post_slug'] . '" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="request/post.php" method="POST" style="display:inline;">
                                <input type="hidden" name="post_slug" value="' . $post['post_slug'] . '">
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