<?php

declare(strict_types=1);

function is_input_empty(string $username, string $pwd, string $email) {
    if (empty($username) || empty($pwd) || empty($email)) {
        return true;
    }
    else {
        return false;
    }
}

function is_email_invalid(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    else {
        return false;
    }
}

function is_username_invalid(string $username) {
    if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
        return true;
    }
    if (strlen($username) < 3) {
        return true;
    }
    return false;
}

function is_username_taken(object $pdo, string $username) {
    if (get_username($pdo, $username)) {
        return true;
    }
    else {
        return false;
    }
}

function is_password_weak(string $pwd) {
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $pwd)) {
        return true;
    }
    return false;
}

function is_password_match(string $pwd, string $confirm_pwd) {
    if ($pwd !== $confirm_pwd) {
        return true;
    }
    else {
        return false;
    }
}

function is_email_taken(object $pdo, string $email) {
    if (get_email($pdo, $email)) {
        return true;
    }
    else {
        return false;
    }
}

function create_user(object $pdo, string $pwd, string $username, string $email) {
    set_user($pdo, $pwd, $username, $email);
}