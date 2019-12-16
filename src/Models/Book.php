<?php

function getBooks() {
    global $bdd;
    $request = $bdd->query('SELECT * FROM book');
    return $request->fetchAll();
}

function getBook($slug) {
    global $bdd;
    $request = $bdd->prepare('SELECT * FROM book WHERE slug = :slug');
    $request->execute([
        "slug" => $slug
    ]);
    
    return $request->fetch();
}