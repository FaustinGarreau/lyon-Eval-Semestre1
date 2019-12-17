<?php

function bookCreate() {
    require VIEWS . "books/create.php";
}

function bookStore() {
    
    
    //apeler le model
    require MODELS.'book.php';
    storeBook();
    header('Location: /livres');
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
            $_SESSION['error']['titleErr'] = "le title est requis";
        }
        if (empty($_POST['description'])) {
            $_SESSION['error']['descErr'] = "le contenu est requis";
        }
        if (empty($_POST['author'])) {
            $_SESSION['error']['authorErr'] = "le contenu est requis";
        }
        if (empty($_POST['slug'])) {
            $_SESSION['error']['slugErr'] = "le contenu est requis";
        }
        if (empty($_POST['date'])) {
            $_SESSION['error']['dateErr'] = "le contenu est requis";
        }
        if (!isset($_SESSION['error'])) {
            require MODELS.'book.php';
            updateBook($slug);
            header('Location: /livres/' . $_POST['slug']);
        } else {
            header('Location: /livres/' . $slug . '/edit');
             
        }
    }
            
            
            
}
