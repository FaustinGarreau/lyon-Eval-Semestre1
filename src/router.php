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
    elseif (preg_match('#^\/livres\/([a-z0-9A-Z-]+)$#', $_SERVER["REQUEST_URI"], $matches)) { 
        require CONTROLLER . 'BookController.php';
        bookShow($matches[1]);
    }
    elseif ($_SERVER["REQUEST_URI"] == '/livres') {
        require CONTROLLER . 'BookController.php';
        BookIndex();
    }
    elseif (preg_match('#^\/book\/([a-z0-9A-Z-]+)\/edit$#', $_SERVER["REQUEST_URI"], $matches)) { 
        require CONTROLLER . 'BookController.php';
        bookEdit($matches[1]);
    }
    elseif (preg_match('#^\/book\/([a-z0-9A-Z-]+)$#', $_SERVER["REQUEST_URI"] , $matches) && $_SERVER['REQUEST_METHOD'] == 'POST') { 
        require CONTROLLER . 'BookController.php';
        bookUpdate($matches[1]);
    }   
    elseif (preg_match('#^\/livres\/([a-z0-9A-Z-]+)\/delete$#', $_SERVER["REQUEST_URI"], $matches) && $_SERVER['REQUEST_METHOD'] == 'POST') { 
        require CONTROLLER . 'BookController.php';
        bookDelete($matches[1]);
    }

    
    else {
        var_dump('désolé, cette page n existe pas');
    }

} 
