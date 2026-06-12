<?php

declare(strict_types=1);

function output_trip_image(string $destination): string {
    $map = [
        "El Nido" => "big-lagoon.webp",
        "Coron"   => "coron.webp",
    ];

    return "assets/" . ($map[$destination] ?? "big-lagoon.webp");
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