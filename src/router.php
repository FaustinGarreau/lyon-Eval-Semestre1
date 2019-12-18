<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($url == "/") {
        //Home page
        header("Location: /livres");
    }

    //GET METHOD

    elseif ($method == "GET") {

        //BOOK (GET)

        //Create book page (GET)
        if (preg_match("#^\/livres\/?$#", $url)) {
            require(CONTROLLERS."BookController.php");
            bookIndex();
        }

        //Create book page (GET)
        elseif (preg_match("#^\/livres\/nouveau\/?$#", $url)) {
            require(CONTROLLERS."BookController.php");
            bookCreate();
        }

        //Create book page (GET)
        elseif (preg_match("#^\/livres\/category\/?$#", $url)) {
            require(CONTROLLERS."BookController.php");
            bookCreate();
        }

        //Show book page (GET)
        elseif (preg_match("#^\/livres\/([\w?-]+)\/?$#", $url, $slug)) {
            require(CONTROLLERS."BookController.php");
            bookShow($slug[1]);
        }

        //Edit book page (GET)
        elseif (preg_match("#^\/livres\/([\w?-]+)\/edit\/?$#", $url, $slug)) {
            require(CONTROLLERS."BookController.php");
            bookEdit($slug[1]);
        }

        //AUTH (GET)

        //Show register page (GET)
        elseif (preg_match("#^\/register\/?$#", $url)) {
            require(CONTROLLERS."AuthController.php");
            registerPage();
        }

        //Show login page (GET)
        elseif (preg_match("#^\/login\/?$#", $url)) {
            require(CONTROLLERS."AuthController.php");
            loginPage();
        }

        //logout (GET)
        elseif (preg_match("#^\/logout\/?$#", $url)) {
            require(CONTROLLERS."AuthController.php");
            logoutUser();
        }
    }

    //POST METHOD
    elseif ($method == "POST") {

        //BOOK (POST)

        //Create book (POST)
        if (preg_match("#^\/livres\/nouveau\/?$#", $url)) {
            require(CONTROLLERS."BookController.php");
            bookStore();
        }

        //Update book (POST)
        elseif (preg_match("#^\/livres\/([\w?-]+)\/?$#", $url, $slug)) {
            require(CONTROLLERS."BookController.php");
            bookUpdate($slug[1]);
        }

        //Delete book (POST)
        elseif (preg_match("#^\/livres\/([\w?-]+)\/delete\/?$#", $url, $slug)) {
            require(CONTROLLERS."BookController.php");
            bookDelete($slug[1]);
        }

        //AUTH (POST)

        //register user (POST)
        elseif (preg_match("#^\/register\/?$#", $url)) {
            require(CONTROLLERS."AuthController.php");
            registerUser();
        }

        //login user (POST)
        elseif (preg_match("#^\/login\/?$#", $url)) {
            require(CONTROLLERS."AuthController.php");
            loginUser();
        }
    }
}
