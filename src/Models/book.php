<?php

    function getAllBooks() {
        global $bdd;
        $req = $bdd->prepare('SELECT SUBSTRING(description, 1,10) AS description, id, title, slug, author, date FROM book');
        $req->execute();
        return $req->fetchAll();
    }
    function getBook() {
        $slug = explode("/", $_SERVER['REQUEST_URI'])[2];
        global $bdd;
        $req = $bdd->prepare('SELECT * FROM book WHERE slug=:slug');
        $req->execute([
            "slug" => $slug,
        ]);
        $el = $req->fetchAll();
        if (!isset($el[0])) {
            echo 404;
            exit();
        }
        return $el[0];
    }

?>