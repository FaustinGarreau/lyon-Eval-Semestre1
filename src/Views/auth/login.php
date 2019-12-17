<?php
$title = "Connexion";
ob_start();
?>



<?php

$content = ob_get_clean();

require VIEWS . 'layout.php';
