<?php
function livreIndex(){
    require MODELS.'Livre.php';
    $book= getLivres();
    require VIEWS.'books/index.php';
}
function livreShow($slug){
    require MODELS.'Livre.php';
    $book = getLivre($slug);
    require VIEWS.'books/show.php';
}
function livreCreate(){
    require VIEWS . 'books/create.php';
}
function livreStore(){
    if (isset($_POST['title']) and isset($_POST['author']) and isset($_POST['description']) and isset($_POST['slug'])) {
        // si vide => erreur
        if (empty($_POST['title'])) {
            $_SESSION['errors']['title'] = 'Le champ titre est requis';
        }

        if (empty($_POST['author'])) {
            $_SESSION['errors']['author'] = 'Le champ auteur est requis';
        }

        if (empty($_POST['description'])) {
            $_SESSION['errors']['description'] = 'Le champ description est requis';
        }

        if (empty($_POST['slug'])) {
            $_SESSION['errors']['slug'] = 'Le champ slug est requis';
        }

        if (empty($_POST['date'])) {
            $_SESSION['errors']['date'] = 'Le champ date est requis';
        }

        if (!isset($_SESSION['errors'])) {
                //model
            require MODELS.'Livre.php';
            // fct du model
            storeLivre();
            // redirige vers  livre header()
            header('location: /livres/' . $_POST['slug']);
            exit();
        }
    }
    header('Location: /livres/nouveau');
    exit();
}
function livreEdit($slug){
    // recuperer livre => 
    require MODELS.'Livre.php';
    $book = getLivre($slug);
    require VIEWS.'books/edit.php';
}
function livreUpdate($slug){

    // si existe
    if (isset($_POST['author']) and isset($_POST['title']) and isset($_POST['description']) and isset($_POST['slug'])) {
        // si vide => erreur
        if (empty($_POST['author'])) {
            $_SESSION['errors']['author'] = 'Le champ auteur est requis';
        }

        if (empty($_POST['title'])) {
            $_SESSION['errors']['title'] = 'Le champ title est requis';
        }

        if (empty($_POST['description'])) {
            $_SESSION['errors']['description'] = 'Le champ description est requis';
        }

        if (empty($_POST['slug'])) {
            $_SESSION['errors']['slug'] = 'Le champ slug est requis';
        }

        if (!isset($_SESSION['errors'])) {
                //model
            require MODELS.'Livre.php';
            // fct du model
            updateLivre($slug);
            // redirige vers livre header()
            header('location: /livres/' . $_POST['slug']);
        } else {
            header('Location: /livres/' . $slug . '/edit');
        }
    }
    else {
        header('Location: /livres/' . $slug . '/edit');
    }
    
    
    // sinon redirige vers /livres
}
function livreDelete($slug){
    require MODELS . 'Livre.php';
    deleteLivre($slug);
    header('Location: /livres');
}