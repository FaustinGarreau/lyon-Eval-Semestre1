<?php

// GET FUNCTIONS

//Show register page
function registerPage() {
    //require VIEW
    require(VIEWS.'auth/register.php');
}

//Show login page
function loginPage() {
    //require VIEW
    require(VIEWS.'auth/login.php');
}
// POST FUNCTIONS

//Registration verification
function registerUser() {

    $validCount = 0;

    //CHECK POST
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {

        //store last values
        $_SESSION["old"]["username"] = $_POST["username"];


        // username verification
        if (!empty(escape($_POST["username"]))) {
            require(MODELS."Auth.php");
            $user = getUserByName($_POST["username"]);
            if (empty($user)) {
                if (preg_match("#^[\w-]{2,}$#", $_POST["username"])) {
                    // VALID
                    $validCount++;
                } else {
                    // IS NOT VALID
                    $_SESSION["error"]["username"] = "Format incorrect (minimum 2 caractères alphanumérique)";
                }
            } else {
                // THE USERNAME IS ALREADY USED
                $_SESSION["error"]["username"] = "Ce nom est déjà utilisé";
            }
        } else {
            // EMPTY ERROR
            $_SESSION["error"]["username"] = "Le champ est requis";
        }


        // password verification
        if (!empty(escape($_POST["password"]))) {
            if (strlen($_POST["password"])>=6) {
                // VALID

                if (!empty(escape($_POST["confirm"]))) {
                    if ($_POST["confirm"] == $_POST["password"]) {
                        // VALID
                        $validCount++;
                    } else {
                        // IS NOT VALID
                        $_SESSION["error"]["confirm"] = "Les mot de passe ne corresponde pas";
                    }
                } else {
                    // EMPTY ERROR
                    $_SESSION["error"]["confirm"] = "Le champ est requis";
                }
            } else {
                // IS NOT VALID
                $_SESSION["error"]["password"] = "Format incorrect (minimum 6 caractères)";
            }
        } else {
            // EMPTY ERROR
            $_SESSION["error"]["password"] = "Le champ est requis";
        }


        //Insert new user
        if ($validCount == 2) {

            userRegister();

            header("Location: /livres");
        } else {
            header("Location: /register");
        }
    } else {
        header("Location: /register");
    }
}

//Login verification
function loginUser() {

        $validCount = 0;
        $user = null;

        require(MODELS."Auth.php");

        //CHECK POST
        if (isset($_POST["username"]) && isset($_POST["password"])) {

            //store last values
            $_SESSION["old"]["username"] = $_POST["username"];


            // username verification
            if (!empty(escape($_POST["username"]))) {
                if (preg_match("#^[\w-]{2,}$#", $_POST["username"])) {
                    $user = getUserByName($_POST["username"]);
                    if (!empty($user)) {
                        // VALID
                        $validCount++;
                    } else {
                        $_SESSION["error"]["username"] = "Ce username n'existe pas";
                    }
                } else {
                    // IS NOT VALID
                    $_SESSION["error"]["username"] = "Format incorrect (minimum 2 caractères alphanumérique)";
                }
            } else {
                // EMPTY ERROR
                $_SESSION["error"]["username"] = "Le champ est requis";
            }


            // password verification
            if (!empty(escape($_POST["password"]))) {
                if (strlen($_POST["password"])>=6) {
                    // VALID
                    $validCount++;
                } else {
                    // IS NOT VALID
                    $_SESSION["error"]["password"] = "Format incorrect (minimum 6 caractères)";
                }
            } else {
                // EMPTY ERROR
                $_SESSION["error"]["password"] = "Le champ est requis";
            }


            //Insert new user
            if ($validCount == 2) {

                if (isset($user) && password_verify($_POST["password"], $user["password"])) {
                    //Connexion
                    $_SESSION["username"] = $_POST["username"];
                    $_SESSION["userid"] = $user["id"];

                    header("Location: /livres");
                } else {
                    var_dump(password_verify($_POST["password"], $user["password"]));
                    $_SESSION["error"]["password"] = "Le Mot de passe ne correspond pas";
                    header("Location: /login");
                }

            } else {
                header("Location: /login");
            }
        } else {
            header("Location: /login");
        }
}
