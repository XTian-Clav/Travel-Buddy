<?php

declare(strict_types=1);

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