<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($url == '/livres') {
        require CONTROLLER .'livreController.php';
        bookIndex();
    }
    elseif ($url == '/livres' && $method == "POST") {
        require CONTROLLER .'livreController.php';
        bookStore();
    }
    elseif ($url == '/livres/nouveau') {
        require CONTROLLER .'livreController.php';
        bookCreate();
    }

}