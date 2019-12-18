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

    elseif (preg_match('#^\/book\/([a-zA-Z0-9_-]+)\/delete#', $_SERVER['REQUEST_URI'], $matches ) && $_SERVER['REQUEST_METHOD'] == "POST") {
      //supprime un livre
      require CONTROLLERS.'/bookController.php';
      deleteBook($matches[1]);
    }

    elseif (preg_match('#^\/book\/([a-zA-Z0-9_-]+)#', $_SERVER['REQUEST_URI'], $matches ) && $_SERVER['REQUEST_METHOD'] == "POST") {
      //met a jour un article 'UPDATE'
      require CONTROLLERS.'/bookController.php';
      updateBook($matches[1]);
      header("Location: book/".$matches[1]);
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

  //si lien bon (pour afficher la page edit)
    elseif (preg_match('#^\/book\/([a-zA-Z0-9_-]+)\/edit$#', $_SERVER['REQUEST_URI'], $matches )) {
      //Affiche la page qui permet d'editer un article
      require CONTROLLERS.'/BookController.php';
      editBookPage($matches[1]);
    }
}
