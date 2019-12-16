<?php

require MODELS . 'Book.php';

function bookIndex() {
    $books = getBooks();
    require VIEWS . 'books/index.php';    
}

function bookShow($slug) {
    $book = getBook($slug);
    if (!$book) {
        header('Location: /404');
        exit();
    }
    require VIEWS . 'books/show.php';
}

function bookEdit($slug) {
    
    $book = getBook($slug);
    if (!$book) {
        header('Location: /404');
        exit();
    }
    require VIEWS . 'books/edit.php';
}

function bookUpdate($slug) {
    if (isset($_POST['title']) && isset($_POST['slug']) && isset($_POST['description']) && isset($_POST['date'])) {
        if (empty($_POST['title'])) {
            $_SESSION['errors']['title'] = 'Le champs est requis';
        }

        if (empty($_POST['author'])) {
            $_SESSION['errors']['author'] = 'Le champs est requis';
        }

        if (empty($_POST['slug'])) {
            $_SESSION['errors']['slug'] = 'Le champs est requis';
        }

        if (empty($_POST['description'])) {
            $_SESSION['errors']['description'] = 'Le champs est requis';
        }

        if (empty($_POST['date'])) {
            $_SESSION['errors']['date'] = 'Le champs est requis';
        }

        if ($book = getBook($_POST['slug'])) {
            $_SESSION['error']['title'] = "Ce livre existe déjà !";
        }

        if (!isset($_SESSION['errors'])) {
            updateBook($slug);
            header('Location: /livres/' . ($_POST['slug'] ?? ""));
            exit();
        }
    }
    header('Location: /livres/' . $slug . '/edit');
    exit();
    
}

function bookCreate() {
    require VIEWS . 'books/create.php';
}

function bookStore() {
    if (isset($_POST['title']) && isset($_POST['slug']) && isset($_POST['description']) && isset($_POST['date'])) {
        $_SESSION['old'] = $_POST;
        if (empty($_POST['title'])) {
            $_SESSION['errors']['title'] = 'Le champs est requis';
        }

        if (empty($_POST['author'])) {
            $_SESSION['errors']['author'] = 'Le champs est requis';
        }

        if (empty($_POST['slug'])) {
            $_SESSION['errors']['slug'] = 'Le champs est requis';
        }

        if (empty($_POST['description'])) {
            $_SESSION['errors']['description'] = 'Le champs est requis';
        }

        if (empty($_POST['date'])) {
            $_SESSION['errors']['date'] = 'Le champs est requis';
        }

        if ($book = getBook($_POST['slug'])) {
            $_SESSION['error']['title'] = "Ce livre existe déjà !";
        }

        if (!isset($_SESSION['errors'])) {
            storeBook();
            header('Location: /livres');
            exit();
        }
    }
    header('Location: /livres/nouveau');
    exit();
}

function bookDelete($slug) {
    deleteBook($slug);
    header('Location: /livres');
    exit();
}
    
