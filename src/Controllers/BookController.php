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
?>