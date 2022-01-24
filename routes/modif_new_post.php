<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/functions_user.php');
require_once($_SERVER['DOCUMENT_ROOT'] . "/../inc/CSRF.php");

if (isset($_COOKIE['type'])) {
    if ($_COOKIE['type'] == "modif") {
        $edition = 1;
    }elseif ($_COOKIE['type'] == "new") {
        $edition = 0;
    }
}

if (isset($_POST['titre'], $_POST['contenu'])) {

    $titre = $_POST['titre']; //on securise avec htmlspecialchars dans le but qu'aucun utilisateur puisse mettre du code malveillant
    $contenu = $_POST['contenu'];

    if ($edition == 0) {
        $insertion = $bdd->prepare('INSERT INTO post (post_title, post_content, id_user) VALUES (?,?,?)'); //on insere les donnees dans la table article
        $insertion->execute(array($titre, $contenu,$_SESSION['id_user'])); //ce sont les valeurs que l'on mettra a la place des ?
        header('Location: /');
    } else {
        $update = $bdd->prepare('UPDATE post SET post_title = ? , post_content = ? , post_modif = NOW() WHERE id_post = ?');
        $update = $update->execute(array($titre, $contenu,$_COOKIE['id']));
        header('Location: /');
    }
}

if ($edition == 1){
    $a = $bdd->prepare('SELECT * FROM post WHERE id_post = ?');
    $a->execute(array($_COOKIE['id']));
    $edit_article = $a->fetch();
}

$title = "post";

require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/modif_new.php');
