<?php
include('include/header.php');

$users = get_all_data("users");
?>
<div class="container mt-3">
    <nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="create-user.php">Create User</a></li>
        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-header"><strong class="fs-4">Categories</strong></div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">User Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($users as $user) {
                    echo '<tr>
                        <th scope="row">' . $user['id'] . '</th>
                        <td>' . $user['name'] . '</td>
                        <td>' . $user['email'] . '</td>
                        <td style="text-transform: capitalize;">' . $user['user_role'] . '</td>
                        <td>
                            <a href="edit-user.php?user=' . $user['id'] . '" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="request/user.php" method="POST" style="display:inline;">
                                <input type="hidden" name="user_id" value="' . $user['id'] . '">
                                <button type="submit" name="delete" id="delete" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>

                        </td>
                    </tr>';
                }
                ?>


            </tbody>
        </table>
    </div>
</div>


<?php
include('include/footer.php');
?>