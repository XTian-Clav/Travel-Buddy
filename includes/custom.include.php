<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    die();
}

require_once 'config.php';
require_once 'db_handler.php';
require_once 'models/custom_model.php';
require_once 'views/custom_view.php';
require_once 'controller/custom_controller.php';

try {
    $itinerary_name = trim($_POST["itinerary_name"] ?? '');
    $destination = trim($_POST["destination"] ?? '');
    $start_date = trim($_POST["start_date"] ?? '');
    $end_date = trim($_POST["end_date"] ?? '');
    $travelers = (int)($_POST["travelers"] ?? 0);
    $activities = is_array($_POST["activities"] ?? null) ? $_POST["activities"] : [];

    $errors = [];

    if (is_custom_input_empty($itinerary_name, $destination, $start_date, $end_date)) {
        $errors["empty_input"] = "Fill in all required fields.";
    }
    if (is_date_range_invalid($start_date, $end_date)) {
        $errors["invalid_dates"] = "End date cannot be earlier than start date.";
    }
    if (empty($activities)) {
        $errors["activities"] = "Please select at least one activity.";
    }

    if ($errors) {
        $_SESSION["errors_custom"] = $errors;
        header("Location: ../custom-itinerary.php");
        die();
    }

    $totalDays = calculate_total_days($start_date, $end_date);
    $tripData = calculate_trip_summary($activities, $travelers);

    create_custom_trip(
        $pdo,
        (int)($_SESSION["user_id"] ?? 0),
        $itinerary_name,
        $destination,
        $start_date,
        $end_date,
        $travelers,
        $totalDays,
        $tripData["total_activities"],
        $tripData["estimated_budget"],
        $activities
    );

    header("Location: ../profile.php?saved=success");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}