<?php

declare(strict_types=1);

function register_inputs(string $type) {
    if ($type === 'username') {
        if (isset($_SESSION["register_data"]["username"]) && !isset($_SESSION["errors_register"]["username_taken"])) {
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
        if (isset($_SESSION["register_data"]["email"]) && !isset($_SESSION["errors_register"]["email_taken"]) && !isset($_SESSION["errors_register"]["invalid_email"])) {
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

    if ($type === 'contact') {
        if (isset($_SESSION["register_data"]["contact"]) && !isset($_SESSION["errors_register"]["invalid_contact"])) {
            echo '<label for="contact">Contact Number</label>';
            echo '<input
                type="text"
                id="contact"
                name="contact"
                placeholder="e.g. 09171234567"
                value="' . htmlspecialchars($_SESSION["register_data"]["contact"]) . '">';
        } else {
            echo '<label for="contact">Contact Number</label>';
            echo '<input type="text" id="contact" name="contact" placeholder="e.g. 09171234567">';
        }
    }

    if ($type === 'address') {
        if (isset($_SESSION["register_data"]["address"])) {
            echo '<label for="address">Address</label>';
            echo '<input
                type="text"
                id="address"
                name="address"
                placeholder="Enter your full address"
                value="' . htmlspecialchars($_SESSION["register_data"]["address"]) . '">';
        } else {
            echo '<label for="address">Address</label>';
            echo '<input type="text" id="address" name="address" placeholder="Enter your full address">';
        }
    }
}

function check_register_errors() {
    if (isset($_SESSION["errors_register"])) {
        $errors = $_SESSION["errors_register"];
        
        foreach ($errors as $error) {
            echo '<div class="form-error">' . $error . '</div>';
        }

        unset($_SESSION["errors_register"]);
    }
    else if (isset($_GET["register"]) && $_GET["register"] === "success") {
        echo '<div class="form-success">Registration Successful!</div>';
        
        unset($_SESSION["register_data"]);
    }
}