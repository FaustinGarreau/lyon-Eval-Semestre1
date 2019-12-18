<?php

function bookCreate() {
    require VIEWS . "books/create.php";
}

function bookStore() {

    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['author']) && isset($_POST['slug']) && isset($_POST['date'])) {
        $_SESSION['title'] = $_POST['title'];
        $_SESSION['description'] = $_POST['description'];
        $_SESSION['author'] = $_POST['author'];
        $_SESSION['slug'] = $_POST['slug'];
        $_SESSION['date'] = $_POST['date'];
        if (empty($_SESSION['title'])) {
            $_SESSION['errors']['titleErr'] = "le title est requis";
        }else if (!preg_match('#^[A-Za-z-]{2,}$#', $_SESSION['title'])) {
            $_SESSION['errors']['titleErr'] = "Format incorrect (au moins 2 caractères)";
        } else {
            $_SESSION['title'] = $_SESSION['title'];
        }
        if (empty($_SESSION['author'])) {
            $_SESSION['errors']['authorError'] = "l'auteur est requis";
        }else if (!preg_match('#^[A-Za-z-]{1,}$#', $_SESSION['author'])) {
            $_SESSION['errors']['authorError'] = "Format incorrect il ne faut que des lettres ou des -";
        } else {
            $_SESSION['author'] = $_SESSION['author'];
        }
        if (empty($_SESSION['description'])) {
            $_SESSION['errors']['descriptionError'] = "la description est requis";
        }else if (!preg_match('#^[A-Za-z-() ]{1,}$#', $_SESSION['description'])) {
            $_SESSION['errors']['descriptionError'] = "Format incorrect il ne faut que des lettres, de - ou des ()";
        } else {
            $_SESSION['description'] = $_SESSION['description'];
            }
        if (empty($_POST['slug'])) {
            $_SESSION['errors']['slugErr'] = "le contenu est requis";
        }
        if (empty($_POST['date'])) {
            $_SESSION['errors']['dateErr'] = "le contenu est requis";
        }
        if (!isset($_SESSION['errors'])) {
            require MODELS.'book.php';
            $title = gettitle($_POST['title']);
            $slug = getBook($_POST['slug']);
            if ($title) {
                $_SESSION['errors']['titleErr'] = 'Le titre est déjà pris';
                header('Location: /livres/nouveau');
                exit();
            }
            if ($slug) {
                $_SESSION['errors']['slugErr'] = 'Le slug est déjà pris';
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
    //apeler le model
    //require MODELS.'book.php';
    //storeBook();
    //header('Location: /livres');
    //fonction model
    //redirection
}

function bookIndex() {
    require MODELS . 'book.php';
    $books=getBooks();
    require VIEWS . "books/index.php";
}

function bookShow($slug) {
    require MODELS . 'book.php';
    $book = getbook($slug);
    require VIEWS . 'books/show.php';
}

function bookDelete($slug) {
    require MODELS.'book.php';
    deleteBook($slug);
    header('Location: /livres');
}

function bookEdit($slug) {
    require MODELS.'book.php';
    $book = getBook($slug);
    require VIEWS.'books/edit.php';
}

function bookUpdate($slug) {
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['author']) && isset($_POST['slug']) && isset($_POST['date'])) {
        $_SESSION['title'] = $_POST['title'];
        $_SESSION['description'] = $_POST['description'];
        $_SESSION['author'] = $_POST['author'];
        $_SESSION['slug'] = $_POST['slug'];
        $_SESSION['date'] = $_POST['date'];
       
        if (empty($_POST['title'])) {
            $_SESSION['errors']['titleErr'] = "le title est requis";
        }
        if (empty($_POST['description'])) {
            $_SESSION['errors']['descErr'] = "le contenu est requis";
        }
        if (empty($_POST['author'])) {
            $_SESSION['errors']['authorErr'] = "le contenu est requis";
        }
        if (empty($_POST['slug'])) {
            $_SESSION['errors']['slugErr'] = "le contenu est requis";
        }
        if (empty($_POST['date'])) {
            $_SESSION['errors']['dateErr'] = "le contenu est requis";
        }
        if (!isset($_SESSION['errors'])) {
            require MODELS.'book.php';
            updateBook($slug);
            header('Location: /livres/' . $_POST['slug']);
        } else {
            header('Location: /livres/' . $slug . '/edit');
            exit();
        }
    }
            
            
            
}
