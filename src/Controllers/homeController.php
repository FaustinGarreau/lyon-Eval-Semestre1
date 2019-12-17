<?php 
    function renderHome() {
        require(MODELS."home.php");
        require(VIEWS."/books/index.php");
    }
?>