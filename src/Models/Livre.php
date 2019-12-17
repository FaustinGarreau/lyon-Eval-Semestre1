<?php
function getLivres(){
    global $bdd;
    $req = $bdd->query('SELECT * FROM book');
    return $req->fetchAll();
}
function getLivre($slug){
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM book WHERE slug = :slug');
    $req->execute([
        "slug" => $slug
    ]);
    return $req->fetch();
}
function storeLivre(){
    global $bdd;
    // modifier les champs
    $req = $bdd->prepare('INSERT INTO book (title, author, description, slug, date) VALUES (:title, :author, :description, :slug, :date)');
    $req->execute([
        "title" => $_POST['title'],
        "author" => $_POST['author'],
        "description" => $_POST['description'],
        "slug" => $_POST['slug'],
        "date" => $_POST['date']
    ]);
}
function updateLivre($slug){
    global $bdd;
    // modifier les champs
    $req = $bdd->prepare('UPDATE book SET title = :title, author = :author, description = :description, slug= :slugPost, date = :date WHERE slug = :slug');
    $req->execute([
        "slug" => $slug,
        "title" => $_POST['title'],
        "author" => $_POST['author'],
        "description" => $_POST['description'],
        "slugPost" => $_POST['slug'],
        "date" => $_POST['date']
    ]);
}
function deleteLivre($slug){
    global $bdd;
    $req = $bdd->prepare('DELETE FROM book WHERE slug = :slug');
    $req->execute([
        "slug" => $slug
    ]);
}