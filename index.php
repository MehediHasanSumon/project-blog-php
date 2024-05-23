<?php
include('include/header.php');

$limit = 10;
$total_rows = get_total_rows("posts");
$total_pages = ceil($total_rows / $limit);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $total_pages) $page = $total_pages;

$offset = ($page - 1) * $limit;

$all_post = get_data_by_limit("posts", $limit, $offset);

$get_all_featured_post = get_posts_by_id('posts', 'featured_posts');
$get_all_hot_post = get_posts_by_id('posts', 'hot_posts');

include('include/search.php');
?>


<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="card mt-4">
                <div class="card-header"><strong>Featured posts</strong></div>
                <div class="card-body">
                    <?php
                    if (!$get_all_featured_post) {
                        echo 'No post avilable';
                    } else {
                        foreach ($get_all_featured_post as  $post) {
                            echo '<a href="post.php?post=' . $post['post_slug'] . '">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="uploads/posts/' . $post['post_image'] . '" class="img-fluid rounded-start" alt="images" style="height: 100%" />
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">' . $post['post_title'] . '</h5>
                                                <p class="card-text">
                                                   ' . substr($post['post_body'], 0, 150) . '....
                                                </p>
                                                <p class="card-text">
                                                    <small class="text-muted">Last updated ' . timeAgo($post['updated_at']) . '</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header"><strong>Hot posts</strong></div>
                <div class="card-body">
                    <?php
                    if (!$get_all_hot_post) {
                        echo 'No post avilable';
                    } else {
                        foreach ($get_all_hot_post as  $post) {
                            echo '<a href="post.php?post=' . $post['post_slug'] . '">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="uploads/posts/' . $post['post_image'] . '" class="img-fluid rounded-start" alt="images" style="height: 100%" />
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">' . $post['post_title'] . '</h5>
                                                <p class="card-text">
                                                   ' . substr($post['post_body'], 0, 150) . '....
                                                </p>
                                                <p class="card-text">
                                                    <small class="text-muted">Last updated ' . timeAgo($post['updated_at']) . '</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header"><strong>Recent posts</strong></div>
                <div class="card-body">
                    <?php

                    if ($all_post === false) {
                        echo 'No post avilable';
                    } else {
                        foreach ($all_post as  $post) {
                            echo '<a href="post.php?post=' . $post['post_slug'] . '">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="uploads/posts/' . $post['post_image'] . '" class="img-fluid rounded-start" alt="images" style="height: 100%" />
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">' . $post['post_title'] . '</h5>
                                                <p class="card-text">
                                                   ' . substr($post['post_body'], 0, 150) . '....
                                                </p>
                                                <p class="card-text">
                                                    <small class="text-muted">Last updated ' . timeAgo($post['updated_at']) . '</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>';
                        }
                        render_pagination($page, $total_pages);
                    }
                    ?>
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