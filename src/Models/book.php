<?php

    function getAllBooks() {
        global $bdd;
        $req = $bdd->prepare('SELECT SUBSTRING(description, 1,10) AS description, id, title, slug, author, date FROM book');
        $req->execute();
        return $req->fetchAll();
    }
    function getBook() {
        
    }

?>