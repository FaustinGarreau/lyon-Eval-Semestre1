<?php

function storeBook() {
    global $bdd;
    $req = $bdd->prepare('INSERT INTO book (title,author,description,slug,date) VALUES (:title, :author, :description, :slug, :date )');
    $req->execute([
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'description' => $_POST['description'],
        'slug' => $_POST['slug'],
        'date' => $_POST['date'],
    ]);
}

function getBook(){
    global $bdd;
    $req=$bdd->prepare('SELECT * FROM book WHERE slug = :slug');
    $req->execute ([
        "slug" => $slug
    ]);
    return $req->fetch();
}

function getbooks(){
    global $bdd;
    $req=$bdd->query('SELECT * From book ORDER BY date');
    return $req->fetchAll();
}
