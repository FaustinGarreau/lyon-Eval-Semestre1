<?php

require MODELS . 'Book.php';

function bookIndex() {
    $books = getBooks();
    require VIEWS . 'books/index.php';    
}