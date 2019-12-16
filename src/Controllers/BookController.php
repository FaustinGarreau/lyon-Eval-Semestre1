<?php

require MODELS . 'Book.php';

function bookIndex() {
    $books = getBooks();
    require VIEWS . 'books/index.php';    
}

function bookShow($slug) {
    $book = getBook($slug);
    if (!$book) {
        header('Location: /404');
        exit();
    }
    require VIEWS . 'books/show.php';
}

function bookEdit($slug) {
    $book = getBook($slug);
    if (!$book) {
        header('Location: /404');
        exit();
    }
    require VIEWS . 'books/edit.php';
}

function bookUpdate($slug) {
    updateBook($slug);
    header('Location: /livres/' . ($_POST['slug'] ?? ""));
}