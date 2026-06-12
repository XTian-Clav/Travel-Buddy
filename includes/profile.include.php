<?php

require_once 'config.php';
require_once 'db_handler.php';
require_once 'models/profile_model.php';
require_once 'views/profile_view.php';
require_once 'controller/profile_controller.php';

$userId = (int)($_SESSION["user_id"] ?? 0);

if (isset($_GET["action"]) && $_GET["action"] === "get_details") {
    header('Content-Type: application/json');
    $tripId = (int)($_GET["trip_id"] ?? 0);

    if ($userId <= 0 || $tripId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid structural request parameters.']);
        die();
    }

    $trip = get_trip_by_id($pdo, $tripId, $userId);
    if (!$trip) {
        echo json_encode(['success' => false, 'message' => 'Resource records not found or access denied.']);
        die();
    }

    $activities = get_trip_activities($pdo, $tripId);
    output_trip_details_json($trip, $activities);
    die();
}

$trips = get_user_trips($pdo, $userId);

if (isset($_GET["action"]) && $_GET["action"] === "delete") {
    if (!is_valid_trip_id($_GET["trip_id"] ?? null)) {
        header("Location: profile.php");
        die();
    }

    handle_delete_trip($pdo, (int)$_GET["trip_id"], $userId);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $address = $_POST["address"];

        $errors = [];

        if (is_update_input_empty($username, $email, $contact, $address)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_update_username_invalid($username)) {
            $errors["invalid_username"] = "Username must be alphanumeric and at least 3 characters long.";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid email used!";
        }
        if (is_update_contact_invalid($contact)) {
            $errors["invalid_contact"] = "Invalid contact number. Please use a valid 11-digit Philippine mobile number (e.g., 09171234567).";
        }

        if (is_username_taken_for_update($pdo, $username, $userId)) {
            $errors["username_taken"] = "Username is already taken.";
        }
        if (is_email_taken_for_update($pdo, $email, $userId)) {
            $errors["email_taken"] = "Email address is already in use.";
        }
        if (is_contact_taken_for_update($pdo, $contact, $userId)) {
            $errors["contact_taken"] = "Contact number is already in use.";
        }

        if ($errors) {
            $_SESSION["errors_profile"] = $errors;
            header("Location: profile.php");
            die();
        }

        update_user_profile($pdo, $userId, $username, $email, $contact, $address);

        $_SESSION["user_username"] = $username;
        $_SESSION["user_email"] = $email;
        $_SESSION["user_contact"] = $contact;
        $_SESSION["user_address"] = $address;

        $pdo = null;
        $stmt = null;

        header("Location: profile.php?update=success");
        die();
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}