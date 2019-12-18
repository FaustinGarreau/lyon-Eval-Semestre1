<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
        if ($url == '/livres') {
            require CONTROLLERS . 'BookController.php';
            bookIndex();
        } elseif ($url == '/category') {
            require CONTROLLERS . 'CategoryController.php';
            categoryIndex();
        } elseif ($url == '/livres/nouveau') {
            require CONTROLLERS . 'BookController.php';
            bookCreate();
        } elseif ($url == '/register') {
            require CONTROLLERS . 'AuthController.php';
            AuthRegister();
        } elseif ($url == '/login') {
            require CONTROLLERS . 'AuthController.php';
            AuthLogin();
        } elseif ($url == '/logout') {
            require CONTROLLERS . 'AuthController.php';
            AuthLogout();
        } elseif (preg_match('#^\/category\/([a-zA-Z0-9-]+)$#', $url, $slug)) {
            require CONTROLLERS . 'CategoryController.php';
            categoryShow($slug[1]);
        } elseif (preg_match('#^\/livres\/([a-zA-Z0-9-]+)$#', $url, $slug)) {
            require CONTROLLERS . 'BookController.php';
            bookShow($slug[1]);
        } elseif (preg_match('#^\/livres\/([a-zA-Z0-9-]+)\/edit$#', $url, $slug)) {
            require CONTROLLERS . 'BookController.php';
            bookEdit($slug[1]);
        } else {
            require CONTROLLERS . 'BookController.php';
            bookIndex();
        }

    } else {
        if ($url == '/livres/nouveau') {
            require CONTROLLERS . 'BookController.php';
            bookStore();
        } elseif ($url == '/register') {
            require CONTROLLERS . 'AuthController.php';
            AuthRegisterTraitement();
        } elseif ($url == '/login') {
            require CONTROLLERS . 'AuthController.php';
            AuthLoginTraitement();
        } elseif (preg_match('#^\/livres\/([a-zA-Z0-9-]+)$#', $url, $slug)) {
            require CONTROLLERS . 'BookController.php';
            bookUpdate($slug[1]);
        } elseif (preg_match('#^\/livres\/([a-zA-Z0-9-]+)\/delete$#', $url, $slug)) {
            require CONTROLLERS . 'BookController.php';
            bookDelete($slug[1]);
        } else {
            require CONTROLLERS . 'BookController.php';
            bookIndex();
        }
    }
}
