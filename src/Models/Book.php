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
    $req = $bdd->prepare('INSERT INTO book (title,author,description,slug,date, user_id) VALUES (:title, :author, :description, :slug, :date, 1)');
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

?>