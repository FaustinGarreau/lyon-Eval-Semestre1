<?php

function run() {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];


    //si lien bon et en method post (pour le formulaire de la creation de livre)
    if ($_SERVER['REQUEST_URI'] == '/book/new' && $_SERVER['REQUEST_METHOD'] == 'POST') {
      require CONTROLLERS.'/bookController.php';
      newBookStore();
      header('Location: /book/new');
      exit();
    }


    //si lien bon  (pour afficher la page de la creation de livre)
    elseif ($_SERVER['REQUEST_URI'] == '/book/new') {
      require CONTROLLERS.'/bookController.php';
      newBookPage();
    }

    //si lien bon  (pour afficher la page de tout les livres)
    elseif ($_SERVER['REQUEST_URI'] == '/books') {
      require CONTROLLERS.'/bookController.php';
      booksPage();
    }

    //si lien bon (pour afficher la page d'un seul livre)
    elseif (preg_match('#^\/book\/([a-zA-Z0-9_-]+)$#', $_SERVER['REQUEST_URI'], $matches )) {
      //affiche un seul livre
      require CONTROLLERS.'/bookController.php';
      showBook($matches[1]);
    }
}
