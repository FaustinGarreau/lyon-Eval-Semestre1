<?php

function bookCreate() {
    require VIEWS . 'books/create.php';
}

function bookStore() {
    if (isset($_POST["title"]) && isset($_POST['author']) && isset($_POST["slug"]) && isset($_POST["description"]) ) {
        
        if (empty($_POST["title"])) {
            $_SESSION['errors']["titleErr"] = "Title is required";
        }
        if (empty($_POST["author"])) {
            $_SESSION['errors']["authorErr"] = "Author is required";
        }
        if (empty($_POST["slug"])) {
            $_SESSION['errors']["slugErr"] = "Slug is required";
        }
        if (empty($_POST["description"])) {
            $_SESSION['errors']["descriptionErr"] = "Description is required";
        }
        if (empty($_POST["date"])) {
            $_SESSION['errors']["dateErr"] = "Date is required";
        }


        if (!isset($_SESSION["errors"])) {
            require MODELS . "BookModel.php";
            storeBook();
            header("Location: /books");
            exit();
        } else {
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