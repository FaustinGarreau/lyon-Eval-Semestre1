<?php

function getBook($title, $slug) {
    global $bdd;
    $stmt = $bdd->prepare("SELECT *, category.id AS categoryId, book.slug AS bookSlug FROM book INNER JOIN category ON book.category_id = category.id WHERE title = :title OR book.slug = :slug");
    $stmt->execute(array(
        "title" => $title,
        "slug" => $slug
    ));
    return $stmt->fetch();
}

function getBooks() {
    global $bdd;
    $req = $bdd->query('SELECT *, category.slug AS categorySlug, book.slug AS bookSlug FROM book INNER JOIN category ON book.category_id = category.id ORDER BY date DESC');
    return $req->fetchAll();
}

function storeBook() {
    global $bdd;
    $stmt = $bdd->prepare("INSERT INTO book(title, description, date, author, slug, category_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute(array(
        $_POST["title"],
        $_POST["description"],
        $_POST["date"],
        $_POST["author"],
        $_POST["slug"],
        $_POST["category"]
    ));
}


function deleteBook($slug) {
    global $bdd;
    $req = $bdd->prepare("DELETE FROM book WHERE slug = ?");
    $req->execute(array(
        $slug
    ));
}


function updateBook($slug) {
    global $bdd;
    $req = $bdd->prepare('UPDATE book SET title = ?, author = ?, description = ?, slug = ?, date = ?, category_id = ? WHERE slug = ?');
    $req->execute(array(
        $_POST['title'],
        $_POST['author'],
        $_POST['description'],
        $_POST['slug'],
        $_POST['date'],
        $_POST['category'],
        $slug
    ));
    return $_POST['slug'];
}
