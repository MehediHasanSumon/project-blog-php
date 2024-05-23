<?php
include('include/header.php');
$user_id = $_GET['user'];
$data = get_single_data_array('users', 'id', $user_id);
get_data_validate($data, '../error/404.php');
$message = message();
?>

<div class="container mt-3">
    <nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="create-user.php">Create User</a></li>
            <li class="breadcrumb-item"><a href="change-user-password.php?user=<?= $data['id'] ?>">Change User Password</a></li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-header"><strong class="fs-4">Edit User</strong></div>
    <div class="card-body">
        <div style="width: 40%;margin:auto">
            <?= isset($message) ? "<div class='error'>{$message}</div>" : '' ?>
            <form action="request/user.php" method="POST">
                <div class="form-group mb-2">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $data['name'] ?>" />
                </div>
                <div class="form-group mb-2">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $data['email'] ?>" />
                </div>
                <div class="form-group mb-2">
                    <label for="user_role">User Permission</label>
                    <select class="form-select" id="user_role" name="user_role" aria-label="Default select example">
                        <option value="admin" <?= $data['user_role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="user" <?= $data['user_role'] === 'user' ? 'selected' : '' ?>>Normal User</option>
                    </select>
                </div>
                <input type="hidden" name="user_id" value="<?= $data['id'] ?>">
                <input type="submit" class="btn btn-primary" id='login' style="width: 100%" name="update" value="Update User">
            </form>
        </div>
    </div>
</div>


<?php
include('include/footer.php');
?>