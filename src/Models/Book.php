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

function deleteBook($slug)
{
    global $bdd;

    $stmt = $bdd->prepare("DELETE FROM book WHERE slug = :slug");
    $stmt->execute(array(
        "slug" => $slug
    ));
}

function storeBook() {
    global $bdd;

    $stmt = $bdd->prepare("INSERT INTO book (title,author,description,slug,date) VALUES (:title,:author,:description,:slug,:date)");
    $stmt->execute(array(
        "title" => $_POST["title"],
        "author" => $_POST["author"],
        "description" => $_POST["description"],
        "slug" => $_POST["slug"],
        "date" => $_POST["date"]
    ));
}

function updateBook($slug) {
    global $bdd;

    $stmt = $bdd->prepare("UPDATE book SET title = :title, author = :author, description = :description, slug = :slug, date = :date WHERE slug = :lastSlug");
    $stmt->execute(array(
        "title" => $_POST["title"],
        "author" => $_POST["author"],
        "description" => $_POST["description"],
        "slug" => $_POST["slug"],
        "date" => $_POST["date"],
        "lastSlug" => $slug
    ));
}
