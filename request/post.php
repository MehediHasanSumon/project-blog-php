<?php
require_once "../config/functions.php";
if (isset($_REQUEST["publish_post"])) {
    if (($_REQUEST["post_title"]) == "") {
        redirect("../new-post.php", "The Post title field is required.");
    } elseif (($_REQUEST["post_body"] == "")) {
        redirect("../new-post.php", "The Post Body field is required.");
    } elseif (($_REQUEST["post_category"]) == "") {
        redirect("../new-post.php", "The Category field is required.");
    } else {
        $user_id = $_POST["user_id"];
        $post_title = $_POST["post_title"];
        $slug = create_slug($post_title);
        $post_body = $_POST["post_body"];
        $post_category = $_POST["post_category"];
        $imageName = $_FILES["post_thumbnail"]["name"];
        $imageTempName = $_FILES["post_thumbnail"]["tmp_name"];
        $imageError = $_FILES["post_thumbnail"]["error"];
        $imageSize = $_FILES["post_thumbnail"]["size"];

        if ($imageError === 0) {
            if ($imageSize <= 5000000) { // 5MB limit
                $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
                $allowed = ["jpg", "jpeg", "png", "gif"];

                if (in_array(strtolower($imageExt), $allowed)) {
                    $imageNewName = uniqid("", true) . "." . $imageExt;
                    $imageDestination = "../uploads/posts/" . $imageNewName;

                    if (move_uploaded_file($imageTempName, $imageDestination)) {

                        $data = [
                            "post_title" => $post_title,
                            "post_body" => $post_body,
                            "post_slug" => $slug,
                            "category" => $post_category,
                            "post_image" => $imageNewName,
                            "user_id" => $user_id,
                        ];
                        if (insert_data("posts", $data)) {
                            redirect("../index.php", "Post published successfully.");
                        } else {
                            redirect("../index.php", "Problem occurred while updating the database.");
                        }
                    } else {
                        redirect("../new-post.php", "Problem occurred while moving the uploaded file.");
                    }
                } else {
                    redirect("../new-post.php", "Invalid file type!");
                }
            } else {
                redirect("../new-post.php", "The image is too large!");
            }
        } else {
            redirect("../new-post.php", "Error uploading Image!");
        }
    }
}


if (isset($_REQUEST["update_post"])) {
    $post_slug = $_REQUEST["post_slug"];

    $post_title = $_REQUEST["post_title"];
    $slug = create_slug($post_title);
    $post_body = $_REQUEST["post_body"];
    $post_category = $_REQUEST["post_category"];

    $data = [
        "post_title" => $post_title,
        "post_slug" => $slug,
        "post_body" => $post_body,
        "category" => $post_category,
    ];

    if (update_data("posts", $data, "post_slug", $post_slug)) {
        redirect("../post.php?post=$slug", "Post has been Updated..");
    } else {
        redirect("../edit-post.php?post=$post_slug", "Problem occurred..");
    }
}

if (isset($_REQUEST["change_thumb"])) {
    $post_slug = $_POST["post_slug"];

    $imageName = $_FILES["post_thumbnail"]["name"];
    $imageTempName = $_FILES["post_thumbnail"]["tmp_name"];
    $imageError = $_FILES["post_thumbnail"]["error"];
    $imageSize = $_FILES["post_thumbnail"]["size"];

    if ($imageError === 0) {
        if ($imageSize <= 5000000) { // 5MB limit
            $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
            $allowed = ["jpg", "jpeg", "png", "gif"];

            if (in_array(strtolower($imageExt), $allowed)) {
                $imageNewName = uniqid("", true) . "." . $imageExt;
                $imageDestination = "../uploads/posts/" . $imageNewName;

                if (move_uploaded_file($imageTempName, $imageDestination)) {
                    $data = [
                        "post_image" => $imageNewName,
                    ];

                    if (update_data("posts", $data, "post_slug", $post_slug)) {
                        redirect("../post.php?post=$post_slug", "Post Thumb updated successfully.");
                    } else {
                        redirect("../change-thumb.php", "Problem occurred while updating the database.");
                    }
                } else {
                    redirect("../change-thumb.php", "Problem occurred while moving the uploaded file.");
                }
            } else {
                redirect("../change-thumb.php", "Invalid file type!");
            }
        } else {
            redirect("../change-thumb.php", "File is too large!");
        }
    } else {
        redirect("../change-thumb.php", "Error uploading file!");
    }
}


if (isset($_REQUEST["comment"])) {
    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    $comment_text = $_POST['comment_text'];
    $post = get_single_data_array('posts', 'id', $post_id);
    $slug = $post['post_slug'];

    if (($_REQUEST['comment_text'] == '')) {
        redirect("../post.php?post=$slug", "The comment field is required.");
    } else {
        $data = [
            "user_id" => $user_id,
            "post_id" => $post_id,
            "comment" => $comment_text,
        ];

        if (insert_data("comments", $data)) {
            redirect("../post.php?post=$slug", "Comment has been Successful");
        } else {
            redirect("../post.php?post=$slug", "Problem occurred..");
        }
    }
}

if (isset($_REQUEST["delete_comment"])) {
    $comment_id = $_POST['comment_id'];
    $comment = get_single_data_array('comments', 'id', $comment_id);
    $post_id = $comment['post_id'];
    $post = get_single_data_array('posts', 'id', $post_id);
    $slug = $post['post_slug'];
    if (delete_data('comments', 'id', $comment_id)) {
        redirect("../post.php?post=$slug", "Comment has been deleted");
    } else {
        redirect("../post.php?post=$slug", "Problem occurred..");
    }
}
