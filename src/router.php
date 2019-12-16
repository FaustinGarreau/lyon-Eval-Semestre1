<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    if ($url == '/') {
        require CONTROLLERS . 'HomeController.php';
        home();
    } elseif ($url == '/livres' && $method == 'GET') {
        require CONTROLLERS . 'BookController.php';
        bookIndex();
    }
    elseif ($url == "/livres" && $method == 'POST') {
        require CONTROLLERS . 'BookController.php';
        bookStore();
    }
    elseif (preg_match("#^\/livres/nouveau$#", $url) && $method == 'GET') {
        require CONTROLLERS . 'BookController.php';
        bookCreate();
    }
    elseif (preg_match("#^\/livres/([A-Za-z0-9-_' ]+)$#", $url, $matches) && $method == 'GET') {
        require CONTROLLERS . 'BookController.php';
        bookShow($matches[1]);
    }
    elseif (preg_match("#^\/livres/([A-Za-z0-9-_' ]+)$#", $url, $matches) && $method == 'POST') {
        require CONTROLLERS . 'BookController.php';
        bookUpdate($matches[1]);
    }
    elseif (preg_match("#^\/livres/([A-Za-z0-9-_' ]+)\/edit$#", $url, $matches) && $method == 'GET') {
        require CONTROLLERS . 'BookController.php';
        bookEdit($matches[1]);
    }
    elseif (preg_match("#^\/livres/([A-Za-z0-9-_' ]+)\/delete$#", $url, $matches) && $method == 'POST') {
        require CONTROLLERS . 'BookController.php';
        bookIndex($matches[1]);
    }
}