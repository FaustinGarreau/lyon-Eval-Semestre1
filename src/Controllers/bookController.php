<?php

  function newBookPage(){
    require VIEWS.'/books/create.php';
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
        $bookSlug = getBookBySlug($_POST['slug']);
        $bookTitle = getBookByTitle($_POST['title']);

        if ($bookSlug && ($_POST['slug'] == $bookSlug['title'])) {
          $_SESSION['errors']['slug'] = 'Ce slug exist déjà!';
        }

        if ($bookTitle && ($_POST['title'] == $bookTitle['title'])) {
          $_SESSION['errors']['title'] = 'Ce titre exist déjà!';
          header('Location: /book/new');
          exit();
        }
        else {
          storebook();
          header('Location: /books');
          exit();
        }
      }
    }
  }

  function booksPage(){
    require MODELS."/bookModel.php";
    $bookIndex = getAllBooks();
    require VIEWS.'/books/index.php';
  }

  function showBook($slug){
    require MODELS.'/bookModel.php';
    $selectedBook = getBookBySlug($slug);
    require VIEWS.'/books/show.php';
  }

  function deleteBook($slug){
    require MODELS.'/bookModel.php';
      deletedBook($slug);
      header('Location: /books');
      exit();
  }

  function editBookPage($slug){
    require MODELS.'/bookModel.php';
    $selectedBook = getBookBySlug($slug);
    require VIEWS.'/books/edit.php';
  }

  function updateBook($slug){

    // valider verifie
      //if not ok
    if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['description']) && isset($_POST['slug']) && isset($_POST['date'])){

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

      //if ok
      if(!isset($_SESSION['errors'])) {
        require MODELS.'/bookModel.php';
        $bookSlug = getBookBySlug($_POST['slug']);
        $bookTitle = getBookByTitle($_POST['title']);

        if ($bookSlug && ($_POST['slug'] == $bookSlug['title'])) {
          $_SESSION['errors']['slug'] = 'Ce slug exist déjà!';
        }

        if ($bookTitle && ($_POST['title'] == $bookTitle['title'])) {
          $_SESSION['errors']['title'] = 'Ce titre exist déjà!';
          header('Location: /book/'.$slug.'/edit');
          exit();
        }
        updatedBook($slug);
        header('Location: /books');
        exit();
      }
    }
  }
