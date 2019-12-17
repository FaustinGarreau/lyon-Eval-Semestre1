<?php

function getCategoryFive() {
    global $bdd;
    $req = $bdd->query('SELECT * FROM category LIMIT 3');
    return $req->fetchAll();
}
