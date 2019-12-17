<?php

function getUserByName($username) {
    global $bdd;

    $stmt = $bdd->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->execute(array(
        "username" => $username
    ));

    return $stmt->fetch();
}

function userRegister() {
    global $bdd;

    $stmt = $bdd->prepare("INSERT INTO user (username,password) VALUES (:username,:password)");
    $stmt->execute(array(
        "username" => $_POST["username"],
        "password" => password_hash($_POST["password"], PASSWORD_BCRYPT)
    ));
}
