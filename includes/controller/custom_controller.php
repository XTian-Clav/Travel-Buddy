<?php
declare(strict_types=1);

function get_activity_data(string $id): array {
    $activities = [
        //Elnido
        "kayaking"         => ["name" => "Kayaking", "price" => 1500],
        "beach-day"        => ["name" => "Beach Day Out", "price" => 2000],
        "snorkeling"       => ["name" => "Private Snorkeling", "price" => 3800],
        "sunset-dinner"    => ["name" => "Sunset Dinner", "price" => 1200],
        "island-hopping"   => ["name" => "Island Hopping Tour", "price" => 2800],
        "spa"              => ["name" => "Spa & Massage", "price" => 1500],

        //Coron
        "mt-tapyas"        => ["name" => "Mount Tapyas Viewpoint", "price" => 1600],
        "beach-day-coron"  => ["name" => "Beach Day Out (Malcapuya)", "price" => 2000],
        "banana-island"    => ["name" => "Banana Island", "price" => 2650],
        "smith-beach"      => ["name" => "Sunset at Smith Beach", "price" => 800],
        "calauit-safari"   => ["name" => "Calauit Safari Park", "price" => 2500],
        "maquinit-hotspring" => ["name" => "Maquinit Hot Spring", "price" => 1000],
    ];

    return $activities[$id] ?? ["name" => "Unknown Activity", "price" => 0];
}

function is_custom_input_empty(string ...$fields): bool {
    foreach ($fields as $field) {
        if (empty($field)) {
            return true;
        }
    }
    return false;
}

function is_date_range_invalid(string $start, string $end): bool {
    return strtotime($end) < strtotime($start);
}

function calculate_total_days(string $start, string $end): int {
    return (new DateTime($start))->diff(new DateTime($end))->days + 1;
}

function calculate_trip_summary(array $activities, int $travelers): array {
    $totalActivities = 0;
    $budget = 0;

    foreach ($activities as $dayActivities) {
        if (!is_array($dayActivities)) {
            continue;
        }
        foreach ($dayActivities as $activityId) {
            $activity = get_activity_data($activityId);
            
            // Guard clause: skip invalid/unknown activities
            if ($activity['price'] === 0) {
                continue;
            }

            $totalActivities++;
            $budget += $activity['price'] * $travelers;
        }
    }

    return [
        "total_activities" => $totalActivities, 
        "estimated_budget" => (float)$budget
    ];
}