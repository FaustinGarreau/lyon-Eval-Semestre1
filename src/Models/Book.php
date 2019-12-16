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
    $request = $bdd->prepare('UPDATE book SET title = :title, slug = :slug, description = :description, date = :date WHERE slug = :prevSlug');
    $request->execute([
        "title" => $_POST['title'],
        "slug" => $_POST['slug'],
        "description" => $_POST['description'],
        "date" => $_POST['date'],
        "prevSlug" => $slug
    ]);
}