<?php
declare(strict_types=1);

function check_elnido_errors(): void {
    if (!empty($_SESSION["errors_elnido"])) {
        foreach ($_SESSION["errors_elnido"] as $error) {
            echo '<div class="form-error">' . htmlspecialchars($error) . '</div>';
        }
        unset($_SESSION["errors_elnido"]);
    }
}