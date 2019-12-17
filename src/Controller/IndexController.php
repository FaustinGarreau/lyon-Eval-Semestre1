<?php 
function book() {
    Require MODEL . 'Book.php';
    $books = getlastbook();
    Require VIEW . 'index.php';
}