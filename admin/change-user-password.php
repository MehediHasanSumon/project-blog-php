<?php
include('include/header.php');

$user_id = $_GET['user'];
$data = get_single_data_array('users', 'id', $user_id);
get_data_validate($data, '../error/404.php');

?>

<div class="card">
    <div class="card-header"><strong class="fs-4">Create User</strong></div>
    <div class="card-body">
        <div style="width: 40%;margin:auto">
            <div id="msg"></div>
            <form action="request/user.php" method="POST">
                <div class="form-group mb-2">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                </div>
                <div class="form-group mb-2">
                    <label for="password2">Re-type Password</label>
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Re-type Password" />
                </div>
                <input type="hidden" name="user_id" value="<?= $data['id'] ?>">
                <input type="submit" class="btn btn-primary" id='login' style="width: 100%" name="changepassword" value="Change Password">
            </form>
        </div>
    </div>
</div>


<?php
include('include/footer.php');
?>