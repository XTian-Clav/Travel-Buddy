<?php
declare(strict_types=1);

function check_coron_errors(): void {
    if (!empty($_SESSION["errors_coron"])) {
        foreach ($_SESSION["errors_coron"] as $error) {
            echo '<div class="form-error">' . htmlspecialchars($error) . '</div>';
        }
        unset($_SESSION["errors_coron"]);
    }
}