<?php

function storeBook() {
    global $bdd;
    $stmt = $bdd->prepare("INSERT INTO book(title, description, date, author, slug) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute(array(
        $_POST["title"],
        $_POST["description"],
        $_POST["date"],
        $_POST["author"],
        $_POST["slug"]
    ));
}

function getBook($who, $value) {
    global $bdd;
    $stmt = $bdd->prepare('SELECT * FROM book WHERE ? = ?');
    $stmt->execute(array(
        $who,
        $value
    ));
    return $stmt->fetch();
}

function getBooks() {
    global $bdd;
    $req = $bdd->query('SELECT * FROM book ORDER BY date DESC');
    return $req->fetchAll();
}
