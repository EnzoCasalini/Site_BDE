<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/functions_user.php');

$firstpost = newPost(1, $bdd);
$secondpost = newPost(2, $bdd);



$title = "Home";
require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/main_page.php');


?>