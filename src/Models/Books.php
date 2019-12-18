<?php
function getBooks() {
    global $pdo;
    return $pdo->query("SELECT title, description, `date`, slug FROM book ORDER BY `date` DESC")->fetchAll();
}

function getBooksCategory($category) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT author, title, description, `date`, book.slug, category FROM book INNER JOIN category ON (category.id = category_id) WHERE category.slug = ?");
    $stmt->execute([$category]);
    return $stmt->fetchAll();
}

function getBook($slug) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT author, title, description, `date`, book.slug, category FROM book INNER JOIN category ON (category.id = category_id) WHERE book.slug=?");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function deleteBook($slug) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM book WHERE slug=?");
    $stmt->execute([$slug]);
}

function storeBook($author, $slug, $title, $description, $date, $category) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO book
        (author, title, description, slug, `date`, category_id)
        VALUES (:author, :title, :description, :slug, :cdate, :category_id)");
    $stmt->execute([
        'author' => $author,
        'title' => $title,
        'description' => $description,
        'cdate' => $date,
        'slug' => $slug,
        'category_id' => $category
    ]);
}

function updateBook($slug, $author, $newslug, $title, $description, $date, $category) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE book SET
        author=:author,
        title=:title,
        description=:description,
        slug=:newslug,
        `date`=:cdate,
        category_id=:category_id
        WHERE slug=:slug");
    $stmt->execute([
        'author' => $author,
        'title' => $title,
        'description' => $description,
        'cdate' => $date,
        'newslug' => $newslug,
        'slug' => $slug,
        'category_id' => $category
    ]);
}
