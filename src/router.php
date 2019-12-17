<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    // --- GET ---
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if ($add == "/") {
            require(CONTROLLERS."homeController.php");
            renderHome();
        } elseif ($add == "/article") {
            require(CONTROLLER."articleController.php");
            article();
        } elseif ($add == "/article/new") {
            require(CONTROLLER."articleController.php");
            newArticles();
        } elseif (preg_match("/^\/article\/[\w-]+$/", $add)) {
            require(CONTROLLER."articleController.php");
            onlyOneArticle();
        } elseif(preg_match("/^\/article\/[\w-]+\/update$/", $add)) {
            require(CONTROLLER."articleController.php");
            editPageArt();
        } elseif($add == "/register") {
            require(CONTROLLER."loginController.php");
            registerPage();
        } elseif ($add == "/login") {
            require(CONTROLLER."loginController.php");
            loginPage();
        }
        else {
            require(VIEW."404.html");
        }
    }
    // --- POST ---
    elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($add == "/article/new") {
            require(CONTROLLER."articleController.php");
            pnewart();
        }
        elseif (preg_match("/^\/article\/[\w-]+\/delete$/", $add)) {
            require(CONTROLLER."articleController.php");
            deleteArt();
            header("Location: /article");
        } elseif (preg_match("/^\/article\/[\w-]+\/update$/", $add)) {
            require(CONTROLLER."articleController.php");
            updateArt();
            //header("Location: /article");
        } elseif ($add == "/register") {
            require(CONTROLLER."loginController.php");
            newUser();
        } elseif ($add == "/login") {
            require(CONTROLLER."loginController.php");
            connect();
            header("Location: /article");
        } elseif ($add == "/logout") {
            require(CONTROLLER."loginController.php");
            logout();
            header("Location: /article");
        }
    }
}