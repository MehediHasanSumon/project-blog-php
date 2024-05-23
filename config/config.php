<?php

$env = parse_ini_file('.env');

// Access variables
$servername = $env['DB_HOST'];
$username = $env['DB_USER'];
$password = $env['DB_PASSWORD'];
$dbname = $env['DB_NAME'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected";
}
