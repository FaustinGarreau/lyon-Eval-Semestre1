<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($_SERVER["REQUEST_URI"] == '/') {
        require CONTROLLER . 'IndexController.php';
        book();
    }
    elseif ($_SERVER["REQUEST_URI"] == '/livres/nouveau' && $_SERVER['REQUEST_METHOD'] == 'GET') {
        require CONTROLLER . 'BookController.php';
        bookCreate();
    }
    elseif ($_SERVER["REQUEST_URI"] == '/livres/nouveau' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        require CONTROLLER . 'BookController.php';
        bookStore(); 
    }
    elseif (preg_match('#^\/book\/([a-z0-9A-Z-]+)$#', $_SERVER["REQUEST_URI"], $matches)) { 
        require CONTROLLER . 'BookController.php';
        bookShow($matches[1]);
    }
    elseif ($_SERVER["REQUEST_URI"] == '/livres') {
        require CONTROLLER . 'BookController.php';
        BookIndex();
    }


    
    else {
        var_dump('ERROR 404 désolé, cette page n existe pas');
    }

} 
