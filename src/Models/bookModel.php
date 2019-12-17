<?php

  function storebook()
  {
    global $bdd;
    //request SQL
    $req = $bdd->prepare("INSERT INTO book(title,author, description, slug, date) VALUES (:title, :author, :description, :slug, :date)");
    $req->execute(array('title'=>$_POST['title'], 'author'=>$_POST['author'], 'description'=> $_POST['description'], 'slug'=>slugify($_POST['slug']), 'date'=>$_POST['date']));
  }

  function getBook($title)
  {
    global $bdd;
    //request SQL
    $req = $bdd->prepare("SELECT * FROM book WHERE title = :title");
    $req->execute(array('title'=>$title));

    $getBook = $req->fetch();
    //return $articleIndex
    return $getBook;
  }
