<?php

declare(strict_types=1);

function check_custom_errors()
{
    if (!empty($_SESSION["errors_custom"])) {
        echo '<div id="toast-container">';
        foreach ($_SESSION["errors_custom"] as $error) {
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
        
        unset($_SESSION["errors_custom"]);
    }
}