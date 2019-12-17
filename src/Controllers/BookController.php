<?php
function bookCreate() {
    if (!isLogin()) {
        header("Location: /livres/");
        die();
    }
    require VIEWS.'books/create.php';
}

function bookIndex() {
    require MODELS."Books.php";
    $books = getBooks();
    require VIEWS.'books/index.php';
}

function bookShow($slug) {
    require MODELS."Books.php";
    $book = getBook($slug);
    require VIEWS.'books/show.php';
}

function bookEdit($slug) {
    if (!isLogin()) {
        header("Location: /livres/");
        die();
    }
    require MODELS."Books.php";
    $book = getBook($slug);
    require VIEWS.'books/edit.php';
}

// Back

function bookDelete($slug) {
    if (!isLogin()) {
        header("Location: /livres/");
        die();
    }
    require MODELS."Books.php";
    $book = deleteBook($slug);
    header("Location: /livres/");
}

function bookStore() {
    if (!isLogin()) {
        header("Location: /livres/");
        die();
    }
    $_SESSION["old"] = $_POST;

    // Is title empty
    if (!isset($_POST["title"]) || empty(escape($_POST["title"]))) {
        setError("title", "Ce champ est requis");
    }
    // Is title between 2 and 180 charactèrs
    elseif (!preg_match("#^.{2,180}$#", escape($_POST["title"]))) {
        setError("title", "Le titre doit avoir entre 2 et 180 caractères");
    }

    // Is slug valid
    if (isset($_POST["slug"]) && !empty($_POST["slug"]) && escape($_POST["slug"]) != slugify(escape($_POST["slug"]))) {
        setError("slug", "Le slug est invalide");
    }

    // Is author empty
    if (!isset($_POST["author"]) || empty(escape($_POST["author"]))) {
        setError("author", "Ce champ est requis");
    }
    // Is author valid
    elseif (!preg_match("#^[a-zA-Z ]{2,200}$#", escape($_POST["author"]))) {
        setError("author", "L'auteur doit avoir entre 2 et 180 lettres-espaces");
    }

    // Is description empty
    if (!isset($_POST["description"]) || empty(escape($_POST["description"]))) {
        setError("description", "Ce champ est requis");
    }

    // Is date empty
    if (!isset($_POST["date"]) || empty(escape($_POST["date"]))) {
        setError("date", "Ce champ est requis");
    }
    // Is date valid
    elseif (!preg_match("#^\d{4}-\d{2}-\d{2}$#", escape($_POST["date"]))) {
        setError("date", "La date n'est pas valide");
    }

    // Is form valid
    if (!hasError()) {
        require MODELS."Books.php";
        $slug = $_POST["slug"] ?: slugify($_POST["title"]);
        // Is another with same slug exists
        if (getBook($slug)) {
            setError("slug", "Cette url est déjà prise (".$slug.").");
            header("Location: /nouveau/");
            die();
        }
        storeBook($_POST["author"], $slug, $_POST["title"], $_POST["description"], $_POST["date"]);
        header("Location: /livres/".$slug."/");
        die();
    }
    header("Location: /nouveau/");
    die();
}

function bookUpdate($slug) {
    if (!isLogin()) {
        header("Location: /livres/");
        die();
    }
    $_SESSION["old"] = $_POST;

    // Is title empty
    if (!isset($_POST["title"]) || empty(escape($_POST["title"]))) {
        setError("title", "Ce champ est requis");
    }
    // Is title between 2 and 180 charactèrs
    elseif (!preg_match("#^.{2,180}$#", escape($_POST["title"]))) {
        setError("title", "Le titre doit avoir entre 2 et 180 caractères");
    }

    // Is slug valid
    if (isset($_POST["slug"]) && !empty($_POST["slug"]) && escape($_POST["slug"]) != slugify(escape($_POST["slug"]))) {
        setError("slug", "Le slug est invalide");
    }

    // Is author empty
    if (!isset($_POST["author"]) || empty(escape($_POST["author"]))) {
        setError("author", "Ce champ est requis");
    }
    // Is author valid
    elseif (!preg_match("#^[a-zA-Z ]{2,200}$#", escape($_POST["author"]))) {
        setError("author", "L'auteur doit avoir entre 2 et 180 lettres-espaces");
    }

    // Is description empty
    if (!isset($_POST["description"]) || empty(escape($_POST["description"]))) {
        setError("description", "Ce champ est requis");
    }

    // Is date empty
    if (!isset($_POST["date"]) || empty(escape($_POST["date"]))) {
        setError("date", "Ce champ est requis");
    }
    // Is date valid
    elseif (!preg_match("#^\d{4}-\d{2}-\d{2}$#", escape($_POST["date"]))) {
        setError("date", "La date n'est pas valide");
    }

    // Is form valid
    if (!hasError()) {
        require MODELS."Books.php";
        $newslug = $_POST["slug"] ?: slugify($_POST["title"]);
        // Is another with same slug exists
        $book = getBook($newslug);
        if ($book && $book["slug"] != $slug) {
            setError("slug", "Cette url est déjà prise (".$newslug.").");
            header("Location: /livres/".$slug."/edit");
            die();
        }
        updateBook($slug, $_POST["author"], $newslug, $_POST["title"], $_POST["description"], $_POST["date"]);
        header("Location: /livres/".$newslug."/");
        die();
    }
    header("Location: /livres/".$slug."/edit");
    die();
}
