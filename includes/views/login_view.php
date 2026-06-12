<?php

declare(strict_types=1);

function output_username() {
    if (isset($_SESSION["user_id"])) {
        echo $_SESSION["user_username"];
    } else {
        echo "You are not logged in.";
    }
}

function output_email() {
    if (isset($_SESSION["user_id"])) {
        echo $_SESSION["user_email"];
    } else {
        echo "You are not logged in.";
    }
}

function output_contact() {
    if (isset($_SESSION["user_id"])) {
        echo $_SESSION["user_contact"];
    } else {
        echo "You are not logged in.";
    }
}

function output_address() {
    if (isset($_SESSION["user_id"])) {
        echo $_SESSION["user_address"];
    } else {
        echo "You are not logged in.";
    }
}

function check_login_errors() {
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

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

        unset($_SESSION["errors_login"]);
    }
    else if (isset($_GET["login"]) && $_GET["login"] === "success") {
        echo '
        <div id="toast-container">
          <div class="toast toast--success">
            <div class="toast__content">
              <i class="ri-checkbox-circle-line" style="font-size: 1.2rem;"></i>
              <span>Login Successful!</span>
            </div>
            <button type="button" class="toast__close-btn"><i class="ri-close-line"></i></button>
          </div>
        </div>';
    }
}