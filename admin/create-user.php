<?php
include('include/header.php');
?>

<div class="card">
    <div class="card-header"><strong class="fs-4">Create User</strong></div>
    <div class="card-body">
        <div style="width: 40%;margin:auto">
            <div id="msg"></div>
            <form action="request/user.php" method="POST">
                <div class="form-group mb-2">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" />
                </div>
                <div class="form-group mb-2">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" />
                </div>
                <div class="form-group mb-2">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                </div>
                <div class="form-group mb-2">
                    <label for="password2">Re-type Password</label>
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Re-type Password" />
                </div>
                <div class="form-group mb-2">
                    <label for="user_role">User Permission</label>
                    <select class="form-select" id="user_role" name="user_role" aria-label="Default select example">
                        <option selected>Select One --</option>
                        <option value="admin">Admin</option>
                        <option value="user">Normal User</option>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" id='login' style="width: 100%" name="create" value="Create User">
            </form>
        </div>
    </div>
</div>


<?php
include('include/footer.php');
?>