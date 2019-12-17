<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($url == '/livres') {
        require CONTROLLER .'livreController.php';
        bookIndex();
    }
    elseif ($url == '/livres/nouveau' && $method == "POST") {
        require CONTROLLER .'livreController.php';
        bookStore();
    }
    elseif ($url == '/livres/nouveau') {
        require CONTROLLER .'livreController.php';
        bookCreate();
    }
    elseif (preg_match('#^\/livres\/([a-zA-Z0-9-]+)$#', $url)) {
        require CONTROLLER .'livreController.php';
        bookShow($matches[1]);
    }

}