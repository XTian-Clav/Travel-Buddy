<?php

declare(strict_types=1);

function output_trip_image(string $destination): string {
    $map = [
        "El Nido" => "big-lagoon.webp",
        "Coron"   => "coron.webp",
    ];

    return "assets/" . ($map[$destination] ?? "big-lagoon.webp");
}

function output_trip_details_json(array $trip, array $activities): void {
  echo json_encode([
      'success' => true,
      'trip' => [
          'itinerary_name'   => $trip['itinerary_name'],
          'destination'      => $trip['destination'],
          'total_days'       => $trip['total_days'],
          'total_activities' => $trip['total_activities'],
          'estimated_budget' => $trip['estimated_budget'],
          'start_date'       => $trip['start_date'] ? date("M d, Y", strtotime($trip['start_date'])) : 'Flexible',
          'end_date'         => $trip['end_date'] ? date("M d, Y", strtotime($trip['end_date'])) : 'Flexible',
          'travelers'        => $trip['travelers'] ?? 1,
          'trip_type'        => ucfirst($trip['trip_type']),
          'image'            => output_trip_image($trip['destination'])
      ],
      'activities' => array_map(function($act) {
          return [
              'day_number'    => $act['day_number'],
              'activity_name' => $act['activity_name']
          ];
      }, $activities)
  ]);
}
function check_profile_errors(): void {
    if (isset($_SESSION["errors_profile"])) {
        $errors = $_SESSION["errors_profile"];

        echo '<div id="toast-container">';
        foreach ($errors as $error) {
            echo '
            <div class="toast toast--error">
              <div class="toast__content">
                <i class="ri-error-warning-line" style="font-size: 1.2rem;"></i>
                <span>' . htmlspecialchars($error) . '</span>
              </div>
              <button type="button" class="toast__close-btn"><i class="ri-close-line"></i></button>
            </div>';
        }
        echo '</div>';

        unset($_SESSION["errors_profile"]);
    }
    else if (isset($_GET["update"]) && $_GET["update"] === "success") {
        echo '
        <div id="toast-container">
          <div class="toast toast--success">
            <div class="toast__content">
              <i class="ri-checkbox-circle-line" style="font-size: 1.2rem;"></i>
              <span>Profile changes saved successfully!</span>
            </div>
            <button type="button" class="toast__close-btn"><i class="ri-close-line"></i></button>
          </div>
        </div>';
    }
}