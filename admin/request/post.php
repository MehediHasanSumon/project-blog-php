<?php
require_once '/xampp/htdocs/blogtd/config/functions.php';
if (isset($_REQUEST['publish_post'])) {
    if (($_REQUEST['post_title']) == '') {
        redirect('../new-post.php', "The Post title field is required.");
    } elseif (($_REQUEST['post_body'] == '')) {
        redirect('../new-post.php', "The Post Body field is required.");
    } elseif (($_REQUEST['post_category']) == '') {
        redirect('../new-post.php', "The Category field is required.");
    } else {
        $user_id = $_POST['user_id'];
        $post_title = $_POST['post_title'];
        $slug = create_slug($post_title);
        $post_body = $_POST['post_body'];
        $post_category = $_POST['post_category'];
        $imageName = $_FILES['post_thumbnail']['name'];
        $imageTempName = $_FILES['post_thumbnail']['tmp_name'];
        $imageError = $_FILES['post_thumbnail']['error'];
        $imageSize = $_FILES['post_thumbnail']['size'];

        if ($imageError === 0) {
            if ($imageSize <= 5000000) { // 5MB limit
                $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array(strtolower($imageExt), $allowed)) {
                    $imageNewName = uniqid('', true) . "." . $imageExt;
                    $imageDestination = '../../uploads/posts/' . $imageNewName;

                    if (move_uploaded_file($imageTempName, $imageDestination)) {

                        $data = [
                            'post_title' => $post_title,
                            'post_body' => $post_body,
                            'post_slug' => $slug,
                            'category' => $post_category,
                            'post_image' => $imageNewName,
                            'user_id' => $user_id,
                        ];
                        if (insert_data('posts', $data)) {
                            redirect('../posts.php', "Post published successfully.");
                        } else {
                            redirect('../create-post.php', "Problem occurred while updating the database.");
                        }
                    } else {
                        redirect('../create-post.php', "Problem occurred while moving the uploaded file.");
                    }
                } else {
                    redirect('../create-post.php', "Invalid file type!");
                }
            } else {
                redirect('../create-post.php', "The image is too large!");
            }
        } else {
            redirect('../create-post.php', "Error uploading Image!");
        }
    }
}


if (isset($_REQUEST['delete'])) {
    $post_slug = $_REQUEST['post_slug'];

    if (delete_data('posts', 'post_slug', $post_slug)) {
        redirect('../posts.php', "Post has been Deleted..");
    } else {
        redirect('../posts.php', "Problem occurred..");
    }
}

if (isset($_REQUEST['update_post'])) {
    $post_slug = $_REQUEST['post_slug'];
    $post_id = $_REQUEST['post_id'];

    $post_title = $_REQUEST['post_title'];
    $slug = create_slug($post_title);
    $post_body = $_REQUEST['post_body'];
    $post_category = $_REQUEST['post_category'];


    if (isset($_POST['featured_posts'])) {
        $data = [
            'post_id' => $post_id
        ];
        create_or_update('featured_posts', $data);
    } else {
        $conditions = "post_id = $post_id";
        if (checkDataExists('featured_posts', $conditions)) {
            delete_data('featured_posts', 'post_id', $post_id);
        }
    }


    if (isset($_POST['hot_posts'])) {
        $data = [
            'post_id' => $post_id
        ];
        create_or_update('hot_posts', $data);
    } else {
        $conditions = "post_id = $post_id";
        if (checkDataExists('hot_posts', $conditions)) {
            delete_data('hot_posts', 'post_id', $post_id);
        }
    }

    $data = [
        'post_title' => $post_title,
        'post_slug' => $slug,
        'post_body' => $post_body,
        'category' => $post_category,
    ];

    if (update_data('posts', $data, 'post_slug', $post_slug)) {
        redirect('../posts.php', "Post has been Updated..");
    } else {
        redirect('../edit-post.php?post=$post_slug', "Problem occurred..");
    }
}

if (isset($_REQUEST['change_thumb'])) {
    $post_slug = $_POST['post_slug'];

    $imageName = $_FILES['post_thumbnail']['name'];
    $imageTempName = $_FILES['post_thumbnail']['tmp_name'];
    $imageError = $_FILES['post_thumbnail']['error'];
    $imageSize = $_FILES['post_thumbnail']['size'];

    if ($imageError === 0) {
        if ($imageSize <= 5000000) { // 5MB limit
            $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array(strtolower($imageExt), $allowed)) {
                $imageNewName = uniqid('', true) . "." . $imageExt;
                $imageDestination = '../../uploads/posts/' . $imageNewName;

                if (move_uploaded_file($imageTempName, $imageDestination)) {
                    $data = [
                        'post_image' => $imageNewName,
                    ];

                    if (update_data('posts', $data, 'post_slug', $post_slug)) {
                        redirect('../posts.php', "Post Thumb updated successfully.");
                    } else {
                        redirect('../change-post-thumb.php', "Problem occurred while updating the database.");
                    }
                } else {
                    redirect('../change-post-thumb.php', "Problem occurred while moving the uploaded file.");
                }
            } else {
                redirect('../change-post-thumb.php', "Invalid file type!");
            }
        } else {
            redirect('../change-post-thumb.php', "File is too large!");
        }
    } else {
        redirect('../change-post-thumb.php', "Error uploading file!");
    }
}
