<?php

function storeBook() {
    global $bdd;
    $req = $bdd->prepare('INSERT INTO book (title,author,description,slug,date) VALUES (:title, :author, :description, :slug, :date )');
    $req->execute([
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'description' => $_POST['description'],
        'slug' => $_POST['slug'],
        'date' => $_POST['date']
    ]);
}

function getBook($slug){
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

function updateBook($slug) {
    global $bdd;
    $req = $bdd->prepare('UPDATE book SET title = :title, slug = :slugPost, description = :description, author = :author, date = :date  WHERE slug = :slug');
    $req->execute([
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'description' => $_POST['description'],
        'slugPost' => $_POST['slug'],
        'date' => $_POST['date'],
        'slug' => $slug
    ]);
    
}

function deletebook($slug) {
    global $bdd;
    $req = $bdd->prepare('DELETE FROM book WHERE slug = :slug');
    $req->execute([
        "slug" => $slug
    ]);
}

function gettitle($title){
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM book WHERE title = :title');
    $req->execute([
        'title' => $title,
    ]);
    return $req->fetch();
}