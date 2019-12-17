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
?>