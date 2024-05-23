<?php
include('include/header.php');
$posts = get_all_data("posts");
$total_post = count_table('posts');
$total_user = count_table('users');
$total_category = count_table('categories');


?>

<div class="card">
  <div class="card-header"><strong class="fs-4">Dashboard</strong></div>
  <div class="card-body">

    <div class="row">
      <div class="col-sm-4">
        <div class="card text-white bg-success mb-3">
          <div class="card-header">
            <h5>Total User</h5>
          </div>
          <div class="card-body">
            <h1 class="text-center"><?= $total_user ?></h1>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card text-white bg-danger mb-3">
          <div class="card-header">
            <h5>Total Post</h5>
          </div>
          <div class="card-body">
            <h1 class="text-center"><?= $total_post ?></h1>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card text-dark bg-warning mb-3">
          <div class="card-header">
            <h5>Total Category</h5>
          </div>
          <div class="card-body">
            <h1 class="text-center"><?= $total_category ?></h1>
          </div>
        </div>
      </div>
    </div>
    <h1 class="text-center">Posts</h1>
    <hr>
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