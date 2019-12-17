<?php
// function getLastsArticles($start, $size) {
//     global $pdo;
//     $stmt = $pdo->prepare("SELECT title, content, created_at, updated_at, slug FROM article ORDER BY created_at DESC LIMIT :start_at, :size");
//     $stmt->bindValue("start_at", $start, PDO::PARAM_INT);
//     $stmt->bindValue("size", $size, PDO::PARAM_INT);
//     $stmt->execute();
//     return $stmt->fetchAll();
// }

function getBook($slug) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM book WHERE slug=?");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function storeBook($author, $slug, $title, $description, $date) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO book
        (author, title, description, slug, `date`)
        VALUES (:author, :title, :description, :slug, :cdate)");
    $stmt->execute([
        'author' => $author,
        'title' => $title,
        'description' => $description,
        'cdate' => $date,
        'slug' => $slug
    ]);
}

function updateBook($slug, $author, $newslug, $title, $description, $date) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE article SET
        author=:author,
        title=:title,
        description=:description,
        slug=:newslug,
        `date`=:cdate
        WHERE slug=:slug");
    $stmt->execute([
        'author' => $author,
        'title' => $title,
        'description' => $description,
        'cdate' => $date,
        'newslug' => $newslug,
        'slug' => $slug
    ]);
}

function deleteBook($slug) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM article WHERE slug=?");
    $stmt->execute([$slug]);
}
