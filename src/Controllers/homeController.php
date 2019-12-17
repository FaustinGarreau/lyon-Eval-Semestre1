<?php

function home(){
    require MODELS . 'book.php';
    $book = getBook();
    require VIEWS . 'index.php';
}

?>