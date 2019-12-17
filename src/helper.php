<?php

function getError($name) {
    return escape($_SESSION["error"][$name] ?? "");
}

function getLastValue($name) {
    return escape($_SESSION["old"][$name] ?? "");
}

function escape($data) {return htmlspecialchars(stripslashes(trim($data))); }


function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  return $text;
}
