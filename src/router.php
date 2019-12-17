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
    }
}

