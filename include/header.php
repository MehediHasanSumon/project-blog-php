<?php
require_once 'config/functions.php';
$message = message();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BlogTD</title>
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="css/app.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/github-dark.min.css" />
    <link rel="stylesheet" href="css/prism-tomorrow.min.css" />
</head>

<body>

    <?php
    include('navbar.php');
    ?>

    <div class="container"> <?= isset($message) ? "<div class='error'>{$message}</div>" : '' ?></div>