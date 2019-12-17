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

function updateCategory($oldslug, $category, $slug) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE category SET category=?, slug=? WHERE slug=?");
    $stmt->execute([$category, $slug, $oldslug]);
}

function deleteCategory($slug) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM category WHERE slug=?");
    $stmt->execute([$slug]);
}
