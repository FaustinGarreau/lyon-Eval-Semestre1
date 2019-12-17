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

function bookShow($slug) {
    require MODELS . 'book.php';
    $book = getbook($slug);
    require VIEWS . 'books/show.php';
}

function bookDelete($slug) {
    require MODELS.'book.php';
    deleteBook($slug);
    header('Location: /livres');
}

function bookEdit($slug) {
    require MODELS.'book.php';
    $book = getBook($slug);
    require VIEWS.'books/edit.php';
}

function bookUpdate($slug) {
            require MODELS.'book.php';
            updateBook($slug);
            header('Location: /livres/' . $_POST['slug']);
}
