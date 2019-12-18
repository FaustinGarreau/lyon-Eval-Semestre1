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

function getBooksTag($tag) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT GROUP_CONCAT(tag.tag) as tags, author, title, description, `date`, book.slug
        FROM book
        INNER JOIN book_tag
        ON (book_tag.book_id = book.id)
        INNER JOIN tag
        ON (book_tag.tag_id = tag.id)
        GROUP BY book.id
        HAVING SUM(IF(tag.slug = ?, 1, 0)) >= 1");
    $stmt->execute([$tag]);
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
