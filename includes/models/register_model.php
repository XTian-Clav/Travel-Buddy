<?php

declare(strict_types=1);

function get_username(PDO $pdo, string $username) {
    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(PDO $pdo, string $email) {
    $query = "SELECT username FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_contact(PDO $pdo, string $contact) {
    $query = "SELECT username FROM users WHERE contact = :contact;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":contact", $contact);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(PDO $pdo, string $pwd, string $username, string $email, string $contact, string $address) {
    $query = "INSERT INTO users (username, pwd, email, contact, address) VALUES (:username, :pwd, :email, :contact, :address);";
    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];

    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":contact", $contact);
    $stmt->bindParam(":address", $address);
    $stmt->execute();
}