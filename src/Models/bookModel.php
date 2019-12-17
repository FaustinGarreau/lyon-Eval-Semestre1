<?php

  function storebook()
  {
    global $bdd;
    //request SQL
    $req = $bdd->prepare("INSERT INTO book(title,author, description, slug, date) VALUES (:title, :author, :description, :slug, :date)");
    $req->execute(array('title'=>$_POST['title'], 'author'=>$_POST['author'], 'description'=> $_POST['description'], 'slug'=>$_POST['slug'], 'date'=>$_POST['date']));
  }
