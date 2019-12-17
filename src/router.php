<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    // --- GET ---
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if ($url == "/") {
            //require(CONTROLLERS."homeController.php");
            //renderHome();
        } elseif ($url == "/livres/nouveau") {
            require(CONTROLLERS."bookController.php");
            renderCreateBook();
        } elseif ($url == "/livres") {
            require(CONTROLLERS."bookController.php");
            renderBooks();
        } elseif (preg_match("/^\/livres\/[\w-]+$/", $url)) {
            require(CONTROLLERS."bookController.php");
            renderBook();
        } elseif(preg_match("/^\/livres\/[\w-]+\/edit$/", $url)) {
            require(CONTROLLERS."bookController.php");
            renderEditPage();
        } else {
            //require(VIEW."404.html");
        }
    }
    // --- POST ---
    elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($url == "/livres/nouveau") {
            require(CONTROLLERS."bookController.php");
            newBook();
        }
        elseif (preg_match("/^\/livres\/[\w-]+\/delete$/", $url)) {
            require(CONTROLLERS."bookController.php");
            deleteBook();
        } elseif (preg_match("/^\/livres\/[\w-]+\/edit$/", $url)) {
            require(CONTROLLERS."bookController.php");
            updateBook();
        } elseif ($url == "/register") {
            require(CONTROLLER."loginController.php");
            newUser();
        } elseif ($url == "/login") {
            require(CONTROLLER."loginController.php");
            connect();
            header("Location: /article");
        } elseif ($url == "/logout") {
            require(CONTROLLER."loginController.php");
            logout();
            header("Location: /article");
        }
    }
}