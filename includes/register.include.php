<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $confirm_pwd = $_POST["confirm_pwd"] ?? "";
    $email = $_POST["email"];

    try {
        require_once 'db_handler.php';
        require_once 'models/register_model.php';
        require_once 'views/register_view.php';
        require_once 'controller/register_controller.php';

        //ERROR HANDLERS
        $errors = [];

        if (is_input_empty($username, $pwd, $email)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid email used!";
        }
        if (is_username_invalid($username)) {
            $errors["invalid_username"] = "Username must be alphanumeric and at least 3 characters long.";
        }
        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already taken!";
        }
        if (is_password_weak($pwd)) {
            $errors["weak_password"] = "Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, and a number.";
        }
        if (is_password_match($pwd, $confirm_pwd)) {
            $errors["password_mismatch"] = "Passwords do not match!";
        }
        if (is_email_taken($pdo, $email)) {
            $errors["email_taken"] = "Email already used!";
        }

        require_once 'config.php';

        if ($errors) {
            $_SESSION["errors_register"] = $errors;

            $registerData = [
                "username" => $username,
                "email" => $email,
            ];
            $_SESSION["register_data"] = $registerData;

            header("Location: ../register.php");
            die();
        }

        create_user($pdo, $pwd, $username, $email);

        header("Location: ../login.php?register=success");

        $pdo = null;
        $stmt = null;
        
        die();


    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}