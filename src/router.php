<?php
function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    
    if ($url=='/livres') {
        // appelle le controller
        require CONTROLLERS.'BookController.php';
        // fonction qui va être créé dans ce dernier
        bookIndex();
    }
    elseif ($url =='/livres/nouveau') {
        require CONTROLLERS.'BookController.php';
        bookCreate();
    }
    elseif($url =='/articles' && $method == "POST") {
        require CONTROLLERS . 'BookController.php';
        bookShow();
    } 
}