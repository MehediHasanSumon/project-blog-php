<?php
include('include/header.php');

$results = [];
if (isset($_POST['submit_search'])) {
    $search = $_POST['search'];
    $results = search_posts($search);
}

include('include/search.php');
?>

<body>
    <div class="container mt-4">
        <div class="card mt-4">
            <div class="card-header"><strong>Search Results</strong></div>
            <div class="card-body">
                <?php
                if ($results === false) {
                    echo 'No post avilable';
                } else {
                    foreach ($results as  $post) {
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
                                                <small class="text-muted">Last updated ' . timeAgo($post['created_at']) . '</small>
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
    </div>
    <?php
    include('include/footer.php');
    ?>