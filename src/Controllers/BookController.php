<?php

function bookIndex() {
    require MODELS . 'Book.php';
    $books = getBooks();

    require VIEWS . 'books/index.php';
}

function bookCreate() {
    require VIEWS . 'books/create.php';
}

function bookShow($slug) {
    require MODELS . 'Book.php';
    $book = getBook("", $slug);

    require VIEWS . 'books/show.php';
}

function bookEdit($slug) {
    require MODELS . 'Book.php';
    $book = getbook("", $slug);

    require VIEWS . 'books/edit.php';
}

function bookDelete($slug) {
    require MODELS . 'Book.php';
    deleteBook($slug);
    header('Location: /livres');
}

function bookUpdate($slug) {
    if (isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["author"]) && isset($_POST["slug"]) && isset($_POST["date"])) {

        if (!escape($_POST['title'])) {
            $_SESSION["error"]["title"] = "Ce champ est requis";
            header("Location: /livres/". $slug ."/edit");
        } elseif (preg_match("#^nouveau$#", $_POST["title"])) {
           $_SESSION["error"]["title"] = "Vous ne pouvez pas utiliser ce nom de livre";
           header("Location: /livres/". $slug ."/edit");
       } elseif (!preg_match("#^[a-zA-Z- ]{2,}$#", $_POST["title"])) {
           $_SESSION["error"]["title"] = "Format incorrect minimum 2 lettres";
           header("Location: /livres/". $slug ."/edit");
       }

       if (!escape($_POST['author'])) {
           $_SESSION["error"]["author"] = "Ce champ est requis";
           header("Location: /livres/". $slug ."/edit");
       } elseif (!preg_match("#^.{2,}$#", $_POST["author"])) {
          $_SESSION["error"]["author"] = "Format incorrect minimum 2 lettres";
          header("Location: /livres/". $slug ."/edit");
      }

       if (!escape($_POST['description'])) {
           $_SESSION["error"]["description"] = "Ce champ est requis";
           header("Location: /livres/". $slug ."/edit");
       } elseif (!preg_match("#^.{2,}$#", $_POST["description"])) {
          $_SESSION["error"]["description"] = "Format incorrect minimum 2 lettres";
          header("Location: /livres/". $slug ."/edit");
      }

      if (!escape($_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Ce champ est requis";
          header("Location: /livres/". $slug ."/edit");
      } else if ($_POST['slug'] != preg_replace('~[^\pL\d]+~u', '-', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /livres/". $slug ."/edit");
      } else if ($_POST['slug'] != iconv('utf-8', 'us-ascii//TRANSLIT', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /livres/". $slug ."/edit");
      } else if ($_POST['slug'] != preg_replace('~[^-\w]+~', '', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /livres/". $slug ."/edit");
      } else if ($_POST['slug'] != trim($_POST['slug'], '-')) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /livres/". $slug ."/edit");
      } else if ($_POST['slug'] != preg_replace('~-+~', '-', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /livres/". $slug ."/edit");
      } else if ($_POST['slug'] != strtolower($_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /livres/". $slug ."/edit");
      }

      if (!escape($_POST['date'])) {
          $_SESSION["error"]["date"] = "Ce champ est requis";
          header("Location: /livres/". $slug ."/edit");
      }

      if (!isset($_SESSION["error"])) {
          require MODELS . 'Book.php';
          $bookBeforeUpdate = getBook("", $slug);
          $bookByTitle = getBook($_POST['title'], "");
          $bookBySlug = getBook("", $_POST['slug']);

          if ($bookByTitle && ($bookByTitle['title'] == $_POST['title']) && ($_POST['title'] != $bookBeforeUpdate['title'])) {
              $_SESSION["error"]["title"] = "Le titre existe déjà";
              header("Location: /livres/". $slug ."/edit");
          } elseif ($bookBySlug && ($bookBySlug['slug'] == $_POST['slug']) && ($_POST['slug'] != $bookBeforeUpdate['slug'])) {
              $_SESSION["error"]["slug"] = "Cette URL existe déjà";
              header("Location: /livres/". $slug ."/edit");
          } else {
              $slugNew = updateBook($slug);
              header('Location: /livres/'. $slugNew .'');
          }
       } else {
           header("Location: /livres/". $slug ."/edit");
       }
   } else {
       header("Location: /livres/". $slug ."/edit");
   }
}

function bookStore() {
    if (isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["author"]) && isset($_POST["slug"]) && isset($_POST["date"])) {
        $_SESSION['old'] = $_POST;

        if (!escape($_POST['title'])) {
            $_SESSION["error"]["title"] = "Ce champ est requis";
            header("Location: /livres/nouveau");
        } elseif (preg_match("#^nouveau$#", $_POST["title"])) {
           $_SESSION["error"]["title"] = "Vous ne pouvez pas utiliser ce nom de livre";
           header("Location: /livres/nouveau");
       } elseif (!preg_match("#^[a-zA-Z- ]{2,}$#", $_POST["title"])) {
           $_SESSION["error"]["title"] = "Format incorrect minimum 2 lettres";
           header("Location: /livres/nouveau");
       }

       if (!escape($_POST['author'])) {
           $_SESSION["error"]["author"] = "Ce champ est requis";
           header("Location: /livres/nouveau");
       } elseif (!preg_match("#^.{2,}$#", $_POST["author"])) {
          $_SESSION["error"]["author"] = "Format incorrect minimum 2 lettres";
          header("Location: /livres/nouveau");
      }

       if (!escape($_POST['description'])) {
           $_SESSION["error"]["description"] = "Ce champ est requis";
           header("Location: /livres/nouveau");
       } elseif (!preg_match("#^.{2,}$#", $_POST["description"])) {
          $_SESSION["error"]["description"] = "Format incorrect minimum 2 lettres";
          header("Location: /livres/nouveau");
      }

      if (!escape($_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Ce champ est requis";
          header("Location: /livres/nouveau");
      } else if ($_POST['slug'] != preg_replace('~[^\pL\d]+~u', '-', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /livres/nouveau");
      } else if ($_POST['slug'] != iconv('utf-8', 'us-ascii//TRANSLIT', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /livres/nouveau");
      } else if ($_POST['slug'] != preg_replace('~[^-\w]+~', '', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /livres/nouveau");
      } else if ($_POST['slug'] != trim($_POST['slug'], '-')) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /livres/nouveau");
      } else if ($_POST['slug'] != preg_replace('~-+~', '-', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /livres/nouveau");
      } else if ($_POST['slug'] != strtolower($_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /livres/nouveau");
      }

      if (!escape($_POST['date'])) {
          $_SESSION["error"]["date"] = "Ce champ est requis";
          header("Location: /livres/nouveau");
      }

       if (!isset($_SESSION["error"])) {
           require MODELS . 'Book.php';
           $book = getBook($_POST['title'], $_POST['slug']);

           if ($book && $book['title'] == $_POST['title']) {
               $_SESSION["error"]["title"] = "Le titre existe déjà";
               header("Location: /livres/nouveau");
           } elseif ($book && $book['slug'] == $_POST['slug']) {
               $_SESSION["error"]["slug"] = "Cette URL existe déjà";
               header("Location: /livres/nouveau");
           } else {
               storeBook();
               header('Location: /livres');
           }

       } else {
           header("Location: /livres/nouveau");
       }
   } else {
       header("Location: /livres/nouveau");
   }
}
