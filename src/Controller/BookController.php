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
            $_SESSION['errors']["contenu"] = "La description est requise";
        }
        if (empty($_POST["author"])) {
            $_SESSION['errors']["contenu"] = "L'auteur est requis";
        }
        if (empty($_POST["date"])) {
            $_SESSION['errors']["contenu"] = "La date de creation est requise";
        }
        if ($_SESSION["errors"]) {
            header("Location: http://localhost:8000/livres/nouveau");
        } else {
                Require MODEL . 'Book.php';
                storeBook();
                header('Location: /book/' . $_POST['slug']);
                exite();
        }
        
    }
}