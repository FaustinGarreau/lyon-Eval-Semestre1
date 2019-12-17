<?php

function AuthLogin() {
    require VIEWS . 'auth/login.php';
}

function AuthRegister() {
    require VIEWS . 'auth/register.php';
}

function AuthLogout() {
    session_destroy();
    header("Location: /livres");
}

function AuthLoginTraitement() {

    if (isset($_POST['username']) && isset($_POST["password"])) {
        $_SESSION['old'] = $_POST;

        if (!escape($_POST['username'])) {
            $_SESSION["error"]["username"] = "Ce champ est requis";
            header("Location: /login");
        } elseif (!preg_match("#^[a-zA-Z0-9-]{2,}$#", $_POST["username"])) {
            $_SESSION["error"]["username"] = "Format incorrect (entre 2 et 20 lettres)";
            header("Location: /login");
        }

        if (!escape($_POST['password'])) {
            $_SESSION["error"]["password"] = "Ce champ est requis";
            header("Location: /login");
        } elseif (!preg_match("#^.{6,}$#", $_POST["password"])) {
            $_SESSION["error"]["password"] = "Format incorrect (au moins 6 caractères)";
            header("Location: /login");
        }

        if (!isset($_SESSION['error'])) {
            require MODELS . 'Auth.php';
            $user = getUser($_POST["username"]);
            if ($user && password_verify($_POST['password'], $user["password"])) {
                $_SESSION["user"] = [
                    "username" => $user["username"],
                    "id" => $user["id"],
                    "role" => $user["role"]
                ];
                header("Location: /livres");
            } else {
                $_SESSION["error"]['message'] = "Une erreur sur les identifiants";
                header("Location: /login");
            }
        } else {
            header("Location: /login");
        }

    } else {
        header("Location: /login");
    }
}

function AuthRegisterTraitement() {
    if (isset($_POST['username']) && isset($_POST["password"]) && isset($_POST["confirm"])) {
        $_SESSION['old'] = $_POST;

        if (!escape($_POST['username'])) {
            $_SESSION["error"]["username"] = "Ce champ est requis";
            header("Location: /register");
        } elseif (!preg_match("#^[a-zA-Z0-9-]{2,}$#", $_POST["username"])) {
            $_SESSION["error"]["username"] = "Format incorrect (entre 2 et 20 lettres)";
            header("Location: /register");
        }

        if (!escape($_POST['password'])) {
            $_SESSION["error"]["password"] = "Ce champ est requis";
            header("Location: /register");
        } elseif (!preg_match("#^.{6,}$#", $_POST["password"])) {
            $_SESSION["error"]["password"] = "Format incorrect (au moins 6 caractères)";
            header("Location: /register");
        }

        if (!escape($_POST['confirm'])) {
            $_SESSION["error"]["confirm"] = "Ce champ est requis";
            header("Location: /register");
        } elseif (!preg_match("#^.{6,}$#", $_POST["confirm"])) {
            $_SESSION["error"]["confirm"] = "Format incorrect (au moins 6 caractères)";
            header("Location: /register");
        }

        if ($_POST['password'] !== $_POST['confirm']) {
            $_SESSION["error"]["double"] = "Le password et le confirm password doivent être éguaux";
            header("Location: /register");
        }

        if (!isset($_SESSION['error'])) {
            global $bdd;
            require MODELS . 'Auth.php';
            $user = getUser($_POST["username"]);
            if ($user) {
                $_SESSION["error"]["username"] = "Le username existe déjà";
                header("Location: /register");
            } else {
                createAccount();
                $id = $bdd->lastInsertId();
                $_SESSION["user"] = [
                    "username" => $_POST['username'],
                    "id" => $id,
                    "role" => "utilisateur"
                ];
                header("Location: /livres");
            }
        } else {
            header("Location: /register");
        }
    } else {
        header("Location: /register");
    }
}
