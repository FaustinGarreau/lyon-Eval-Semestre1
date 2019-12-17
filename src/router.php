<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($url == '/') {

    } 
// on verifie si l'url = /books/nomDuBook/delete et que la requete est en methode post
    elseif (preg_match('#^\/books\/([a-zA-Z0-9_-]+)\/delete$#',$url,$match) && $method == "POST") {
        require CONTROLLERS . 'BookController.php';
        bookDelete($match[1]);
    } 
// on verifie si l'url = /books/nomDuBook et que la requete est en methode post
    elseif (preg_match('#^\/books\/([a-zA-Z0-9_-]+)$#',$url,$match) && $method == "POST") {
        require CONTROLLERS . 'BookController.php';
        BookUpdate($match[1]);
    }
// on verifie si l'url = /books et que la requete est en methode post
    elseif (preg_match('#^\/books$#',$url) && $method == "POST") {
        require CONTROLLERS . "BookController.php";
        bookStore();
    } 
// on verifie si l'url = /books/create
    elseif (preg_match('#^\/books\/create$#',$url)) {
        require CONTROLLERS . 'BookController.php';
        bookCreate();
    }
// on verifie si l'url = /books
    elseif ($url == '/books') {
        require CONTROLLERS . 'BookController.php';
        booksGet();
    } 
// on verifie si l'url = /books/nomDuBook
    elseif (preg_match('#^\/books\/([a-zA-Z0-9_-]+)$#',$url,$match)) {
        require CONTROLLERS . 'BookController.php';
        bookShow($match[1]);
    } 
// on verifie si l'url = /books/nomDuBook/edit
    elseif (preg_match('#^\/books\/([a-zA-Z0-9_-]+)\/edit$#',$url,$match)) {
        require CONTROLLERS . 'BookController.php';
        bookEdit($match[1]);
    } 
    

}