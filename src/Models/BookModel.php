<?php

function storeBook() {
    global $bdd;
    // requete sql
    $req = $bdd->prepare('INSERT INTO book (title,author,slug,description,date) VALUES (:title,:author,:slug,:description,:date) ');
    $req->execute(array(   
        'title' => test_input($_POST['title']),
        "author" => test_input($_POST['author']),
        "slug" => test_input($_POST['slug']),
        "description" => test_input($_POST['description']),
        "date" => test_input($_POST['date'])
       ));
}

function getBook($slug) {
    global $bdd;
    // requete sql
    $req = $bdd->prepare('SELECT * FROM book WHERE slug = :slug');
    $req->execute(array(   
        'slug' => $slug
       ));
       $book = $req->fetch();

       return $book;
}

function getBooks() {
    global $bdd;
    // requete sql
    $req = $bdd->query('SELECT * FROM book');
    $books = $req->fetchAll();

    return $books;
}