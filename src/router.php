<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
        if ($url == '/livres') {
            require CONTROLLERS . 'BookController.php';
            bookIndex();
        } else if ($url == '/livres/nouveau') {
            require CONTROLLERS . 'BookController.php';
            bookCreate();
        }

    } else {
        if ($url == '/livres/nouveau') {
            require CONTROLLERS . 'BookController.php';
            bookStore();
        }
    }
}
