<?php
function tagsIndex() {
    require MODELS."Tags.php";
    $tags = getTags();
    require VIEWS.'tags.php';
}

function tagStore() {
    if (!isLogin()) {
        header("Location: /livres/");
        die();
    }
    if (!isset($_POST["tag"]) || empty(escape($_POST["tag"]))) {
        setError("error", "Ce champ est requis");
    } elseif (!preg_match("#^[\wÀ-ÿ-]{2,40}$#", escape($_POST["tag"]))) {
        setError("error", "Entre 2 et 40 lettres S.V.P.");
    }
    $tag = ucfirst(strtolower(escape($_POST["tag"])));
    if (!hasError()) {
        $slug = slugify($tag);
        require MODELS."Tags.php";
        if (!getTag($slug)) {
            addTag($tag, $slug);
        } else {
            setError("error", "Cette catégorie existe déjà");
        }
    }
    header("Location: /tags");
}

function tagEdit($oldslug) {
    if (!isLogin()) {
        header("Location: /livres/");
        die();
    }
    if (!isset($_POST["edit"]) || empty(escape($_POST["edit"]))) {
        setError($oldslug, "Ce champ est requis");
    } elseif (!preg_match("#^[\wÀ-ÿ-]{2,40}$#", escape($_POST["edit"]))) {
        setError($oldslug, "Entre 2 et 40 lettres S.V.P.");
    }
    $tag = ucfirst(strtolower(escape($_POST["edit"])));
    echo $tag;
    if (!hasError()) {
        $slug = slugify($tag);
        require MODELS."Tags.php";
        $cate = getTag($slug);
        if (!$cate || $cate["slug"] == $oldslug) {
            updateTag($oldslug, $tag, $slug);
        } else {
            setError($oldslug, "Cette catégorie existe déjà");
        }
    }
    header("Location: /tags");
}

function tagDelete($slug) {
    if (!isLogin()) {
        header("Location: /livres/");
        die();
    }
    require MODELS."Tags.php";
    deleteTag($slug);
    header("Location: /tags");
}
