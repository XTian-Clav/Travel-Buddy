<?php

declare(strict_types=1);

function has_no_trips(array $trips): bool {
    return empty($trips);
}

function is_valid_trip_id(mixed $trip_id): bool {
    return isset($trip_id) && is_numeric($trip_id) && (int) $trip_id > 0;
}

function is_trip_owner(array|false $trip): bool {
    return !empty($trip);
}

function handle_delete_trip(PDO $pdo, int $trip_id, int $user_id): void {
    $trip = get_trip_by_id($pdo, $trip_id, $user_id);

    if (!is_trip_owner($trip)) {
        $_SESSION["errors_profile"] = ["You do not have permission to delete this trip."];
        header("Location: profile.php");
        die();
    }

    delete_trip($pdo, $trip_id, $user_id);
    header("Location: profile.php?deleted=success");
    die();
}