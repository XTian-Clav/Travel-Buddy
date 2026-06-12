<?php

declare(strict_types=1);

function get_username_for_update(PDO $pdo, string $username, int $current_user_id): array|false {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username AND id != :user_id");
    $stmt->execute([":username" => $username, ":user_id" => $current_user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_email_for_update(PDO $pdo, string $email, int $current_user_id): array|false {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email AND id != :user_id");
    $stmt->execute([":email" => $email, ":user_id" => $current_user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_contact_for_update(PDO $pdo, string $contact, int $current_user_id): array|false {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE contact = :contact AND id != :user_id");
    $stmt->execute([":contact" => $contact, ":user_id" => $current_user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_user_trips(PDO $pdo, int $user_id): array {
    $query = "
        SELECT * FROM saved_trips
        WHERE user_id = :user_id
        ORDER BY created_at DESC
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([":user_id" => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_trip_by_id(PDO $pdo, int $trip_id, int $user_id): array|false {
    $query = "
        SELECT * FROM saved_trips
        WHERE id = :trip_id AND user_id = :user_id
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ":trip_id" => $trip_id,
        ":user_id" => $user_id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_trip_activities(PDO $pdo, int $trip_id): array {
    $query = "
        SELECT * FROM trip_activities 
        WHERE trip_id = :trip_id 
        ORDER BY day_number ASC, id ASC
    ";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute([":trip_id" => $trip_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function delete_trip(PDO $pdo, int $trip_id, int $user_id): void {
    $query = "
        DELETE FROM saved_trips
        WHERE id = :trip_id AND user_id = :user_id
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ":trip_id" => $trip_id,
        ":user_id" => $user_id
    ]);
}

function update_user_profile(PDO $pdo, int $user_id, string $username, string $email, string $contact, string $address): void {
    $query = "
        UPDATE users 
        SET username = :username, email = :email, contact = :contact, address = :address 
        WHERE id = :user_id
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ":username" => $username,
        ":email"    => $email,
        ":contact"  => $contact,
        ":address"  => $address,
        ":user_id"  => $user_id
    ]);
}