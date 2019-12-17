<?php 
    function bookIndex() {
            require MODELS.'Book.php';
            $books = getBooks();
            require VIEWS.'index.php';
        }

    function bookCreate() {
        require VIEWS.'create.php';
    }

    function bookShow($slug) {
        require MODELS.'Book.php';
        $book = getBook($slug);
        if ($book) {
            require VIEWS.'show.php';
        } else {
            header('Location: /404');
        }
    }

    function bookStore() {
        if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["description"])) {
            $_SESSION['title'] = $_POST['title'];
            $_SESSION['author'] = $_POST['author'];
            $_SESSION['description'] = $_POST['description'];
            if (empty($_SESSION['title'])) {
                $_SESSION['error']['titleError'] = "le title est requis";
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


                if (!isset($_SESSION['errors'])) {
                    require MODELS.'Book.php';
                    $title = getTitle($_POST['title']);
                    $slug = getBook($_POST['slug']);
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
                    bookStore();
                    header('Location: /livres/' . $_POST['slug']);
                } else {
                    header('Location: /livres/nouveau');
                    exit();
                }


            if (!isset($_SESSION['error'])) {
                require MODELS.'Book.php';
                storeBook();
                header('Location: /livres');

            } else {
                header('Location: /livres/nouveau');
            }
    }
    }

    function bookDelete($slug) {
        require MODELS.'Book.php';
        deleteBook($slug);
        header('Location: /livres');
    }

    function bookEdit($slug) {
        require MODELS.'Book.php';
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

            if (empty($_POST['title'])) {
                $_SESSION['error']['titleErr'] = "le title est requis";
            }
            if (empty($_POST['author'])) {
                $_SESSION['error']['authorErr'] = "l'auteur est requis";
            }
            if (empty($_POST['description'])) {
                $_SESSION['error']['descriptionErr'] = "la description est requis";
            }
            if (empty($_POST['slug'])) {
                $_SESSION['error']['slugErr'] = "le slug est requis";
            }
            if (empty($_POST['date'])) {
                $_SESSION['error']['dateErr'] = "la date est requis";
            }

            if (!isset($_SESSION['error'])) {
                require MODELS.'Book.php';
                uptadeBook($slug);
                header('Location: /livres/'. $_POST['slug']);

            } else {
                header('Location: /livres/' . $slug . '/edit');
            }
        
    }

}
?>