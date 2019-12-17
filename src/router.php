<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($url == '/') {

    } 

    elseif (preg_match('#^\/books$#',$url) && $method == "POST") {
        require CONTROLLERS . "BookController.php";
        bookStore();
    } 

    elseif (preg_match('#^\/books\/create$#',$url)) {
        require CONTROLLERS . 'BookController.php';
        bookCreate();
    }

    elseif ($url == '/books') {
        require CONTROLLERS . 'BookController.php';
        booksGet();
    } 
    
    elseif (preg_match('#^\/books\/([a-zA-Z0-9_-]+)$#',$url,$match)) {
        require CONTROLLERS . 'BookController.php';
        bookShow($match[1]);
    } 
    

}