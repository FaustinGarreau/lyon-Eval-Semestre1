<?php
function getCategories() {
    global $pdo;
    return $pdo->query("SELECT * FROM category")->fetchAll();
}

function getCategory($slug) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM category WHERE slug = ?");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function addCategory($category, $slug) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO category (category, slug) VALUES (?, ?)");
    $stmt->execute([$category, $slug]);
}
