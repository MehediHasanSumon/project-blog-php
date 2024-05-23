<?php
include('include/header.php');
if (!authenticated()) {
    redirect('login.php', "Please login first.");
}
$user_id = $_SESSION['user_id'];
$user = get_single_data_array('users', 'id', $user_id);
$message = message();

?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="login-form">
                <?= isset($message) ? "<div class='error'>{$message}</div>" : '' ?>
                <form action="request/user.php" method="POST" enctype="multipart/form-data">
                    <h2>Change Profile Picture</h2>
                    <hr>
                    <div class="previweimg mt-2 mb-2">
                        <img id="imagePreview" src="images/User_Icon.png" alt="Image Preview">
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" name="profile_image" class="form-control" id="imageUpload" accept="image/*">
                    </div>
                    <input type="hidden" name="user_id" value="<?= isset($user['id']) ? $user['id'] : '' ?>" />
                    <input type="submit" class="btn btn-outline-success" style="width: 100%" name="change_profile_picture" value="Change Profile Picture">
                </form>

            </div>
        </div>
    </div>
</div>

<?php
include('include/footer.php');
?>