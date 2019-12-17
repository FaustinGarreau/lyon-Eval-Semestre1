<?php

function getUser($username) {
    global $bdd;
    $stmt = $bdd->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array(
        $username
    ));
    return $stmt->fetch();
}

function createAccount() {
    global $bdd;
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $req = $bdd->prepare("INSERT INTO users(username, password) VALUES (?, ?)");
    $req->execute(array(
        $_POST['username'],
        $pass
    ));
}
