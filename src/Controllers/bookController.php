<?php

  function newBookPage(){
    require VIEWS.'/books/create.php';
  }

  function booksPage(){
    require MODELS."/bookModel.php";
    $bookIndex = getAllBooks();
    require VIEWS.'/books/index.php';
  }

  function showBook($slug){
    require MODELS.'/bookModel.php';
    $selectedBook = getBook($slug);
    require VIEWS.'/books/show.php';
  }

  function newBookStore(){
    require MODELS."/bookModel.php";
    if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['description']) && isset($_POST['slug']) && isset($_POST['date'])) {

      $_SESSION['old'] = $_POST;

      if (empty($_POST['title'])) {
        $_SESSION['errors']['title'] = 'Le champ est requis';
      }

      if (empty($_POST['author'])) {
        $_SESSION['errors']['author'] = 'Le champ est requis';
      }

      if (empty($_POST['description'])) {
        $_SESSION['errors']['description'] = 'Le champ est requis';
      }

      if (empty($_POST['slug'])) {
        $_SESSION['errors']['slug'] = 'Le champ est requis';
      }

      if (empty($_POST['date'])) {
        $_SESSION['errors']['date'] = 'Le champ est requis';
      }

      if (!isset($_SESSION['errors'])) {
        $book = getBook($_POST['title']);

        if ($book && ($_POST['title'] == $book['title'])) {
          $_SESSION['errors']['title'] = 'Ce titre exist déjà!';
        }
        else {
          storebook();
          header('Location: /books');
          exit();
        }
      }
    }
  }
