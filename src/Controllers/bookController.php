<?php

// get
function renderCreateBook() {
    require(MODELS."book.php");
    require(VIEWS."/books/create.php");
}
function renderBooks() {
    require(MODELS."book.php");
    require(VIEWS."/books/index.php");
}
// post
function newBook() {
    $_SESSION["error"]["newBook"] = [];
    $_SESSION["value"]["newBook"] = $_POST;
    foreach ($_POST as $key => $value) {
        if ($value == "") {
            $_SESSION["error"]["newBook"] = array_merge($_SESSION["error"]["newBook"], [$key => "ce champs est requis"]);
        }
    }
    if (!preg_match("/^.{2,800}$/", $_POST["description"]) && !isset($_SESSION["error"]["newBook"]["description"])) {
        $_SESSION["error"]["newBook"] = array_merge($_SESSION["error"]["newBook"], ["description" => "format incorect, 2 caractère minimun et 800 caractrère max"]);
    }
    if (!preg_match("/^[a-zA-Z-]{2,255}$/", $_POST["author"]) && !isset($_SESSION["error"]["newBook"]["author"])) {
        $_SESSION["error"]["newBook"] = array_merge($_SESSION["error"]["newBook"], ["author" => "format incorect, 2 caractère minimun"]);
    }
    if (!preg_match("/^[a-zA-Z-]{2,255}$/", $_POST["title"]) && !isset($_SESSION["error"]["newBook"]["title"])) {
        $_SESSION["error"]["newBook"] = array_merge($_SESSION["error"]["newBook"], ["title" => "format incorect, 2 caractère minimun"]);
    }
    if (!preg_match("/^[0-9]{1,4}+\-[0-9]{1,2}+\-[0-9]{1,2}$/", $_POST["date"]) && !isset($_SESSION["error"]["newBook"]["date"])) {
        $_SESSION["error"]["newBook"] = array_merge($_SESSION["error"]["newBook"], ["author" => "format incorect"]);
    }
    if (!preg_match("/^[a-z0-9-]{2,255}$/", $_POST["slug"]) && !isset($_SESSION["error"]["newBook"]["slug"])) {
        $_SESSION["error"]["newBook"] = array_merge($_SESSION["error"]["newBook"], ["slug" => "format incorect"]);
    }
    //var_dump($_POST);

    if (count($_SESSION["error"]["newBook"]) == 0) {
        global $bdd;
        $req = $bdd->prepare('INSERT INTO book (title, slug, author, description, date)
        VALUES (:title, :slug, :author, :description, :date)
        ');
        $req->execute([
            "title" => escape($_POST["title"]),
            "slug" => escape($_POST["slug"]),
            "author" => escape($_POST["author"]),
            "description" => escape($_POST["description"]),
            "date" => escape($_POST["date"])
        ]);
        header("Location : /livres/nouveau");
    }
    header("Location : /livres/nouveau");

}

?>