<?php
session_start();
require_once 'config.php';

date_default_timezone_set('UTC');

function insert_data($table, $data)
{
    global $conn;

    foreach ($data as $key => $value) {
        $data[$key] = mysqli_real_escape_string($conn, $value);
    }

    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";

    $query = "INSERT INTO $table ($columns) VALUES ($values)";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function email_exists($email)
{
    global $conn;
    $email = mysqli_real_escape_string($conn, $email);
    $query = "SELECT COUNT(*) as count FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
}
function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header("Location:" . $url);
    exit();
}

function message()
{
    if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        return $message;
    }
}


function auth_user($email, $password)
{
    global $conn;
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            authenticate_user($user['id'], $user['name'], $email);

            if ($user['user_role'] === 'admin') {
                header("Location: ../admin/");
                exit();
            } else {
                header("Location: ../index.php");
                exit();
            }
        } else {
            redirect('../login.php', 'Incorrect password');
        }
    } else {
        redirect('../login.php', "We couldn't find any user associated with this email address.");
    }
}

function user_role()
{
    if (isset($_SESSION['user_id'])) {

        global $conn;

        $user_id = $_SESSION['user_id'];
        $query = "SELECT user_role FROM users WHERE id='$user_id'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            return $user['user_role'];
        }
    }
    return false;
}

function authenticate_user($user_id, $name, $email)
{
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;
}


function authenticated()
{
    return isset($_SESSION['user_id'])  && isset($_SESSION['user_name']) && isset($_SESSION['user_email']) && !empty($_SESSION['user_id']) && !empty($_SESSION['user_name']) && !empty($_SESSION['user_email']);
}

function logout()
{
    $_SESSION = array();

    session_destroy();

    header("Location: login.php");
    exit();
}


function get_all_data($table)
{
    global $conn;

    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    } else {
        return false;
    }
}


function get_data_by_limit($table, $limit, $offset)
{
    global $conn;

    // Validate and sanitize the inputs
    $limit = (int)$limit;
    $offset = (int)$offset;

    // Ensure limit and offset are non-negative
    if ($limit < 0) {
        $limit = 0;
    }
    if ($offset < 0) {
        $offset = 0;
    }

    // Validate table name
    $valid_tables = ['posts', 'users', 'comments']; // Add valid table names as needed
    if (!in_array($table, $valid_tables)) {
        return false; // or handle the error as needed
    }

    // Prepare the SQL query

    $query = "SELECT * FROM $table ORDER BY created_at DESC LIMIT $limit OFFSET $offset";


    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    } else {
        return false;
    }
}


function get_data_by_where_and_limit($table, $key, $value, $limit, $offset)
{
    global $conn;

    $query = "SELECT * FROM $table WHERE $key = '$value' LIMIT $limit OFFSET $offset";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    } else {
        return false;
    }
}

function render_pagination($page, $total_pages)
{
    echo '<nav aria-label="Page navigation example">';
    echo '<ul class="pagination justify-content-center">';

    // Previous button
    if ($page > 1) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
    } else {
        echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a></li>';
    }

    // Page number buttons
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }
    }

    // Next button
    if ($page < $total_pages) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
    } else {
        echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Next</a></li>';
    }

    echo '</ul>';
    echo '</nav>';
}




function get_total_rows($table)
{
    global $conn;

    $query = "SELECT COUNT(*) AS total FROM $table";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    return $row['total'];
}



function create_slug($string)
{
    $slug = strtolower($string);

    $slug = str_replace(' ', '-', $slug);

    $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);

    $slug = preg_replace('/-+/', '-', $slug);


    $slug = trim($slug, '-');

    return $slug;
}
function update_data($table, $data, $data_key, $data_value)
{
    global $conn;

    $update_values = array();
    foreach ($data as $key => $value) {
        $update_values[] = "$key = '" . mysqli_real_escape_string($conn, $value) . "'";
    }

    $update_string = implode(", ", $update_values);
    $data_value = mysqli_real_escape_string($conn, $data_value);

    $query = "UPDATE $table SET $update_string WHERE $data_key = '$data_value'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        return false;
    } else {
        return true;
    }
}


function validate_slug($slug)
{
    if (isset($_GET[$slug]) && !empty($_GET[$slug])) {
        return $_GET[$slug];
    } else {
        return false;
    }
}

function get_single_data_array($table, $key, $value)
{
    global $conn;

    $value = mysqli_real_escape_string($conn, $value);

    $query = "SELECT * FROM $table WHERE $key = '$value'";
    $result = mysqli_query($conn, $query);

    if (!$result || mysqli_num_rows($result) === 0) {
        return null;
    } else {
        $data = mysqli_fetch_assoc($result);
        return $data;
    }
}

function delete_data($table, $key, $value)
{
    global $conn;

    $value = mysqli_real_escape_string($conn, $value);

    $query = "DELETE FROM $table WHERE $key = '$value'";
    $result = mysqli_query($conn, $query);

    if (!$result || mysqli_affected_rows($conn) === 0) {
        return false;
    } else {
        return true;
    }
}

function get_data_validate($data, $url)
{
    if (!$data) {
        redirect_error($url);
    }

    return isset($data) && !empty($data);
}

function validate_has_data($data, $url, $message)
{
    if (!$data) {
        redirect($url, $message);
    }

    return isset($data) && !empty($data);
}

function redirect_error($url)
{
    header("Location:" . $url);
    exit();
}

