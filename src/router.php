<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($url == "/") {
        //Home page
    }

    //GET METHOD

    elseif ($method == "GET") {

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
        elseif (preg_match("#^\/livres\/([\w?-]+)\/?$#", $url, $slug)) {
            require(CONTROLLERS."BookController.php");
            bookShow($slug[1]);
        }
    }

    //POST METHOD
    elseif ($method == "POST") {
        //Create book in bdd (POST)
        if (preg_match("#^\/livres\/nouveau\/?$#", $url)) {
            require(CONTROLLERS."BookController.php");
            bookStore();
        }
    }
}
