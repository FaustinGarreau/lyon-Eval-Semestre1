<?php
function getTags() {
    global $pdo;
    return $pdo->query("SELECT * FROM tag")->fetchAll();
}

function getTag($slug) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM tag WHERE slug = ?");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function getTagById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM tag WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function addTag($tag, $slug) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO tag (tag, slug) VALUES (?, ?)");
    $stmt->execute([$tag, $slug]);
}

function updateTag($oldslug, $tag, $slug) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE tag SET tag=?, slug=? WHERE slug=?");
    $stmt->execute([$tag, $slug, $oldslug]);
}

function deleteTag($slug) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM tag WHERE slug=?");
    $stmt->execute([$slug]);
}
