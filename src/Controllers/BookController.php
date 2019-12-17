<?php

// GET FUNCTIONS

//Show ALL books
function bookIndex()
{
    require(MODELS."Book.php");
    $books = getBooks();

    //require VIEW
    require(VIEWS.'books/index.php');
}

//Show one book
function bookShow($slug) {
    require(MODELS."Book.php");
    $book = getBook($slug);

    //require VIEW
    require(VIEWS.'books/show.php');
}

//Go to creation page
function bookCreate() {
    //require VIEW
    require(VIEWS.'books/create.php');
}

//Go to edit page
function bookEdit($slug) {
    require(MODELS."Book.php");
    $book = getBook($slug);

    //require VIEW
    require(VIEWS.'books/edit.php');
}

// POST FUNCTIONS

//Delete book
function bookDelete($slug)
{
    require(MODELS."Book.php");
    deleteBook($slug);

    header("Location: /livres");
}

//Creation Verification
function bookStore() {

    $validCount = 0;

    //CHECK POST
    if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["description"]) && isset($_POST["slug"]) && isset($_POST["date"])) {

        //store last values
        $_SESSION["old"]["title"] = $_POST["title"];
        $_SESSION["old"]["author"] = $_POST["author"];
        $_SESSION["old"]["description"] = $_POST["description"];
        $_SESSION["old"]["slug"] = $_POST["slug"];
        $_SESSION["old"]["date"] = $_POST["date"];


        // title verification
        if (!empty(escape($_POST["title"]))) {
            if (strlen(trim($_POST["title"])) >= 2) {
                // VALID
                $validCount++;
            } else {
                // IS NOT VALID
                $_SESSION["error"]["title"] = "Format incorrect (minimum 2 caractères)";
            }
        } else {
            // EMPTY ERROR
            $_SESSION["error"]["title"] = "Le champ est requis";
        }


        // author verification
        if (!empty(escape($_POST["author"]))) {
            if (preg_match("#^[ \w-]{2,}$#", $_POST["author"])) {
                // VALID
                $validCount++;
            } else {
                // IS NOT VALID
                $_SESSION["error"]["author"] = "Format incorrect (minimum 2 caractères alphanumérique)";
            }
        } else {
            // EMPTY ERROR
            $_SESSION["error"]["author"] = "Le champ est requis";
        }


        // description verification
        if (!empty(escape($_POST["description"]))) {
            // VALID
            $validCount++;
        } else {
            // EMPTY ERROR
            $_SESSION["error"]["description"] = "Le champ est requis";
        }


        // slug verification
        if (!empty(escape($_POST["slug"]))) {
            if (preg_match("#^[a-z0-9-]*$#", $_POST["slug"])) {
                require(MODELS."Book.php");
                $book = getBook($_POST["slug"]);
                if (empty($book)) {
                    // VALID
                    $validCount++;
                } else {
                    // THIS SLUG IS ALREADY USED
                    $_SESSION["error"]["slug"] = "Ce slug n'est pas disponible";
                }
            } else {
                // IS NOT VALID
                $_SESSION["error"]["slug"] = "Format incorrect (seulment des caractères alphanumérique en minuscule et des tirets)";
            }
        } else {
            // EMPTY ERROR
            $_SESSION["error"]["slug"] = "Le champ est requis";
        }


        // date verification
        if (!empty(escape($_POST["date"]))) {
            if (preg_match("#^[0-9]{4}-[0-9]{2}-[0-9]{2}$#", $_POST["date"])) {
                // VALID
                $validCount++;
            } else {
                // IS NOT VALID
                $_SESSION["error"]["date"] = "Format incorrect";
            }
        } else {
            // EMPTY ERROR
            $_SESSION["error"]["date"] = "Le champ est requis";
        }


        //Insert new book
        if ($validCount == 5) {

            storeBook();

            header("Location: /livres/".$_POST["slug"]);
        } else {
            header("Location: /livres/nouveau");
        }
    } else {
        header("Location: /livres/nouveau");
    }
}

//Update Verification
function bookUpdate($lastSlug) {

    $validCount = 0;

    //CHECK POST
    if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["description"]) && isset($_POST["slug"]) && isset($_POST["date"])) {

        //store last values
        $_SESSION["old"]["title"] = $_POST["title"];
        $_SESSION["old"]["author"] = $_POST["author"];
        $_SESSION["old"]["description"] = $_POST["description"];
        $_SESSION["old"]["slug"] = $_POST["slug"];
        $_SESSION["old"]["date"] = $_POST["date"];


        // title verification
        if (!empty(escape($_POST["title"]))) {
            if (strlen(trim($_POST["title"])) >= 2) {
                // VALID
                $validCount++;
            } else {
                // IS NOT VALID
                $_SESSION["error"]["title"] = "Format incorrect (minimum 2 caractères)";
            }
        } else {
            // EMPTY ERROR
            $_SESSION["error"]["title"] = "Le champ est requis";
        }


        // author verification
        if (!empty(escape($_POST["author"]))) {
            if (preg_match("#^[ \w-]{2,}$#", $_POST["author"])) {
                // VALID
                $validCount++;
            } else {
                // IS NOT VALID
                $_SESSION["error"]["author"] = "Format incorrect (minimum 2 caractères alphanumérique)";
            }
        } else {
            // EMPTY ERROR
            $_SESSION["error"]["author"] = "Le champ est requis";
        }


        // description verification
        if (!empty(escape($_POST["description"]))) {
            // VALID
            $validCount++;
        } else {
            // EMPTY ERROR
            $_SESSION["error"]["description"] = "Le champ est requis";
        }


        // slug verification
        if (!empty(escape($_POST["slug"]))) {
            if (preg_match("#^[a-z0-9-]*$#", $_POST["slug"])) {
                require(MODELS."Book.php");
                $book = getBook($_POST["slug"]);
                if (empty($book) || $_POST["slug"] == $lastSlug) {
                    // VALID
                    $validCount++;
                } else {
                    // THIS SLUG IS ALREADY USED
                    $_SESSION["error"]["slug"] = "Ce slug n'est pas disponible";
                }
            } else {
                // IS NOT VALID
                $_SESSION["error"]["slug"] = "Format incorrect (seulment des caractères alphanumérique en minuscule et des tirets)";
            }
        } else {
            // EMPTY ERROR
            $_SESSION["error"]["slug"] = "Le champ est requis";
        }


        // date verification
        if (!empty(escape($_POST["date"]))) {
            if (preg_match("#^[0-9]{4}-[0-9]{2}-[0-9]{2}$#", $_POST["date"])) {
                // VALID
                $validCount++;
            } else {
                // IS NOT VALID
                $_SESSION["error"]["date"] = "Format incorrect";
            }
        } else {
            // EMPTY ERROR
            $_SESSION["error"]["date"] = "Le champ est requis";
        }


        //Update book
        if ($validCount == 5) {

            updateBook($lastSlug);

            header("Location: /livres/".$lastSlug);
        } else {
            header("Location: /livres/".$lastSlug."/edit");
        }
    } else {
        header("Location: /livres/".$lastSlug."/edit");
    }
}
