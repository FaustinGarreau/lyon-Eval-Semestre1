<?php

function getBooks() {
    global $bdd;
    $request = $bdd->query('SELECT * FROM book');
    return $request->fetchAll();
}

function getBook($slug) {
    global $bdd;
    $request = $bdd->prepare('SELECT * FROM book WHERE slug = :slug');
    $request->execute([
        "slug" => $slug
    ]);
    
    return $request->fetch();
}

function updateBook($slug) {
    global $bdd;
    $request = $bdd->prepare('UPDATE book SET title = :title, slug = :slug, description = :description, date = :date, author = :author WHERE slug = :prevSlug');
    $request->execute([
        "title" => $_POST['title'],
        "slug" => $_POST['slug'],
        "description" => $_POST['description'],
        "date" => $_POST['date'],
        "author" => $_POST['author'],
        "prevSlug" => $slug
    ]);
}

function storeBook() {
    global $bdd;
    $request = $bdd->prepare('INSERT INTO book (title, slug, author, description, date) VALUES (:title, :slug, :author, :description, :date)');
    $request->execute([
        "title" => $_POST['title'],
        "slug" => $_POST['slug'],
        "author" => $_POST['author'],
        "description" => $_POST['description'],
        "date" => $_POST['date'],
    ]);
}

function deleteBook($slug) {
    global $bdd;
    $request = $bdd->prepare('DELETE FROM book WHERE slug = :slug');
    $request->execute([
        "slug" => $slug
    ]);
}