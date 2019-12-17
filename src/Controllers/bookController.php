<?php

  function newBookPage(){
    require VIEWS.'/books/create.php';
  }

  function newBookStore(){
    require MODELS."/bookModel.php";
    storebook();
  }
