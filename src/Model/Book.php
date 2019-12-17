<?php
function storeBook() {
    global $bdd;
    $req = $bdd->prepare('INSERT INTO book (title, author, slug, description,) VALUES (:title, :author, :slug, :description)');
    $req->execute(array(
        'title' => $_POST['title'],
        'slug' => $_POST['slug'],
        'author' => $_POST['author'],
        'description' => $_POST['description']
      ));
}
function getBook($slug) {
    global $bdd;
    $req = $bdd->query('SELECT * FROM `book` ORDER BY book.created_at DESC');
    return $req->fetchAll();
}