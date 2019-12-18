<?php 
// j'appelle le model
require MODELS.'Book.php';
    // je crée la fonction que j'ai appellé dans Book.php
    function bookIndex() {
            $books = getBooks();
            //j'appelle la View
            require VIEWS.'index.php';
        }

    function bookCreate() {
        require VIEWS.'create.php';
    }

    function bookShow($slug) {
        $book = getBook($slug);
        if ($book) {
            require VIEWS.'show.php';
        } else {
            header('Location: /404');
        }
    }

    function bookStore() {
        // Erreur pour dire si tout existe
        if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["description"]) && isset($_POST["date"]) && isset($_POST["slug"])) {
            $_SESSION['title'] = $_POST['title'];
            $_SESSION['author'] = $_POST['author'];
            $_SESSION['description'] = $_POST['description'];
            $_SESSION['date'] = $_POST['date'];
            $_SESSION['slug'] = $_POST['slug'];
            //Erreur pour voir si c'est vide
            if (empty($_SESSION['title'])) {
                $_SESSION['error']['titleError'] = "le title est requis";
                //On utilise preg_match pour voir quel syntaxe utiliser
            }else if (!preg_match('#^[A-Za-z-]{2,}$#', $_SESSION['title'])) {
                $_SESSION['error']['titleError'] = "Format incorrect (au moins 2 caractères)";
            } else {
                $_SESSION['title'] = $_SESSION['title'];
            }
        
            if (empty($_SESSION['author'])) {
                $_SESSION['error']['authorError'] = "l'auteur est requis";
            }else if (!preg_match('#^[A-Za-z-]{1,}$#', $_SESSION['author'])) {
                $_SESSION['error']['authorError'] = "Format incorrect il ne faut que des lettres ou des -";
            } else {
                $_SESSION['author'] = $_SESSION['author'];
            }

            if (empty($_SESSION['description'])) {
                $_SESSION['error']['descriptionError'] = "la description est requis";
            }else if (!preg_match('#^[A-Za-z-() ]{1,}$#', $_SESSION['description'])) {
                $_SESSION['error']['descriptionError'] = "Format incorrect il ne faut que des lettres, de - ou des ()";
            } else {
                $_SESSION['description'] = $_SESSION['description'];
            }

            if (empty($_SESSION['date'])) {
                $_SESSION['error']['dateError'] = "la date est requis";
            } else {
                $_SESSION['date'] = $_SESSION['date'];
            }

            if (empty($_SESSION['slug'])) {
                $_SESSION['error']['slugError'] = "le slug est requis";
            } else {
                $_SESSION['slug'] = $_SESSION['slug'];
            }


            //On demande si il n'y a pas d'erreur on vérifie si le title ou le slug sont déjà utiliser si ils sont déjà utiliser on fait une erreur sinon on redirige vers l'articles
            if (!isset($_SESSION['errors'])) {
                $title = getTitle($_POST['title']);
                $slug = getSlug($_POST['slug']);
                if ($title) {
                    $_SESSION['error']['titleError'] = 'Il y a déjà ce titre utilsé dans un autre livre';
                    header('Location: /livres/nouveau');
                    exit();
                }
                if ($slug) {
                    $_SESSION['error']['slugError'] = 'Il y a déjà ce slug utilsé dans un autre livre';
                    header('Location: /livres/nouveau');
                    exit();
                }
                storeBook();
                header('Location: /livres/' . $_POST['slug']);
            } else {
                header('Location: /livres/nouveau');
                exit();
            }
        }
    }

    function bookDelete($slug) {
        deleteBook($slug);
        header('Location: /livres');
    }

    function bookEdit($slug) {
        $book = getBook($slug);
        if ($book) {
            require VIEWS.'edit.php';
        } else {
            header('Location: /404');
        }
    }
    function bookUptade($slug) {
        if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['description']) && isset($_POST['slug']) && isset($_POST['date'])) {
            $_SESSION['title'] = $_POST['title'];
            $_SESSION['author'] = $_POST['author'];
            $_SESSION['description'] = $_POST['description'];
            $_SESSION['slug'] = $_POST['slug'];
            $_SESSION['date'] = $_POST['date'];

            if (empty($_SESSION['title'])) {
                $_SESSION['error']['titleErr'] = "le title est requis";
            }else if (!preg_match('#^[A-Za-z-]{2,}$#', $_SESSION['title'])) {
                $_SESSION['error']['titleErr'] = "Format incorrect (au moins 2 caractères)";
            } else {
                $_SESSION['title'] = $_SESSION['title'];
            }
        
            if (empty($_SESSION['author'])) {
                $_SESSION['error']['authorErr'] = "l'auteur est requis";
            }else if (!preg_match('#^[A-Za-z-]{1,}$#', $_SESSION['author'])) {
                $_SESSION['error']['authorErr'] = "Format incorrect il ne faut que des lettres ou des -";
            } else {
                $_SESSION['author'] = $_SESSION['author'];
            }

            if (empty($_SESSION['description'])) {
                $_SESSION['error']['descriptionErr'] = "la description est requis";
            }else if (!preg_match('#^[A-Za-z-() ]{1,}$#', $_SESSION['description'])) {
                $_SESSION['error']['descriptionErr'] = "Format incorrect il ne faut que des lettres, de - ou des ()";
            } else {
                $_SESSION['description'] = $_SESSION['description'];
            }

            if (empty($_SESSION['date'])) {
                $_SESSION['error']['dateErr'] = "la date est requis";
            } else {
                $_SESSION['date'] = $_SESSION['date'];
            }

            if (empty($_SESSION['slug'])) {
                $_SESSION['error']['slugErr'] = "le slug est requis";
            } else {
                $_SESSION['slug'] = $_SESSION['slug'];
            }

            if (!isset($_SESSION['error'])) {
                uptadeBook($slug);
                header('Location: /livres/'. $_POST['slug']);

            } else {
                header('Location: /livres/' . $slug . '/edit');
            }
        
    }

}
?>