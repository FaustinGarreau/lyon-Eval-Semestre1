<?php

function getCategories()
{
    global $bdd;

    $stmt = $bdd->query("SELECT * FROM category");

    return $stmt->fetchAll();
}

function getCategory($id)
{
    global $bdd;

    $stmt = $bdd->prepare("SELECT * FROM category WHERE id = :id");
    $stmt->execute(array(
        "id" => $id
    ));

    return $stmt->fetch();
}
