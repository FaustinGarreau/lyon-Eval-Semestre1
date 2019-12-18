<?php
function storeBook() {
    global $bdd;
    $req = $bdd->prepare('INSERT INTO book (title, author, slug, description, created_at) VALUES (:title, :author, :slug, :description, :date)');
    $req->execute(array(
        'title' => $_POST['title'],
        'slug' => $_POST['slug'],
        'author' => $_POST['author'],
        'description' => $_POST['description'],
        'date' => $_POST['date']
      ));
}
function getBook($slug) {
    global $bdd;
    $req = $bdd->query('SELECT * FROM book');
    return $req->fetch();
}

function showBook($slug) {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM book WHERE slug = :slug');
    $req->execute(array(
      'slug' => $slug
    ));
    return $req->fetch();
}
function getBooks() {
    global $bdd;
    $req = $bdd->query('SELECT * FROM book ');
    return $req->fetchAll();
}
function getlastbook() {
    global $bdd;
    $req = $bdd->query('SELECT * FROM book');
    return $req->fetchAll();
}

function deleteBook($slug) {
    global $bdd;
    $req = $bdd->prepare('DELETE FROM book WHERE slug = :slug');
    $req->execute(array(
        'slug' => $slug
    ));
}
function updateBook($slug) {
    global $bdd;
    $req = $bdd->prepare('UPDATE book SET title = :title, description = :description, slug = :slug , author = :author, created_at = :date WHERE slug = :prevslug');
    $req->execute(array(
        'title' => $_POST['title'],
        'slug' => $_POST['slug'],
        'author' => $_POST['author'],
        'description' => $_POST['description'],
        'date' => $_POST['date'],
        "prevslug" => $slug
      ));
}