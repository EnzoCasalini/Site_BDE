<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/functions_user.php');
require_once($_SERVER['DOCUMENT_ROOT'] . "/../inc/CSRF.php");

if (!is_logged()){
    header("Location: /connexion");
}

if (isset($_POST['newpost'])){
    setcookie("type", "new");
    header("Location: /modif_new_post");
}

$user = $bdd->prepare('SELECT id_user,user_name FROM user');
$user->execute();
$u = $user->fetchAll();

$post = $bdd->prepare('SELECT * FROM post ORDER BY post_mel DESC');
$post->execute();

$title = "Home";

require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/main_page.php');


?>