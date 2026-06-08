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
        foreach ($_SESSION["errors_profile"] as $error) {
            echo '<div class="form-error">' . htmlspecialchars($error) . '</div>';
        }
        unset($_SESSION["errors_profile"]);
    }
}