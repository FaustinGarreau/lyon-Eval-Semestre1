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
    }
    require VIEWS . 'books/show.php';
}