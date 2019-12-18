<?php

function bookIndex() {
    require MODELS.'livre.php';
    $livres = getBooks();
    require VIEW .'/books/index.php';
}

function bookCreate() {
        require VIEW .'/books/create.php';
}
function bookStore() {

    if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['description']) && isset($_POST['slug']) && isset($_POST['date'])) {
        if (empty($_POST['title'])) {
            $_SESSION['errors']['title'] = "Le champ est requis";
        }
        if (empty($_POST['author'])) {
            $_SESSION['errors']['author'] = "Le champ est requis";
        }
        if (empty($_POST['description'])) {
            $_SESSION['errors']['description'] = "Le champ est requis";
        }
        if (empty($_POST['slug'])) {
            $_SESSION['errors']['slug'] = "Le champ est requis";
        }
        if (empty($_POST['date'])) {
            $_SESSION['errors']['date'] = "Le champ est requis";
        }
        if (!isset($_SESSION['errors'])) {
            require MODELS .'livre.php';
        //qlq chose a mettre pour ne pas ecrir 2 fois le meme slug
            storeBook();
            header('Location: /livres');
        }
        else {
            header('Location: /livres/nouveau');
        }
    }
}

function bookShow($slug) {
    //echo 2;
    require MODELS .'livre.php';
    $book = getBook($slug);
    if ($book) {
        require VIEW .'books/show.php';
    } else {
        header('Location: /livres');
        exit();
    }
}

function deleteBook($param) {
require MODEL .'livre.php';
bookDelete($param);
header('Location: /livres');
}