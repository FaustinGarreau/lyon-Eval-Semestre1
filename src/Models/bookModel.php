<?php

  function storebook()
  {
    global $bdd;
    //request SQL
    $req = $bdd->prepare("INSERT INTO book(title,author, description, slug, date) VALUES (:title, :author, :description, :slug, :date)");
    $req->execute(array('title'=>$_POST['title'], 'author'=>$_POST['author'], 'description'=> $_POST['description'], 'slug'=>slugify($_POST['slug']), 'date'=>$_POST['date']));
  }

  function getBook($slug)
  {
    global $bdd;
    //request SQL
    $req = $bdd->prepare("SELECT * FROM book WHERE slug = :slug");
    $req->execute(array('slug'=>$slug));

    $getBook = $req->fetch();
    //return $articleIndex
    return $getBook;
  }

  function getAllBooks(){
    global $bdd;
    //request SQL
    $req = $bdd->query("SELECT * FROM book");
    $bookIndex = $req->fetchAll();
    //return $articleIndex
    return $bookIndex;
  }
