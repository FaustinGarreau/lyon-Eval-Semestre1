<?php

// GET FUNCTIONS

function home()
{
    //require VIEW
    require(VIEWS.'books/index.php');
}

function bookCreate() {
    //require VIEW
    require(VIEWS.'books/create.php');
}

// POST FUNCTIONS

function bookStore() {

    $validCount = 0;

    $title = "";
    $author = "";
    $description = "";
    $slug = "";
    $date = "";

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
                $title = $_POST["title"];
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
                $author = $_POST["author"];
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
            $description = $_POST["description"];
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
                    $slug = $_POST["slug"];
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
                $date = $_POST["date"];
                $validCount++;
            } else {
                // IS NOT VALID
                $_SESSION["error"]["date"] = "Format incorrect";
            }
        } else {
            // EMPTY ERROR
            $_SESSION["error"]["date"] = "Le champ est requis";
        }



        //Insert new Article
        if ($validCount == 5) {

            storeBook($title,$author,$description,$slug,$date);

            header("Location: /");
        } else {
            header("Location: /livres/nouveau");
        }
    } else {
        header("Location: /livres/nouveau");
    }
}
