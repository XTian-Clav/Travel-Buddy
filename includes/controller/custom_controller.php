<?php
declare(strict_types=1);

function get_activity_prices(): array {
    return [
        "kayaking" => 1500,
        "beach-day" => 2000,
        "snorkeling" => 3800,
        "sunset-dinner" => 1200,
        "island-hopping" => 2800,
        "spa" => 1500,
    ];
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
    $prices = get_activity_prices();
    $totalActivities = 0;
    $budget = 0;

    foreach ($activities as $dayActivities) {
        if (!is_array($dayActivities)) {
            continue;
        }
        foreach ($dayActivities as $activity) {
            if (isset($prices[$activity])) {
                $totalActivities++;
                $budget += $prices[$activity] * $travelers;
            }
        }
    }

    return [
        "total_activities" => $totalActivities, 
        "estimated_budget" => (float)$budget
    ];
}