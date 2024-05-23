<?php
include('include/header.php');

$user_id = $_SESSION['user_id'];

?>

<div class="card">
    <div class="card-header"><strong class="fs-4">Create User</strong></div>
    <div class="card-body">
        <div style="width: 40%;margin:auto">
            <div id="msg"></div>
            <form action="request/user.php" method="POST">
                <div class="form-group mb-2">
                    <label for="current-password">Current Password</label>
                    <input type="password" class="form-control" id="current-password" name="current_password" placeholder="Password" />
                </div>
                <div class="form-group mb-2">
                    <label for="new-password">New Password</label>
                    <input type="password" class="form-control" id="new-password" name="new_password" placeholder="Password" />
                </div>
                <div class="form-group mb-2">
                    <label for="password3">Re-type New Password</label>
                    <input type="password" class="form-control" id="password3" placeholder="Re-type Password" />
                </div>
                <input type="hidden" name="user_id" value="<?= $user_id ?>" />
                <input type="submit" id="login" name="change_password" class="btn btn-primary float-end" value="Change Password">

            </form>
        </div>
    </div>
</div>


<?php
include('include/footer.php');
?>