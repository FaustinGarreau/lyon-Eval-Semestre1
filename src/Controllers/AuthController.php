<?php
function login()
{
    require VIEWS."auth/login.php";
}

function register()
{
    require VIEWS."auth/register.php";
}

function logout() {
    session_unset();
    session_destroy();
    header("Location: /");
    die();
}

function loginUser() {
    require MODELS."Users.php";

    $user = null;

    $login = $_POST["login"] ?? "";
    $password = $_POST["password"] ?? "";

    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
        $user = getUserByEmail($login);
    } else {
        $user = getUserByUsername($login);
    }

    if (!$user) {
        setError("error", "Indetifiant ou mot de passe invalide.");
    }

    if (!hasError()) {
        if (password_verify($password, $user["password"])) {
            $_SESSION['id'] = $user["id"];
            $_SESSION['username'] = $user["username"];
            $_SESSION['email'] = $user["email"];
            header("Location: /");
            die();
        }
        setError("error", "Indetifiant ou mot de passe invalide.");
    }

    header("Location: /login/");
}

function registerUser() {
    require MODELS."Users.php";
    $_SESSION["old"] = $_POST;

    $username = $_POST["username"] ?? "";
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    $password_repeat = $_POST["password_repeat"] ?? "";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        setError("email", "L'adresse email n'est pas valide.");
    } elseif (getUserByEmail($email)) {
        setError("email", "L'adresse email est déjà utilisée.");
    }

    if(!preg_match('/^[a-zA-Z0-9-_]{2,25}$/', $username)) {
        setError("username", "Le nom d'utilisateur n'est pas valide.");
    } elseif (getUserByUsername($username)) {
        setError("username", "Le nom d'utilisateur est déjà pris.");
    }

    if (strlen($password) < 5) {
        setError("password", "Le mot de passe doit contenir au moins 5 caractères.");
    } elseif ($password != $password_repeat) {
        setError("password", "Les mots de passe sont différents.");
    }

    if (!hasError()) {
        $pass = password_hash($password, PASSWORD_BCRYPT);
        $_SESSION['id'] = addUser($username, $email, $pass);
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header("Location: /");
        die();
    }

    header("Location: /register/");
}
