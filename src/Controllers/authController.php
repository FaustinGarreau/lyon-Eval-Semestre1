<?php
// get
function renderLogin() {
    require(MODELS."auth.php");
    require(VIEWS."/auth/login.php");
}
function renderRegister() {
    require(MODELS."auth.php");
    require(VIEWS."/auth/register.php");
}
// post
function newUser() {
    $_SESSION["error"]["register"] = [];
    $_SESSION["value"]["register"] = $_POST;
    foreach ($_POST as $key => $value) {
        if ($value == "") {
            $_SESSION["error"]["register"] = array_merge($_SESSION["error"]["register"], [$key => "ce champs est requis"]);
        }
    }
    if (!preg_match("/^[a-zA-Z0-9-]{2,}$/", $_POST["username"]) && !isset($_SESSION["error"]["register"]["username"])) {
        $_SESSION["error"]["register"] = array_merge($_SESSION["error"]["register"], ["username" => "format incorect, 2 caractère minimun et seule les lettre, les chiffres et les tiret sont acceptés"]);
    }
    if (!isset($_SESSION["error"]["register"]["username"])) {
        global $bdd;
        $check = $bdd->prepare('SELECT username FROM user WHERE username=:username');
        $check->execute([
            "username" => escape($_POST["username"]),
        ]);
        $username = $check->fetchAll();
        if (count($username) > 0) {
            $_SESSION["error"]["register"] = array_merge($_SESSION["error"]["register"], ["username" => "ce pseudo est déjà pris"]);
        }
    }
    if (!preg_match("/^.{4,}$/", $_POST["password"]) && !isset($_SESSION["error"]["register"]["password"])) {
        $_SESSION["error"]["register"] = array_merge($_SESSION["error"]["register"], ["password" => "format incorect, 4 caractère minimun"]);
    }

    if (count($_SESSION["error"]["register"]) == 0) {
        global $bdd;
        $req = $bdd->prepare('INSERT INTO user (username, password)
        VALUES (:username, :password)
        ');
        $req->execute([
            "username" => escape($_POST["username"]),
            "password" => password_hash(escape($_POST["password"]), PASSWORD_DEFAULT),
        ]);
        header("Location: /login");
    } else {
        header("Location: /register");
    }
}
function login() {
    $_SESSION["error"]["login"] = [];
    $_SESSION["value"]["login"] = $_POST;
    foreach ($_POST as $key => $value) {
        if ($value == "") {
            $_SESSION["error"]["login"] = array_merge($_SESSION["error"]["login"], [$key => "ce champs est requis"]);
        }
    }
    if (count($_SESSION["error"]["login"]) == 0) {
        global $bdd;
        $req = $bdd->prepare('SELECT * FROM user
        WHERE username=:username');
        $req->execute([
            "username" => escape($_POST["username"]),
        ]);
        $userinfo = $req->fetchAll();
        var_dump($userinfo);
        if (count($userinfo) > 0) {
            if (password_verify(escape($_POST["password"]), $userinfo[0]["password"])) {
                $_SESSION["user"] = [];
                $_SESSION["user"] = array_merge($_SESSION["user"], ["username" => $userinfo[0]["username"], "id" => $userinfo[0]["id"]]);
                header("Location: /");
            } else {
                header("Location: /login");
            }
        } else {
            header("Location: /login");
        }
    } else {
        header("Location: /login");
    }
}
function disconnect() {
    unset($_SESSION["user"]);
    header("Location: /");

}
?>