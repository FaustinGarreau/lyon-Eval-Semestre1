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
    } elseif (!preg_match("#^[A-Za-z]{2,40}$#", escape($_POST["category"]))) {
        setError("error", "Entre 2 et 40 lettres S.V.P.");
    }
    $category = ucfirst(strtolower(escape($_POST["category"])));
    if (!hasError()) {
        $slug = slugify($category);
        require MODELS."Categories.php";
        if (!getCategory($slug)) {
            addCategory($category, $slug);
        } else {
            setError("new", "Cette catégorie existe déjà");
        }
    }
    header("Location: /categories");
}
