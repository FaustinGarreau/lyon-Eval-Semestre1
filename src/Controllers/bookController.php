<?php

function bookCreate() {
    require VIEWS . "books/create.php";
}

function bookStore() {
    //apeler le model
    require MODELS.'book.php';
    storeBook();
    header('Location: /livres');
    //fonction model
    //redirection
}

function bookIndex() {
    require MODELS . 'book.php';
    $books=getBooks();
    require VIEWS . "books/index.php";
}