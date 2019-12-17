<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($url == "/") {
        //Home page
        require(CONTROLLERS."BookController.php");
        home();
    }

    //GET METHOD
    elseif ($method == "GET") {
        if (preg_match("#^\/livres\/nouveau\/?$#", $url)) {
            //Create book page (GET)
            require(CONTROLLERS."BookController.php");
            bookCreate();
        }
    }

    //POST METHOD
    elseif ($method == "POST") {
        if (preg_match("#^\/livres\/nouveau\/?$#", $url)) {
            //Create book in bdd (POST)
            echo "string";
            require(CONTROLLERS."BookController.php");
            bookStore();
        }
    }
}
