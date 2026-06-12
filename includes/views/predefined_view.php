<?php
declare(strict_types=1);

function check_predefined_errors(): void {
    if (!empty($_SESSION["errors_predefined"])) {
        echo '<div id="toast-container">';
        foreach ($_SESSION["errors_predefined"] as $error) {
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
        
        unset($_SESSION["errors_predefined"]);
    }
}