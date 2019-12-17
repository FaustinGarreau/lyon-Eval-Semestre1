<?php

function getBooks() {
    global $bdd;
    $req = $bdd->query('SELECT * FROM book ORDER BY title');
    return $req->fetchAll();
}
function storeBook() {
    global $bdd;
    $req = $bdd->prepare('INSERT INTO book (title, author, description, slug, date) VALUES (:title, :author, :description, :slug, :date)');
    $req->execute([
        "title" => $_POST["title"],
        "author" => $_POST["author"],
        "description" => $_POST["description"],
        "slug" => $_POST["slug"],
        "date" => $_POST["date"],
    ]);
}