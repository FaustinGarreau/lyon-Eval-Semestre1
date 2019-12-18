<?php

function getCategories()
{
    global $bdd;

    $stmt = $bdd->query("SELECT * FROM category");

    return $stmt->fetchAll();
}
