<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    die();
}

require_once 'config.php';
require_once 'db_handler.php';
require_once 'models/login_model.php';
require_once 'views/login_view.php';
require_once 'controller/login_controller.php';

try {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    $errors = [];

    if (is_input_empty($username, $pwd)) {
        $errors["empty_input"] = "Fill in all fields!";
    }

    $result = get_user($pdo, $username);

    if (!$errors && is_username_wrong($result)) {
        $errors["login_incorrect"] = "Incorrect login info!";
    }

    if (!$errors && is_password_wrong($pwd, $result["pwd"])) {
        $errors["login_incorrect"] = "Incorrect login info!";
    }

    if ($errors) {
        $_SESSION["errors_login"] = $errors;
        header("Location: ../login.php");
        die();
    }

    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $result["id"];
    session_id($sessionId);

    $_SESSION["user_id"] = $result["id"];
    $_SESSION["user_username"] = htmlspecialchars($result["username"]);
    $_SESSION["user_email"] = htmlspecialchars($result["email"]);
    $_SESSION["user_contact"] = htmlspecialchars($result["contact"]);
    $_SESSION["user_address"] = htmlspecialchars($result["address"]);

    $_SESSION["last_regeneration"] = time();

    $pdo = null;
    $stmt = null;

    header("Location: ../home.php?login=success");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}