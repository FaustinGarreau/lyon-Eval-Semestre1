<?php

function getCategoryFive() {
    global $bdd;
    $req = $bdd->query('SELECT * FROM category LIMIT 3');
    return $req->fetchAll();
}

function getCategorys() {
    global $bdd;
    $req = $bdd->query('SELECT * FROM category');
    return $req->fetchAll();
}

function getCategory($category, $slug) {
    global $bdd;
    $stmt = $bdd->prepare('SELECT * FROM category WHERE category = :category OR slug = :slug');
    $stmt->execute(array(
        "category" => $category,
        "slug" => $slug
    ));
    return $stmt->fetch();
}

function deleteCategory($slug) {
    global $bdd;
    $req = $bdd->prepare("DELETE FROM category WHERE slug = ?");
    $req->execute(array(
        $slug
    ));
}

function getBookCategory($slug) {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM category INNER JOIN book ON category.id = book.category_id WHERE category.slug = :slug');
    $req->execute(array(
        "slug" => $slug
    ));
    return $req->fetchAll();
}

function storeCategory() {
    global $bdd;
    $stmt = $bdd->prepare("INSERT INTO category(category, slug) VALUES (?, ?)");
    $stmt->execute(array(
        $_POST["category"],
        $_POST["slug"]
    ));
}

function updateCategory($slug) {
    global $bdd;
    $req = $bdd->prepare('UPDATE category SET category = ?, slug = ? WHERE slug = ?');
    $req->execute(array(
        $_POST['category'],
        $_POST['slug'],
        $slug
    ));
    return $_POST['slug'];
}
