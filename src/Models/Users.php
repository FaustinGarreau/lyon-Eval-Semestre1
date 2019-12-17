<?php
function getUserByEmail($email) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email=?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}

function getUserByUsername($username) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username=?");
    $stmt->execute([$username]);
    return $stmt->fetch();
}

function addUser($username, $email, $password) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);
    return $pdo->lastInsertId();
}

function getPermissions($username) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT username, permission FROM user INNER JOIN role ON (role.id = user.role) INNER JOIN role_permission ON (role_permission.role_id = role.id) INNER JOIN permission ON (permission.id = role_permission.permission_id)");
    $stmt->execute([$username]);
    return $stmt->fetchAll();
}
