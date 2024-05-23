<?php
require_once "../config/functions.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

if (isset($_REQUEST["registrationBtn"])) {
    if (($_REQUEST['name'] == '') || ($_REQUEST['email'] == '') || ($_REQUEST['password'] == '')) {
        redirect("../signup.php", "All fields are required.");
    } else {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if (email_exists($email)) {
            redirect("../signup.php", "Email address already exists.");
        } else {
            $data = [
                "name" => $name,
                "email" => $email,
                "password" => $hashed_password,
            ];
            if (insert_data("users", $data)) {
                $user_id = mysqli_insert_id($conn);
                authenticate_user($user_id, $name, $email);
                header("Location: ../index.php");
                exit();
            } else {
                redirect("../signup.php", "Error occurred during registration. Please try again.");
            }
        }
    }
}



if (isset($_REQUEST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    auth_user($email, $password);
}

if (isset($_REQUEST["change_password"])) {
    if (($_REQUEST['current_password'] == '') || ($_REQUEST['new_password'] == '') || ($_REQUEST['password3'] == '')) {
        redirect("../change-password.php", "All fields are required.");
    } else {
        $user_id = $_POST["user_id"];
        $current_password = $_POST["current_password"];
        $new_password = $_POST["new_password"];
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "SELECT * FROM users WHERE id='$user_id'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($current_password, $user["password"])) {
                $data = [
                    "password" => $hashed_password
                ];
                if (update_data("users", $data, "id", $user_id)) {
                    redirect("../index.php", "Password Changed successfully.");
                } else {
                    redirect("../change-password.php", "All fields are required.");
                }
            }
        }
    }
}

if (isset($_REQUEST["send_reset_mail"])) {
    if (($_REQUEST['email'] == '')) {
        redirect("../forget-password.php", "The Email field is required.");
    } else {
        $email = $_POST['email'];
        $result =  exist_data('password_reset_token', 'email', $email);

        if ($result === false) {
            $user = get_single_data_array('users', 'email', $email);
            if (email_exists($email)) {
                $mail = new PHPMailer(true);
                $token = generateRandomString();
                $data = [
                    'email' => $email,
                    'token' => $token,
                ];

                $html = '<!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Forgot Password</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                background-color: #f4f4f4;
                                color: #333;
                                margin: 0;
                                padding: 0;
                            }
                            .container {
                                width: 100%;
                                max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                background-color: #ffffff;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            }
                            .header {
                                text-align: center;
                                padding: 10px 0;
                                background-color: #FF574A;
                                color: #ffffff;
                            }
                            .content {
                                padding: 20px;
                                line-height: 1.6;
                            }
                            .footer {
                                text-align: center;
                                padding: 10px;
                                font-size: 12px;
                                color: #777;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <div class="header">
                                <h1>Reset Your Password</h1>
                            </div>
                            <div class="content">
                                <p>Hello ' . $user['name'] . ',</p>
                                <p>You recently requested to reset your password for your account. Click the button below to reset it.</p>
                                <p><a href="http://localhost/blogtd/reset-password.php?token=' . $token . '">Reset Password</a></p>
                                <p>If you did not request a password reset, please ignore this email or contact support if you have questions.</p>
                                <p>Thank you,<br>Sumon</p>
                            </div>
                            <div class="footer">
                                <p>&copy; 2024 Sumon. All rights reserved.</p>
                            </div>
                        </div>
                    </body>
                    </html>';
                try {
                    $getenv = parse_ini_file('../config/.env');
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = $getenv['MAIL_HOST'];                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $getenv['MAIL_USERNAME'];
                    $mail->Password   = $getenv['MAIL_PASSWORD'];
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //TSL
                    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //SSL
                    $mail->Port       = $getenv['MAIL_PORT'];

                    //Recipients
                    $mail->setFrom('sumon23746@gmail.com', 'Sumon');
                    $mail->addAddress($email);


                    $mail->isHTML(true);
                    $mail->Subject = 'Reset Password Mail - Sumon';
                    $mail->Body    = $html;
                    if ($mail->send()) {
                        if (insert_data('password_reset_token', $data)) {
                            redirect("../login.php", "Message has been sent.");
                        }
                    }
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                redirect("../login.php", "Email address dosen't exists.");
            }
        } else {
            redirect("../forget-password.php", " Your reset mail already sent.");
        }
    }
}


if (isset($_REQUEST["confirm_password"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    if (($_REQUEST['password'] == '') || ($_REQUEST['password2'] == '')) {
        redirect("../confirm-password.php", "All fields are required.");
    } else {
        $data = [
            'password' => $hashed_password
        ];
        if (update_data('users', $data, 'email', $email)) {
            reset_token_delete($email);
            redirect("../login.php", "Your password has been changed.");
        } else {
            redirect("../login.php", "Problem occurred.");
        }
    }
}
