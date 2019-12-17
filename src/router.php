<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    

    if ($_SERVER['REQUEST_URI'] == "/livres") {
        require CONTROLLERS.'LivreControler.php';
        livreIndex();
    } else if ($_SERVER['REQUEST_URI'] == "/livres/nouveau" && $_SERVER['REQUEST_METHOD'] == "POST") {
        require CONTROLLERS.'LivreControler.php';
        livreStore();
    } else if (preg_match('#^\/livres\/([a-z0-9 A-Z-]+)$#', $_SERVER['REQUEST_URI'], $matches) && $_SERVER['REQUEST_METHOD'] == "POST") {
        require CONTROLLERS.'LivreControler.php';
        livreUpdate($matches[1]);
    } else if (preg_match('#^\/livres\/nouveau$#', $_SERVER['REQUEST_URI'])) {
        require CONTROLLERS.'LivreControler.php';
        livreCreate();  
    } else if (preg_match('#^\/livres\/([a-z0-9 A-Z-]+)$#', $_SERVER['REQUEST_URI'], $matches)) {
        require CONTROLLERS.'LivreControler.php';
        livreShow($matches[1]);
    } else if (preg_match('#^\/livres\/([a-z0-9 A-Z-]+)\/edit$#', $_SERVER['REQUEST_URI'], $matches)) {
        require CONTROLLERS.'livreControler.php';
        livreEdit($matches[1]);  
    } elseif (preg_match('#^\/livres\/([a-z0-9 A-Z-]+)\/delete$#', $_SERVER['REQUEST_URI'], $matches) && $_SERVER['REQUEST_METHOD'] == "POST") {
        require CONTROLLERS.'LivreControler.php';
        livreDelete($matches[1]);
        
    }else {
        var_dump('pas ok!');
    }
}
