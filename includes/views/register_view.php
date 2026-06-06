<?php

declare(strict_types=1);

function register_inputs(string $type) {
    if ($type === 'username') {
        if (isset($_SESSION["register_data"]["username"]) && !isset($_SESSION["error_register"]["username_taken"])) {
            echo '<label for="username">Username</label>';
            echo '<input
                type="text"
                id="username"
                name="username"
                placeholder="Enter your username"
                autocomplete="username"
                value="' . htmlspecialchars($_SESSION["register_data"]["username"]) . '">';
        } else {
            echo '<label for="username">Username</label>';
            echo '<input type="text" id="username" name="username" placeholder="Enter your username" autocomplete="username">';
        }
    }

    if ($type === 'email') {
        if (isset($_SESSION["register_data"]["email"]) && !isset($_SESSION["error_register"]["email_taken"]) && !isset($_SESSION["error_register"]["invalid_email"])) {
            echo '<label for="email">Email</label>';
            echo '<input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
                value="' . htmlspecialchars($_SESSION["register_data"]["email"]) . '">';
        } else {
            echo '<label for="email">Email</label>';
            echo '<input type="email" id="email" name="email" placeholder="Enter your email">';
        }
    }
}

function check_register_errors() {
    if (isset($_SESSION["error_register"])) {
        $errors = $_SESSION["error_register"];
        
        foreach ($errors as $error) {
            echo '<div class="form-error">' . $error . '</div>';
        }

        unset($_SESSION["error_register"]);
    }

    else if (isset($_GET["register"]) && $_GET["register"] === "success") {
        echo '<div class="form-success">Registration Successful!</div>';
    }
}