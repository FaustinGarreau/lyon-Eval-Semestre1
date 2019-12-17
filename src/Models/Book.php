<?php

function getBooks() {
    global $bdd;

    $stmt = $bdd->query("SELECT * FROM book");

    return $stmt->fetchAll();
}

function getBook($slug) {
    global $bdd;

    $stmt = $bdd->prepare("SELECT * FROM book WHERE slug = :slug");
    $stmt->execute(array(
        "slug" => $slug
    ));

    return $stmt->fetch();
}

function storeBook($title,$author,$description,$slug,$date) {
    global $bdd;

    $stmt = $bdd->prepare("INSERT INTO book (title,author,description,slug,date) VALUES (:title,:author,:description,:slug,:date)");
    $stmt->execute(array(
        "title" => $title,
        "author" => $author,
        "description" => $description,
        "slug" => $slug,
        "date" => $date
    ));
}
