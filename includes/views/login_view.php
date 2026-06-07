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

function check_login_errors() {
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        foreach ($errors as $error) {
            echo '<div class="form-error">' . $error . '</div>';
        }

        unset($_SESSION["errors_login"]);
    }
    else if (isset($_GET["login"]) && $_GET["login"] === "success") {
        echo '<div class="form-success">Registration Successful!</div>';
    }
}