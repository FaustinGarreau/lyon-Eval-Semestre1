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

    }

    //POST METHOD
    elseif ($method == "post") {

    }
}
