<?php

declare(strict_types=1);

function check_custom_errors()
{
    if (!empty($_SESSION["errors_custom"])) {
        foreach ($_SESSION["errors_custom"] as $error) {
            echo '<div class="form-error">' . htmlspecialchars($error) . '</div>';
        }
        unset($_SESSION["errors_custom"]);
    }
}