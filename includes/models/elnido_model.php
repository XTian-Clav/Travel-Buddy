<?php
declare(strict_types=1);

function set_saved_trip(PDO $pdo, int $user_id, string $itinerary_name, string $destination, string $start_date, string $end_date, int $travelers, int $total_days, int $total_activities, float $estimated_budget) {
    $query = "
        INSERT INTO saved_trips
        (
            user_id,
            trip_type,
            itinerary_name,
            destination,
            start_date,
            end_date,
            travelers,
            total_days,
            total_activities,
            estimated_budget
        )
        VALUES
        (
            :user_id,
            'predefined',
            :itinerary_name,
            :destination,
            :start_date,
            :end_date,
            :travelers,
            :total_days,
            :total_activities,
            :estimated_budget
        );
    ";

    $stmt = $pdo->prepare($query);

    $stmt->execute([
        ":user_id"          => $user_id,
        ":itinerary_name"   => $itinerary_name,
        ":destination"      => $destination,
        ":start_date"       => $start_date,
        ":end_date"         => $end_date,
        ":travelers"        => $travelers,
        ":total_days"       => $total_days,
        ":total_activities" => $total_activities,
        ":estimated_budget" => $estimated_budget
    ]);

    return (int)$pdo->lastInsertId();
}

function set_trip_activity(PDO $pdo, int $trip_id, int $day_number, string $time_period, string $activity_name) {
    $query = "
        INSERT INTO trip_activities
        (
            trip_id,
            day_number,
            time_period,
            activity_name
        )
        VALUES
        (
            :trip_id,
            :day_number,
            :time_period,
            :activity_name
        );
    ";

    $stmt = $pdo->prepare($query);

    $stmt->execute([
        ":trip_id"       => $trip_id,
        ":day_number"    => $day_number,
        ":time_period"   => $time_period,
        ":activity_name" => $activity_name
    ]);
}

function create_elnido_trip(PDO $pdo, int $user_id, array $packageData, string $destination, string $start_date, string $end_date, int $travelers, int $total_days): void {
    $activities = $packageData["activities"] ?? [];
    $total_activities = count($activities);
    $estimated_budget = (float)($packageData["budget"] ?? 0);
    $itinerary_name = $packageData["name"] ?? "elnido Trip";

    $trip_id = set_saved_trip(
        $pdo,
        $user_id,
        $itinerary_name,
        $destination,
        $start_date,
        $end_date,
        $travelers,
        $total_days,
        $total_activities,
        $estimated_budget
    );

    foreach ($activities as $activity) {
        set_trip_activity(
            $pdo,
            $trip_id,
            (int)$activity["day"],
            $activity["period"],
            $activity["name"]
        );
    }
}

function get_elnido_package_data(string $package_key): array {
    switch ($package_key) {
        case 'elnido_package_a':
            return [
                "name" => "Elnido - Package A",
                "budget" => 4000,
                "activities" => [
                    ["day"=>1,"period"=>"Morning","name"=>"Breakfast at resort"],
                    ["day"=>1,"period"=>"Morning","name"=>"Visit Nacpan Beach"],
                    ["day"=>1,"period"=>"Morning","name"=>"Relax / Swimming"],
                    ["day"=>1,"period"=>"Afternoon","name"=>"Lunch at beachfront cafe"],
                    ["day"=>1,"period"=>"Afternoon","name"=>"Visit Las Cabanas Beach"],
                    ["day"=>1,"period"=>"Evening","name"=>"Spa / Massage Session"],
                    ["day"=>1,"period"=>"Evening","name"=>"Sunset Dinner"],
                ]
            ];

        case 'elnido_package_b':
            return [
                "name" => "Elnido - Package B",
                "budget" => 7500,
                "activities" => [
                    ["day"=>1,"period"=>"Morning","name"=>"Breakfast at resort"],
                    ["day"=>1,"period"=>"Morning","name"=>"Kayaking at Big Lagoon"],
                    ["day"=>1,"period"=>"Morning","name"=>"Snorkeling session"],
                    ["day"=>1,"period"=>"Afternoon","name"=>"Seafood lunch"],
                    ["day"=>1,"period"=>"Afternoon","name"=>"Visit Shimizu Island"],
                    ["day"=>1,"period"=>"Evening","name"=>"Night market visit"],
                    ["day"=>1,"period"=>"Evening","name"=>"Beachfront dinner"],
                ]
            ];

        case 'elnido_package_c':
            return [
                "name" => "Elnido - Package C",
                "budget" => 16000,
                "activities" => [
                    ["day"=>1,"period"=>"Morning","name"=>"Breakfast at luxury resort"],
                    ["day"=>1,"period"=>"Morning","name"=>"Private boat island tour"],
                    ["day"=>1,"period"=>"Morning","name"=>"Island photography tour"],
                    ["day"=>1,"period"=>"Afternoon","name"=>"Luxury beachfront lunch"],
                    ["day"=>1,"period"=>"Afternoon","name"=>"Snorkeling in exclusive spots"],
                    ["day"=>1,"period"=>"Evening","name"=>"Couples massage"],
                    ["day"=>1,"period"=>"Evening","name"=>"Fine dining sunset dinner"],
                ]
            ];

        default:
            return [];
    }
}