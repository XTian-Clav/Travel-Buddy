<?php
declare(strict_types=1);

function check_predefined_errors(): void {
    if (!empty($_SESSION["errors_predefined"])) {
        foreach ($_SESSION["errors_predefined"] as $error) {
            echo '<div class="form-error">' . htmlspecialchars($error) . '</div>';
        }
        unset($_SESSION["errors_predefined"]);
    }
}