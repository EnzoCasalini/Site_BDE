<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/functions_user.php');

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
        $insertion = $bdd->prepare('INSERT INTO post (post_title, post_content, post_mel) VALUES (?,?, NOW())'); //on insere les donnees dans la table article
        $insertion->execute(array($titre, $contenu)); //ce sont les valeurs que l'on mettra a la place des ?
        $message = 'Votre article est poste !!';
    } else {
        $update = $bdd->prepare('UPDATE post SET post_title = ? , post_content = ? WHERE id_post = ?');
        $update = $update->execute(array($titre, $contenu,$_COOKIE['id']));
        $message = 'Votre article est a jour !!';
    }
} else {
    $message = 'Remplissez tous les champs svp !!'; //si le champ existe mais qu'ils sont pas tous les deux remplis ont met une erreur
}

if ($edition == 1){
    $a = $bdd->prepare('SELECT * FROM post WHERE id_post = ?');
    $a->execute(array($_COOKIE['id']));
    $edit_article = $a->fetch();
}

$title = "post";

require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/modif_new.php');
