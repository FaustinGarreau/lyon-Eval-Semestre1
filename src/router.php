<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
        if ($url == '/livres') {
            require CONTROLLERS . 'BookController.php';
            bookIndex();
        } elseif ($url == '/livres/nouveau') {
            require CONTROLLERS . 'BookController.php';
            bookCreate();
        } elseif (preg_match('#^\/livres\/([a-zA-Z0-9-]+)$#', $url, $slug)) {
            require CONTROLLERS . 'BookController.php';
            bookShow($slug[1]);
        } elseif (preg_match('#^\/livres\/([a-zA-Z0-9-]+)\/edit$#', $url, $slug)) {
            require CONTROLLERS . 'BookController.php';
            bookEdit($slug[1]);
        }

    } else {
        if ($url == '/livres/nouveau') {
            require CONTROLLERS . 'BookController.php';
            bookStore();
        } elseif (preg_match('#^\/livres\/([a-zA-Z0-9-]+)$#', $url, $slug)) {
            require CONTROLLERS . 'BookController.php';
            bookUpdate($slug[1]);
        } elseif (preg_match('#^\/livres\/([a-zA-Z0-9-]+)\/delete$#', $url, $slug)) {
            require CONTROLLERS . 'BookController.php';
            bookDelete($slug[1]);
        }
    }
}
