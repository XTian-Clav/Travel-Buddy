<?php

declare(strict_types=1);

function is_input_empty(string $username, string $pwd, string $email, string $contact, string $address) {
    if (empty($username) || empty($pwd) || empty($email) || empty($contact) || empty($address)) {
        return true;
    } else {
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
    } else {
        return false;
    }
}

function is_email_invalid(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_email_taken(object $pdo, string $email) {
    if (get_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function is_contact_invalid(string $contact): bool 
{
    return !preg_match('/^09\d{9}$/', str_replace([' ', '-'], '', $contact));
}

function is_contact_taken(object $pdo, string $contact) {
    if (get_contact($pdo, $contact)) {
        return true;
    } else {
        return false;
    }
}

function is_password_weak(string $pwd) {
    if (strlen($pwd) < 8) {
        return true;
    }
    if (!preg_match("/[A-Z]/", $pwd)) {
        return true;
    }
    if (!preg_match("/\d/", $pwd)) {
        return true;
    }
    return false;
}

function create_user(object $pdo, string $pwd, string $username, string $email, string $contact, string $address) {
    set_user($pdo, $pwd, $username, $email, $contact, $address);
}