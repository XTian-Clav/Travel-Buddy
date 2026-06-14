<?php
declare(strict_types=1);

function set_custom_trip(PDO $pdo, int $user_id, string $name, string $dest, string $start, string $end, int $travelers, int $days, int $activities, float $budget): int {
    $query = "
        INSERT INTO saved_trips (user_id, trip_type, itinerary_name, destination, start_date, end_date, travelers, total_days, total_activities, estimated_budget)
        VALUES (:user_id, 'custom', :itinerary_name, :destination, :start_date, :end_date, :travelers, :total_days, :total_activities, :estimated_budget);
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':user_id' => $user_id,
        ':itinerary_name' => $name,
        ':destination' => $dest,
        ':start_date' => $start,
        ':end_date' => $end,
        ':travelers' => $travelers,
        ':total_days' => $days,
        ':total_activities' => $activities,
        ':estimated_budget' => $budget
    ]);

    return (int)$pdo->lastInsertId();
}
function create_custom_trip(PDO $pdo, int $user_id, string $name, string $dest, string $start, string $end, int $travelers, int $days, int $total_activities, float $budget, array $activities) {
    $tripId = set_custom_trip($pdo, $user_id, $name, $dest, $start, $end, $travelers, $days, $total_activities, $budget);

    $query = "
        INSERT INTO trip_activities (trip_id, day_number, activity_name, activity_price)
        VALUES (:trip_id, :day_number, :activity_name, :activity_price);
    ";
    $stmt = $pdo->prepare($query);

    foreach ($activities as $dayKey => $dayActivities) {
        if (!is_array($dayActivities)) {
            continue;
        }

        $dayNumber = (int)str_replace("day_", "", $dayKey);

        foreach ($dayActivities as $activityId) {
            $activity = get_activity_data($activityId);
            
            if ($activity['price'] === 0) {
                continue;
            }

            $stmt->execute([
                ':trip_id'        => $tripId,
                ':day_number'     => $dayNumber,
                ':activity_name'  => $activity['name'],
                ':activity_price' => $activity['price']
            ]);
        }
    }
}