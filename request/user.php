<?php
require_once "../config/functions.php";
if (isset($_REQUEST["save"])) {
    $user_id = $_POST["user_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile_number = $_POST["mobile_number"];
    $institute = $_POST["institute"];
    $address = $_POST["address"];
    $bio = $_POST["bio"];

    $data1 = [
        "name" => $name,
        "email" => $email,
    ];
    $data2 = [
        "id" =>  $user_id,
        "mobile_number" => $mobile_number,
        "institute" => $institute,
        "address" => $address,
        "bio" => $bio,
        "user_id" => $user_id,
    ];

    if (update_data("users", $data1, "id", $user_id) && create_or_update("users_info", $data2)) {
        redirect("../profile.php", "Profile updated successful..");
    } else {
        redirect("../edit-profile.php", "Problem occurred..");
    }
}

if (isset($_POST["change_profile_picture"])) {
    $user_id = $_POST["user_id"];
    $imageName = $_FILES["profile_image"]["name"];
    $imageTempName = $_FILES["profile_image"]["tmp_name"];
    $imageError = $_FILES["profile_image"]["error"];
    $imageSize = $_FILES["profile_image"]["size"];

    if ($imageError === 0) {
        if ($imageSize <= 5000000) { // 5MB limit
            $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
            $allowed = ["jpg", "jpeg", "png", "gif"];

            if (in_array(strtolower($imageExt), $allowed)) {
                $imageNewName = uniqid("", true) . "." . $imageExt;
                $imageDestination = "../uploads/user/" . $imageNewName;

                if (move_uploaded_file($imageTempName, $imageDestination)) {
                    $data = [
                        "id" => $user_id,
                        "profile_image" => $imageNewName,
                    ];

                    if (create_or_update("users_info", $data)) {
                        redirect("../profile.php", "Profile updated successfully.");
                    } else {
                        redirect("../change-profile-picture.php", "Problem occurred while updating the database.");
                    }
                } else {
                    redirect("../change-profile-picture.php", "Problem occurred while moving the uploaded file.");
                }
            } else {
                redirect("../change-profile-picture.php", "Invalid file type!");
            }
        } else {
            redirect("../change-profile-picture.php", "File is too large!");
        }
    } else {
        redirect("../change-profile-picture.php", "Error uploading file!");
    }
}
