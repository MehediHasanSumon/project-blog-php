<?php
require_once '/xampp/htdocs/blogtd/config/functions.php';

if (isset($_REQUEST['create'])) {
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $user_role = $_REQUEST['user_role'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $data = [
        'name' => $name,
        'email' => $email,
        'user_role' => $user_role,
        'password' => $hashed_password,
    ];

    $result = insert_data('users', $data);

    if ($result) {
        redirect('../users.php', "$name has been added..");
    } else {
        redirect('../create-user.php', "Problem occurred..");
    }
}
if (isset($_REQUEST['update'])) {
    $user_id = $_REQUEST['user_id'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $user_role = $_REQUEST['user_role'];

    $data = [
        'name' => $name,
        'email' => $email,
        'user_role' => $user_role,
    ];

    $result = update_data('users', $data, 'id', $user_id);

    if ($result) {
        redirect('../users.php', "User has been Updated..");
    } else {
        redirect('../edit-user.php?user=$user_id', "Problem occurred..");
    }
}
if (isset($_REQUEST['changepassword'])) {
    $user_id = $_REQUEST['user_id'];
    $password = $_REQUEST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $data = [
        'password' => $hashed_password,
    ];

    $result = update_data('users', $data, 'id', $user_id);

    if ($result) {
        redirect('../users.php', "User password has been Updated..");
    } else {
        redirect('../edit-user.php?user=$user_id', "Problem occurred..");
    }
}

if (isset($_REQUEST['delete'])) {
    $user_id = $_REQUEST['user_id'];

    $result = delete_data('users', 'id', $user_id);

    if ($result) {
        redirect('../users.php', "User  has been Deleted..");
    } else {
        redirect('../users.php', "Problem occurred..");
    }
}

if (isset($_REQUEST['change_password'])) {
    $user_id = $_POST['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $query = "SELECT * FROM users WHERE id='$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($current_password, $user['password'])) {
            $data = [
                'password' => $hashed_password
            ];
            if (update_data('users', $data, 'id', $user_id)) {
                redirect('../index.php', "Password Changed successfully.");
            } else {
                redirect('../change-password.php', "Problem occurred.");
            }
        }
    }
}
