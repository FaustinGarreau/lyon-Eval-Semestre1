<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($url=='/livres/nouveau') {
        require CONTROLLERS.'bookController.php';
        bookCreate();
    }elseif(($url == '/livre') && ($method== "POST")) {
        require CONTROLLERS . 'bookController.php';
        bookStore();
    }elseif ($url=='/livres' && $method == "GET") {
        require CONTROLLERS.'bookController.php';
        bookIndex();
    }elseif(preg_match('#^\/livres\/([a-z0-9A-Z-]+)$#',$url,$matches) && $method == "POST") {
        require CONTROLLERS . 'bookController.php';
        bookUpdate($matches[1]);
    }elseif (preg_match('#^\/livres\/([a-z0-9A-Z-]+)$#',$url,$matches)){
        require CONTROLLERS.'bookController.php';
        bookShow($matches[1]);
    }elseif(preg_match('#^\/livres\/([a-z0-9A-Z-]+)\/delete$#',$url,$matches) && $method == "POST") {
        require CONTROLLERS . 'bookController.php';
        bookDelete($matches[1]);
    }elseif (preg_match('#^\/livres\/([a-z0-9A-Z-]+)\/edit$#',$url,$matches)){
        require CONTROLLERS.'bookController.php';
        bookEdit($matches[1]);
    }
}

