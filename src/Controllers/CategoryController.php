<?php

function categoryIndex() {

    require MODELS . 'Category.php';
    $categorys = getCategorys();

    require VIEWS . 'Category/index.php';
}

function categoryShow($slug) {
    require MODELS . 'Category.php';
    $category = getCategory($slug);
    $books = getBookCategory($slug);

    require VIEWS . 'category/show.php';
}
