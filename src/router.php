<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
        if ($url == '/') {
            require CONTROLLERS . 'BookController.php';
            home();
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
