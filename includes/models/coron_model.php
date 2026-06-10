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

function create_coron_trip(PDO $pdo, int $user_id, array $packageData, string $destination, string $start_date, string $end_date, int $travelers, int $total_days): void {
    $activities = $packageData["activities"] ?? [];
    $total_activities = count($activities);
    $estimated_budget = (float)($packageData["budget"] ?? 0);
    $itinerary_name = $packageData["name"] ?? "Coron Trip";

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

function get_coron_package_data(string $package_key): array {
    switch ($package_key) {
        case 'coron_package_a':
            return [
                "name" => "Coron - Package A",
                "budget" => 4000,
                "activities" => [
                    ["day"=>1,"period"=>"Morning","name"=>"Souvenir shopping downtown"],
                    ["day"=>1,"period"=>"Morning","name"=>"Visit Lualhati Park"],
                    ["day"=>1,"period"=>"Morning","name"=>"Cashew nut factory stopover"],
                    ["day"=>1,"period"=>"Afternoon","name"=>"Trek up Mt. Tapyas viewdeck"],
                    ["day"=>1,"period"=>"Afternoon","name"=>"Soak in Maquinit Hot Springs"],
                    ["day"=>1,"period"=>"Evening","name"=>"Local seafood grill dinner"],
                    ["day"=>1,"period"=>"Evening","name"=>"Relax at town center café"],
                ]
            ];

        case 'coron_package_b':
            return [
                "name" => "Coron - Package B",
                "budget" => 7500,
                "activities" => [
                    ["day"=>1,"period"=>"Morning","name"=>"Swim at Kayangan Lake"],
                    ["day"=>1,"period"=>"Morning","name"=>"Snorkeling at Twin Peaks Reef"],
                    ["day"=>1,"period"=>"Morning","name"=>"Explore Barracuda Lake"],
                    ["day"=>1,"period"=>"Afternoon","name"=>"Buffet lunch at Atwayan Beach"],
                    ["day"=>1,"period"=>"Afternoon","name"=>"Relaxing kayak at Twin Lagoons"],
                    ["day"=>1,"period"=>"Evening","name"=>"Cocktails by the bay"],
                    ["day"=>1,"period"=>"Evening","name"=>"Wood-fired pizza dinner"],
                ]
            ];

        case 'coron_package_c':
            return [
                "name" => "Coron - Package C",
                "budget" => 16000,
                "activities" => [
                    ["day"=>1,"period"=>"Morning","name"=>"Snorkel Skeleton Wreck"],
                    ["day"=>1,"period"=>"Morning","name"=>"Coral Garden marine exploration"],
                    ["day"=>1,"period"=>"Morning","name"=>"Private speedboat navigation"],
                    ["day"=>1,"period"=>"Afternoon","name"=>"Gourmet lunch at Pass Island"],
                    ["day"=>1,"period"=>"Afternoon","name"=>"Lusong Gunboat dive exploration"],
                    ["day"=>1,"period"=>"Evening","name"=>"Premium resort massage therapy"],
                    ["day"=>1,"period"=>"Evening","name"=>"Fine dining hillside dinner"],
                ]
            ];

        default:
            return [];
    }
}