<?php

function categoryIndex() {

    require MODELS . 'Category.php';
    $categorys = getCategorys();

    require VIEWS . 'Category/index.php';
}

function categoryCreate() {
    if (isset($_SESSION["user"])) {
        require VIEWS . 'category/create.php';
    } else {
        header("Location: /category");
    }
}

function categoryEdit($slug) {
    if (isset($_SESSION["user"])) {
        require MODELS . 'Category.php';
        $category = getCategory("", $slug);

        require VIEWS . 'category/edit.php';
    } else {
        header("Location: /category");
    }
}

function categoryShow($slug) {
    require MODELS . 'Category.php';
    $category = getCategory("", $slug);
    $books = getBookCategory($slug);

    require VIEWS . 'category/show.php';
}

function categoryDelete($slug) {
    if (isset($_SESSION["user"])) {
        require MODELS . 'Category.php';
        deleteCategory($slug);
        header('Location: /category');
    } else {
        header("Location: /category");
    }
}

function categoryStore() {
    if (!isset($_SESSION["user"])) {
        header('Location: /category');
    } elseif (isset($_POST["category"]) && isset($_POST["slug"])) {
        $_SESSION['old'] = $_POST;

        if (!escape($_POST['category'])) {
            $_SESSION["error"]["category"] = "Ce champ est requis";
            header("Location: /category/nouveau");
        } elseif (preg_match("#^nouveau$#", $_POST["category"])) {
           $_SESSION["error"]["category"] = "Vous ne pouvez pas utiliser ce nom de livre";
           header("Location: /category/nouveau");
       } elseif (!preg_match("#^[a-zA-Z- ]{2,}$#", $_POST["category"])) {
           $_SESSION["error"]["category"] = "Format incorrect minimum 2 lettres";
           header("Location: /category/nouveau");
       }

      if (!escape($_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Ce champ est requis";
          header("Location: /category/nouveau");
      } else if ($_POST['slug'] != preg_replace('~[^\pL\d]+~u', '-', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /category/nouveau");
      } else if ($_POST['slug'] != iconv('utf-8', 'us-ascii//TRANSLIT', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /category/nouveau");
      } else if ($_POST['slug'] != preg_replace('~[^-\w]+~', '', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /category/nouveau");
      } else if ($_POST['slug'] != trim($_POST['slug'], '-')) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /category/nouveau");
      } else if ($_POST['slug'] != preg_replace('~-+~', '-', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /category/nouveau");
      } else if ($_POST['slug'] != strtolower($_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /category/nouveau");
      }

       if (!isset($_SESSION["error"])) {
           require MODELS . 'Category.php';
           $category = getCategory($_POST['category'], $_POST['slug']);

           if ($category && $category['category'] == $_POST['category']) {
               $_SESSION["error"]["category"] = "Le titre existe déjà";
               header("Location: /category/nouveau");
           } elseif ($category && $category['slug'] == $_POST['slug']) {
               $_SESSION["error"]["slug"] = "Cette URL existe déjà";
               header("Location: /category/nouveau");
           } else {
               storeCategory();
               header('Location: /category');
           }

       } else {
           header("Location: /category/nouveau");
       }
   } else {
       header("Location: /category/nouveau");
   }
}





function categoryUpdate($slug) {
    if (!isset($_SESSION["user"])) {
        header('Location: /category');
    } elseif (isset($_POST["category"]) && isset($_POST["slug"])) {
        $_SESSION['old'] = $_POST;

        if (!escape($_POST['category'])) {
            $_SESSION["error"]["category"] = "Ce champ est requis";
            header("Location: /category/". $slug ."/edit");
        } elseif (preg_match("#^nouveau$#", $_POST["category"])) {
           $_SESSION["error"]["category"] = "Vous ne pouvez pas utiliser ce nom de livre";
           header("Location: /category/". $slug ."/edit");
       } elseif (!preg_match("#^[a-zA-Z- ]{2,}$#", $_POST["category"])) {
           $_SESSION["error"]["category"] = "Format incorrect minimum 2 lettres";
           header("Location: /category/". $slug ."/edit");
       }

      if (!escape($_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Ce champ est requis";
          header("Location: /category/". $slug ."/edit");
      } else if ($_POST['slug'] != preg_replace('~[^\pL\d]+~u', '-', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /category/". $slug ."/edit");
      } else if ($_POST['slug'] != iconv('utf-8', 'us-ascii//TRANSLIT', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /category/". $slug ."/edit");
      } else if ($_POST['slug'] != preg_replace('~[^-\w]+~', '', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /category/". $slug ."/edit");
      } else if ($_POST['slug'] != trim($_POST['slug'], '-')) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /category/". $slug ."/edit");
      } else if ($_POST['slug'] != preg_replace('~-+~', '-', $_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /category/". $slug ."/edit");
      } else if ($_POST['slug'] != strtolower($_POST['slug'])) {
          $_SESSION["error"]["slug"] = "Votre url n'est pas valide";
          header("Location: /category/". $slug ."/edit");
      }

      if (!isset($_SESSION["error"])) {
          require MODELS . 'Category.php';
          $categoryBeforeUpdate = getCategory("", $slug);
          $categoryByTitle = getCategory($_POST['category'], "");
          $categoryBySlug = getCategory("", $_POST['slug']);

          if ($categoryByTitle && ($categoryByTitle['category'] == $_POST['category']) && ($_POST['category'] != $categoryBeforeUpdate['category'])) {
              $_SESSION["error"]["category"] = "Le titre existe déjà";
              header("Location: /category/". $slug ."/edit");
          } elseif ($categoryBySlug && ($categoryBySlug['slug'] == $_POST['slug']) && ($_POST['slug'] != $categoryBeforeUpdate['slug'])) {
              $_SESSION["error"]["slug"] = "Cette URL existe déjà";
              header("Location: /category/". $slug ."/edit");
          } else {
              $slugNew = updateCategory($slug);
              header('Location: /category/'. $slugNew .'');
          }
       } else {
           header("Location: /category/". $slug ."/edit");
       }
   } else {
       header("Location: /category/". $slug ."/edit");
   }
}
