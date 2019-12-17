<?php 
    function bookIndex() {
            require MODELS.'Book.php';
            $books = getBooks();
            require VIEWS.'index.php';
        }

    function bookCreate() {
        require VIEWS.'create.php';
    }

    function bookShow($slug) {
        require MODELS.'Book.php';
        $book = getBook($slug);
        if ($book) {
            require VIEWS.'show.php';
        } else {
            header('Location: /404');
        }
    }

    function bookStore() {
        require MODELS.'Book.php';
        storeBook();
        header('Location: /livres');
    }

    function bookDelete($slug) {
        require MODELS.'Book.php';
        deleteBook($slug);
        header('Location: /livres');
    }

    function bookEdit($slug) {
        require MODELS.'Book.php';
        $book = getBook($slug);
        if ($book) {
            require VIEWS.'edit.php';
        } else {
            header('Location: /404');
        }
    }
    function bookUptade($slug) {
        if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['description'])) {
            $_SESSION['title'] = $_POST['title'];
            $_SESSION['author'] = $_POST['author'];
            $_SESSION['description'] = $_POST['description'];
            if (empty($_POST['title'])) {
                $_SESSION['error']['titleErr'] = "le title est requis";
            }
            if (empty($_POST['author'])) {
                $_SESSION['error']['authorErr'] = "l'auteur est requis";
            }
            if (empty($_POST['contenu'])) {
                $_SESSION['error']['contenuErr'] = "le contenu est requis";
            }
            if (!isset($_SESSION['error'])) {
                
                require MODELS.'Book.php';
                uptadeBook($slug);
                header('Location: /livres/' . $_POST['slug']);

            } else {
                header('Location: /livres' . $slug . '/edit');
            }
        
    }

}
?>