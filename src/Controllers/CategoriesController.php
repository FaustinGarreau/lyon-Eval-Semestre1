<?php
function categoriesIndex() {
    require MODELS."Categories.php";
    $categories = getCategories();
    require VIEWS.'categories.php';
}

function categoryStore() {
    if (!isLogin()) {
        header("Location: /livres/");
        die();
    }
    if (!isset($_POST["category"]) || empty(escape($_POST["category"]))) {
        setError("error", "Ce champ est requis");
    } elseif (!preg_match("#^.{2,40}$#", escape($_POST["category"]))) {
        setError("error", "Entre 2 et 40 lettres S.V.P.");
    }
    $category = ucfirst(strtolower(escape($_POST["category"])));
    if (!hasError()) {
        $slug = slugify($category);
        require MODELS."Categories.php";
        if (!getCategory($slug)) {
            addCategory($category, $slug);
        } else {
            setError("error", "Cette catégorie existe déjà");
        }
    }
    header("Location: /categories");
}

function categoryEdit($oldslug) {
    if (!isLogin()) {
        header("Location: /livres/");
        die();
    }
    if (!isset($_POST["edit"]) || empty(escape($_POST["edit"]))) {
        setError($oldslug, "Ce champ est requis");
    } elseif (!preg_match("#^.{2,40}$#", escape($_POST["edit"]))) {
        setError($oldslug, "Entre 2 et 40 lettres S.V.P.");
    }
    $category = ucfirst(strtolower(escape($_POST["edit"])));
    echo $category;
    if (!hasError()) {
        $slug = slugify($category);
        require MODELS."Categories.php";
        $cate = getCategory($slug);
        if (!$cate || $cate["slug"] == $oldslug) {
            updateCategory($oldslug, $category, $slug);
        } else {
            setError($oldslug, "Cette catégorie existe déjà");
        }
    }
    header("Location: /categories");
}

function categoryDelete($slug) {
    if (!isLogin()) {
        header("Location: /livres/");
        die();
    }
    require MODELS."Categories.php";
    deleteCategory($slug);
    header("Location: /categories");
}
