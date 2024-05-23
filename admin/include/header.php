<?php
require_once '/xampp/htdocs/blogtd/config/functions.php';
$user_role = user_role();
if ($user_role !== 'admin') {
    redirect('../', "Permission denied,You're not Admin");
}
$user = get_single_data_array('users', 'id', $_SESSION['user_id']);
$message = message();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="css/app.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/sidebar.css" />
    <link rel="stylesheet" href="css/fontawesome.css" />
</head>

<body>
    <header id="top-section" class="sticky-top shadow">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">Sumon</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><?= $user['name'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">/</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">/</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="row">
        <div class="col-sm-2">
            <?php include('sidebar.php'); ?>
        </div>
        <div class="col-sm-10 mt-1">
            <?= isset($message) ? "<div class='error'>{$message}</div>" : '' ?>