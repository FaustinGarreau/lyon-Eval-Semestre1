<?php

function bookCreate() {
    // on affiche la page de creation d'un book
    require VIEWS . 'books/create.php';
}

function bookStore() {
    // on verifie si sa existe 
    if (isset($_POST["title"]) && isset($_POST['author']) && isset($_POST["slug"]) && isset($_POST["description"]) && isset($_POST["date"]) ) {
        // on verifie si c'est vide si oui alors on affiche une erreur
        if (empty($_POST["title"])) {
            $_SESSION['errors']["titleErr"] = "Title is required";
        } 
        // on verifie si c'est vide si oui alors on affiche une erreur
        if (empty($_POST["author"])) {
            $_SESSION['errors']["authorErr"] = "Author is required";
        }
        // on verifie si c'est vide si oui alors on affiche une erreur
        if (empty($_POST["slug"])) {
            $_SESSION['errors']["slugErr"] = "Slug is required";
        } 
        // on verifie si c'est vide si oui alors on affiche une erreur 
        if (empty($_POST["description"])) {
            $_SESSION['errors']["descriptionErr"] = "Description is required";
        }
        // on verifie si c'est vide si oui alors on affiche une erreur
        if (empty($_POST["date"])) {
            $_SESSION['errors']["dateErr"] = "Date is required";
        }

        // on verifie si y'a pas d'erreurs si oui on cree le book et on redirige vers la pages des books
        if (!isset($_SESSION["errors"])) {
            require MODELS . "BookModel.php";
            storeBook();
            header("Location: /books");
            exit();
        } 
        // sinon on redirige vers la page de creation d'un book et on affiche les erreurs
        else {
            header('Location: /books/create');
            exit();
        }

        
    }
}

function booksGet() {
    require MODELS . 'BookModel.php';
    $books = getBooks();
    require VIEWS . 'books/index.php';
}

function bookShow($slug) {
    require MODELS . 'BookModel.php';
    $book = getBook($slug);
        // on verifie si book existe
    if ($book) {
        require VIEWS . 'books/show.php';
    } else {
        header("Location: /books");
    }
}


function bookUpdate($slug) {
    // on verifie si sa existe 
    if (isset($_POST["title"]) && isset($_POST['author']) && isset($_POST["slug"]) && isset($_POST["description"]) && isset($_POST["date"]) ) {
        // on verifie si c'est vide si oui alors on affiche une erreur
        if (empty($_POST["title"])) {
            $_SESSION['errors']["titleErr"] = "Title is required";
        }
        // on verifie si c'est vide si oui alors on affiche une erreur
        if (empty($_POST["author"])) {
            $_SESSION['errors']["authorErr"] = "Author is required";
        }
        // on verifie si c'est vide si oui alors on affiche une erreur
        if (empty($_POST["slug"])) {
            $_SESSION['errors']["slugErr"] = "Slug is required";
        }
        // on verifie si c'est vide si oui alors on affiche une erreur
        if (empty($_POST["description"])) {
            $_SESSION['errors']["descriptionErr"] = "Description is required";
        }
        // on verifie si c'est vide si oui alors on affiche une erreur
        if (empty($_POST["date"])) {
            $_SESSION['errors']["dateErr"] = "Date is required";
        }

        // on verifie si y'a pas d'erreurs si oui on met a jour le book et on redirige vers la pages des books
        if (!isset($_SESSION["errors"])) {
            require MODELS . "BookModel.php";
            updateBook($slug);
            header("Location: /books");
            exit();
        } 
        // sinon on redirige vers la page de modification avec les erreurs
        else {
            header('Location: /books/' . $slug . '/edit');
            exit();
        }

        
    }
}

function bookEdit($slug) {
    require MODELS . 'BookModel.php';
    $book = getBook($slug);
    // on verifie si book existe 
    if ($book) {
        require VIEWS . 'books/edit.php';
    } else {
        header('Location: /books/edit');
    }
}


function bookDelete($slug) {
    // on va cherche dans le model la function deleteBook($slug) pour supprimer ce book puis on redirige vers la page des books
    require MODELS . 'BookModel.php';
    deleteBook($slug);
    header('Location: /books');
}