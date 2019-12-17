<?php

function getBook($title, $slug) {
    global $bdd;
    $stmt = $bdd->prepare("SELECT * FROM book WHERE title = :title OR slug = :slug");
    $stmt->execute(array(
        "title" => $title,
        "slug" => $slug
    ));
    return $stmt->fetch();
}

function getBooks() {
    global $bdd;
    $req = $bdd->query('SELECT * FROM book ORDER BY date DESC');
    return $req->fetchAll();
}


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


function updateBook($slug) {
    global $bdd;
    $req = $bdd->prepare('UPDATE book SET title = ?, author = ?, description = ?, slug = ?, date = ? WHERE slug = ?');
    $req->execute(array(
        $_POST['title'],
        $_POST['author'],
        $_POST['description'],
        $_POST['slug'],
        $_POST['date'],
        $slug
    ));
    return $_POST['slug'];
}
