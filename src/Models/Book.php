<?php 
function getBooks() {
    global $bdd;
        $req=$bdd->query('SELECT * FROM book ORDER BY date');
        return $req->fetchAll();
}

function getBook($slug) {
    global $bdd;
    $req=$bdd->prepare('SELECT * FROM book WHERE slug = :slug');
    $req->execute ([
        "slug" => $slug
    ]);
    return $req->fetch();
}

function storeBook() {
    global $bdd;
    $req = $bdd->prepare('INSERT INTO book (title,author,description,slug,date) VALUES (:title, :author, :description, :slug, :date)');
    $req->execute([
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'description' => $_POST['description'],
        'slug' => $_POST['slug'],
        'date' => $_POST['date']
    ]);
}

function deleteBook($slug) {
    global $bdd;
    $req = $bdd->prepare('DELETE FROM book WHERE slug = :slug');
    $req->execute([
        "slug" => $slug
    ]);
}

function uptadeBook($slug) {
    global $bdd;
    $req=$bdd->prepare('UPDATE book SET title = :title, author = :author, description = :description, slug = :slug, date = :date WHERE slug = :prevslug');
    $req->execute ([
        "title" => $_POST['title'],
        "author" => $_POST['author'],
        "description" => $_POST['description'],
        "slug" => $_POST['slug'],
        "date" => $_POST['date'],
        "prevslug" => $slug
    ]);
}

function getTitle($title){
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM book WHERE title = :title');
    $req->execute([
        'title' => $title,
    ]);
    return $req->fetch();
}

function getSlug($slug){
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM book WHERE slug = :slug');
    $req->execute([
        'slug' => $slug,
    ]);
    return $req->fetch();
}