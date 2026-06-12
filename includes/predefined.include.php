<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    die();
}

require_once 'config.php';
require_once 'db_handler.php';
require_once 'models/predefined_model.php';
require_once 'views/predefined_view.php';
require_once 'controller/predefined_controller.php';

try {

    $package_key = trim($_POST["package_key"] ?? '');
    $destination = trim($_POST["destination"] ?? '');
    $start_date = trim($_POST["start_date"] ?? '');
    $end_date = trim($_POST["end_date"] ?? '');
    $travelers = (int)($_POST["travelers"] ?? 0);

    $errors = [];

    if (is_predefined_input_empty($package_key, $start_date, $end_date)) {
        $errors["empty_input"] = "Please complete all fields.";
    }

    if (is_date_range_invalid($start_date, $end_date)) {
        $errors["invalid_dates"] = "End date cannot be earlier than start date.";
    }

    if ($travelers < 1) {
        $errors["travelers"] = "At least one traveler is required.";
    }

    if ($errors) {
        $_SESSION["errors_predefined"] = $errors;
        header("Location: ../home.php");
        die();
    }

    $totalDays = calculate_total_days($start_date, $end_date);
    $packageData = get_predefined_package_data($package_key);

    create_predefined_trip(
        $pdo,
        (int)$_SESSION["user_id"],
        $packageData,
        $destination,
        $start_date,
        $end_date,
        $travelers,
        $totalDays
    );

    header("Location: ../profile.php?saved=success");
    die();

} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}