function create_or_update($table, $data)
{
    global $conn;

    foreach ($data as $key => $value) {
        $data[$key] = mysqli_real_escape_string($conn, $value);
    }

    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";

    $update_clauses = [];
    foreach ($data as $key => $value) {
        if ($key != 'id' && $key != 'created_at') {
            $update_clauses[] = "$key = VALUES($key)";
        }
    }
    $update_clause = implode(", ", $update_clauses);

    $query = "INSERT INTO $table ($columns) VALUES ($values) ON DUPLICATE KEY UPDATE $update_clause";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function timeAgo($time)
{
    $createdTimestamp = strtotime($time);

    $currentTimestamp = time();

    $timeDifference = $currentTimestamp - $createdTimestamp;

    if ($timeDifference < 60) {
        $timeAgo = $timeDifference . ' seconds ago';
    } elseif ($timeDifference < 3600) {
        $minutes = floor($timeDifference / 60);
        $timeAgo = $minutes . ' mins ago';
    } elseif ($timeDifference < 86400) {
        $hours = floor($timeDifference / 3600);
        $timeAgo = $hours . ' hours ago';
    } else {
        $days = floor($timeDifference / 86400);
        $timeAgo = $days . ' days ago';
    }

    return $timeAgo;
}

function get_single_data($tables, $columns, $join_conditions, $where_condition)
{
    global $conn;
    $select_clause = implode(", ", $columns);
    $join_clauses = "";

    for ($i = 1; $i < count($tables); $i++) {
        $table = explode('|', $tables[$i]);
        $join_clauses .= " JOIN " . $table[0] . " AS " . $table[1] . " ON " . $join_conditions[$i - 1];
    }

    $query = "SELECT $select_clause FROM " . explode('|', $tables[0])[0] . " AS " . explode('|', $tables[0])[1] . $join_clauses . " WHERE " . $where_condition;

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query Failed: ' . mysqli_error($conn));
    }

    $data = mysqli_fetch_assoc($result);

    return $data;
}

function get_posts_by_id($table1, $table2)
{
    global $conn;

    // Ensure the table names are safe to use in the query
    $table1 = mysqli_real_escape_string($conn, $table1);
    $table2 = mysqli_real_escape_string($conn, $table2);

    // Query to retrieve data
    $query = "SELECT $table1.*
              FROM $table1
              INNER JOIN $table2 ON $table1.id = $table2.post_id";

    // Perform the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Fetch data from the result set
    $posts = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }

    // Free the result set
    mysqli_free_result($result);

    return $posts;
}

function count_post($category)
{
    global $conn;

    $category = mysqli_real_escape_string($conn, $category);

    // SQL query to count posts in the specified category
    $query = "SELECT COUNT(*) AS total_posts FROM posts WHERE category = '$category'";
    $result = mysqli_query($conn, $query);

    // Initialize the post count
    $postCount = 0;

    // Check if the query was successful
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $postCount = $row['total_posts'];
    }

    return $postCount;
}

function search_posts($search)
{
    global $conn;

    $search = mysqli_real_escape_string($conn, $search);

    // Prepare the SQL statement
    $query = "SELECT post_title, post_body, post_slug, category, post_image, created_at 
              FROM posts 
              WHERE post_title LIKE '%$search%' 
              OR post_body LIKE '%$search%' 
              OR category LIKE '%$search%'
              ORDER BY created_at DESC";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    } else {
        return false;
    }
}

function checkDataExists($table, $conditions)
{
    global $conn;

    $query = "SELECT COUNT(*) AS count FROM $table WHERE $conditions";

    $result = mysqli_query($conn, $query);

    if ($result) {

        $row = mysqli_fetch_assoc($result);

        $count = $row['count'];

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function count_table($table)
{
    global $conn;

    // Escape the table name to prevent SQL injection
    $table = mysqli_real_escape_string($conn, $table);

    // Construct the SQL query to count rows in the specified table
    $query = "SELECT COUNT(*) AS total_count FROM `$table`";
    $result = mysqli_query($conn, $query);

    // Initialize the post count
    $postCount = 0;

    // Check if the query was successful
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $postCount = $row['total_count'];
    }

    return $postCount;
}
function generateRandomString($length = 60)
{
    // Define the characters to be used in the string
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    // Loop through and append random characters to the string
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

function exist_data($table, $key, $value)
{
    global $conn;
    $value = mysqli_real_escape_string($conn, $value);
    $query = "SELECT * FROM `$table` WHERE `$key` = '$value'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function delete_token()
{
    global $conn;
    //For Debuging
    // $deleteSql = "DELETE FROM password_reset_token WHERE created_at < NOW() - INTERVAL 20 SECOND";

    $deleteSql = "DELETE FROM password_reset_token WHERE created_at < NOW() - INTERVAL 2 MINUTE";
    if ($conn->query($deleteSql)) {
        return true;
    } else {
        return false;
    }
}

function reset_token_delete($email)
{
    global $conn;
    $deleteSql = "DELETE FROM password_reset_token WHERE `email` = '$email'";
    if ($conn->query($deleteSql)) {
        return true;
    } else {
        return false;
    }
}

function show_comment($post_id)
{
    global $conn;
    $sql = "SELECT c.id as comment_id,c.comment,c.user_id as comment_user_id, c.created_at, u.name as user_name, ui.profile_image, p.id as post_id FROM comments c JOIN users u ON c.user_id = u.id JOIN users_info ui ON u.id = ui.user_id JOIN posts p ON c.post_id = p.id WHERE c.post_id = '$post_id' ORDER BY c.created_at ASC";

    $result = $conn->query($sql);
    $comments = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
    }
    return $comments;
}
