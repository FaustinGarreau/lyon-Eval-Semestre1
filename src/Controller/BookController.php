<?php
function bookCreate(){
    require VIEW . 'create.php';
}

function bookStore(){
    if (isset($_POST['title']) && isset($_POST["slug"]) && isset($_POST["description"] )&& isset($_POST["date"]) && isset($_POST["author"])) {
        // vide => erreur
        if (empty($_POST['title'])) {
            $_SESSION['errors']["title"] = "Le titre est requis";
        }
        if (empty($_POST["slug"])) {
            $_SESSION['errors']["slug"] = "Le slug est requis";
        }
        if (empty($_POST["description"])) {
            $_SESSION['errors']["description"] = "La description est requise";
        }
        if (empty($_POST["author"])) {
            $_SESSION['errors']["author"] = "L'auteur est requis";
        }
        if (empty($_POST["date"])) {
            $_SESSION['errors']["date"] = "La date de creation est requise";
        }
        if ($_SESSION["errors"]) {
            header("Location: http://localhost:8000/livres/nouveau");
        } else {
                Require MODEL . 'Book.php';
                storeBook();
                header('Location: /livres/' . $_POST['slug']);
                exit();
        }
    }

}

function bookShow($param){
    Require MODEL . 'Book.php';
    $book = showBook($param);
    require VIEW . 'show.php';
}
function bookIndex(){
    Require MODEL . 'Book.php';
    $books = getBooks();
    require VIEW . 'index.php';
}
function bookEdit($param){
    Require MODEL . 'Book.php';
    $book = getBook($param);
    require VIEW . 'edit.php';
}
function bookUpdate($param){
    Require MODEL . 'Book.php';
    updateBook($param);
    header('Location: /livres');
}
function bookDelete($param){
    Require MODEL . 'Book.php';
    deleteBook($param);
    header('Location: /livres');
}