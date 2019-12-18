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

function getCategory($slug) {
    global $bdd;
    $stmt = $bdd->prepare('SELECT * FROM category WHERE category = ?');
    $stmt->execute(array(
        $slug
    ));
    return $stmt->fetch();
}

function getBookCategory($slug) {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM category INNER JOIN book ON category.id = book.category_id WHERE category.slug = :slug');
    $req->execute(array(
        "slug" => $slug
    ));
    return $req->fetchAll();
}
