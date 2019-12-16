<?php

function getBooks() {
    global $bdd;
    $request = $bdd->query('SELECT * FROM book');
    return $request->fetchAll();
}