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

function is_update_input_empty(string $username, string $email, string $contact, string $address): bool {
    if (empty($username) || empty($email) || empty($contact) || empty($address)) {
        return true;
    }
    return false;
}

function is_update_username_invalid(string $username): bool {
    if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
        return true;
    }
    if (strlen($username) < 3) {
        return true;
    }
    return false;
}

function is_email_invalid(string $email): bool {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

function is_update_contact_invalid(string $contact): bool {
    return !preg_match('/^09\d{9}$/', str_replace([' ', '-'], '', $contact));
}

function is_username_taken_for_update(PDO $pdo, string $username, int $current_user_id): bool {
    return (bool)get_username_for_update($pdo, $username, $current_user_id);
}

function is_email_taken_for_update(PDO $pdo, string $email, int $current_user_id): bool {
    return (bool)get_email_for_update($pdo, $email, $current_user_id);
}

function is_contact_taken_for_update(PDO $pdo, string $contact, int $current_user_id): bool {
    return (bool)get_contact_for_update($pdo, $contact, $current_user_id);
}