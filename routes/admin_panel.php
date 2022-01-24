<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/functions_user.php');

if (isset($_POST['token']))
{
    checkToken($_POST['token']);
}

if (isset($_POST['user'])){
    $suppruser = $bdd->prepare('DELETE FROM user WHERE id_user = ?');
    $suppruser->execute(array($_POST['user']));
}
if (isset($_POST['suppost'])){
    $supprpost = $bdd->prepare('DELETE FROM post WHERE id_post = ?');
    $supprpost->execute(array($_POST['suppost']));
}
if (isset($_POST['modif'])){
    setcookie("id", $_POST['modif']);
    setcookie("type", "modif");
    header("Location: /modif_new_post");
}



$title = "Admin";

$utilisateur = $bdd->prepare('SELECT * FROM user WHERE admin = 0 ORDER BY id_user DESC');
$utilisateur->execute();

$articles = $bdd->prepare('SELECT * FROM post ORDER BY post_mel DESC');
$articles->execute();



require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/admin_page.php');