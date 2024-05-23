<?php

$comments = show_comment($post_id);

if ($comments) {
    foreach ($comments as $comment) {
        echo '<div class="card my-3">
            <div class="card-body d-flex">
                <div class="comment-dp">
                    <img src="uploads/user/' . $comment['profile_image'] . '" alt="author" />
                </div>
                <div class="mx-3" style="width: 67%;">
                    <h5 class="card-title">' . $comment['user_name'] . '</h5>
                    <p class="card-text">' . $comment['comment'] . '</p>
                </div>';
        if (isset($_SESSION['user_id'])) {
            if ($comment['comment_user_id'] === $_SESSION['user_id']) {
                echo '<div class="mx-3" style="width: 12%;">
                    <form action="request/post.php" method="POST" style="display:inline;">
                        <input type="hidden" name="comment_id" value="' . $comment['comment_id'] . '">
                        <button type="submit" name="delete_comment" id="delete" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </div>';
            }
        }
        echo '</div>
        </div>';
    }
}
