<?php
function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    
    if ($url=='/livres' && $method == "GET") {
        // appelle le controller
        require CONTROLLERS.'BookController.php';
        // fonction qui va être créé dans ce dernier
        bookIndex();
    }

    elseif ($url =='/livres/nouveau' && $method=="GET") {
        require CONTROLLERS.'BookController.php';
        bookCreate();
    }

    elseif(preg_match('#^\/livres\/([a-z0-9A-Z-]+)$#',$url,$matches) && $method== "POST") {
        require CONTROLLERS . 'BookController.php';
        bookUptade($matches[1]);
    }

    elseif (preg_match('#^\/livres\/([a-z0-9A-Z-]+)$#',$url,$matches) && $method="GET"){         
        require CONTROLLERS.'BookController.php';
        bookShow($matches[1]);
    }

    elseif($url =='/livres' && $method == "POST") {
        require CONTROLLERS . 'BookController.php';
        bookStore();
    } 
    elseif(preg_match('#^\/livres\/([a-z0-9A-Z-]+)\/delete$#',$url,$matches) && $method == "POST") {
        require CONTROLLERS . 'BookController.php';
        bookDelete($matches[1]);
    }
    elseif (preg_match('#^\/livres\/([a-z0-9A-Z-]+)\/edit$#',$url,$matches) && $method="GET"){       
        require CONTROLLERS.'BookController.php';
        bookEdit($matches[1]);
    }
    
}