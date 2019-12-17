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
        } elseif (preg_match("/^\/article\/[\w-]+$/", $url)) {
            require(CONTROLLER."articleController.php");
            onlyOneArticle();
        } elseif(preg_match("/^\/article\/[\w-]+\/update$/", $url)) {
            require(CONTROLLER."articleController.php");
            editPageArt();
        } elseif($url == "/register") {
            require(CONTROLLER."loginController.php");
            registerPage();
        } elseif ($url == "/login") {
            require(CONTROLLER."loginController.php");
            loginPage();
        }
        else {
            require(VIEW."404.html");
        }
    }
    // --- POST ---
    elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($url == "/livres/nouveau") {
            require(CONTROLLERS."bookController.php");
            newBook();
            //pnewart();
        }
        elseif (preg_match("/^\/article\/[\w-]+\/delete$/", $url)) {
            require(CONTROLLER."articleController.php");
            deleteArt();
            header("Location: /article");
        } elseif (preg_match("/^\/article\/[\w-]+\/update$/", $url)) {
            require(CONTROLLER."articleController.php");
            updateArt();
            //header("Location: /article");
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