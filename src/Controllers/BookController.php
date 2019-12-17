<?php

function home() {
    require VIEWS . 'books/index.php';
}

function bookCreate() {
    require VIEWS . 'books/create.php';
}

function bookStore() {
    if (isset($_POST["title"]) && isset($_POST["description"])) {
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
           $title = getBook("title", $_POST["title"]);
           $slug = getBook("slug", $_POST["slug"]);
           if ($title) {
               $_SESSION["error"]["title"] = "Le titre existe déjà";
               header("Location: /livres/nouveau");
           } else if ($slug) {
               $_SESSION["error"]["slug"] = "Cette URL existe déjà";
               header("Location: /livres/nouveau");
           } else {
               storeBook();
               header('Location: /');
           }

       } else {
           header("Location: /livres/nouveau");
       }
   } else {
       header("Location: /livres/nouveau");
   }
}
