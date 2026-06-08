<?php

require_once 'config.php';
require_once 'db_handler.php';
require_once 'models/profile_model.php';
require_once 'views/profile_view.php';
require_once 'controller/profile_controller.php';

$userId = (int)($_SESSION["user_id"] ?? 0);
$trips = get_user_trips($pdo, $userId);

if (isset($_GET["action"]) && $_GET["action"] === "delete") {
    if (!is_valid_trip_id($_GET["trip_id"] ?? null)) {
        header("Location: profile.php");
        die();
    }

    handle_delete_trip($pdo, (int)$_GET["trip_id"], $userId);
}