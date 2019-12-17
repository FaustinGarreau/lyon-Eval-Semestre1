<?php

function bookIndex() {
    require MODELS.'livre.php';
    $livre = getBooks();
    require VIEWS .'/books/index.php';
}

function bookCreate() {
        require VIEWS .'/books/create.php';
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
            bookCreate();
            header('Location : /livres');
        }
        else {
            header('Location : /livres/nouveau');
        }
    }

} 