<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/functions_user.php');
require_once($_SERVER['DOCUMENT_ROOT'] . "/../inc/CSRF.php");

if (isset($_POST['Save']))
{
    if ((isset($_FILES['user_pp']) || isset($_POST['user_name']) || isset($_POST['user_mail']) || isset($_POST['user_pwd'])))
    {
        $nickname = htmlspecialchars($_POST['user_name']);
        $email = htmlspecialchars($_POST['user_mail']);
        $password = htmlspecialchars($_POST['user_pwd']);

        $result_pp = check_pp($_FILES['user_pp']);
        $result_mail = check_mail($email, $bdd);
        $result_name = check_nickname($nickname, $bdd);
        $result_pwd = check_pwd($password);


        // Gestion des remplacements de l'appel des fonctions qui remplacent les valeurs dans la BDD.

        if (($result_pp === 0 || $result_pp === true) && ($result_mail === 0 || $result_mail === true) && ($result_name === 0 || $result_name === true) && ($result_pwd === 0 || $result_pwd === true))
        {
            if ($result_pp !== 0)   change_pp($_FILES['user_pp'], $bdd);
            if ($result_name !== 0) change_nickname($nickname, $bdd);
            if ($result_mail !== 0) change_mail($email, $bdd);
            if ($result_pwd !== 0)  change_pwd($password, $bdd);
            $success = "Les informations ont bien été enregistrées !";
            updating($_SESSION['id_user'], $bdd);
        }
        
        // Gestion des différentes erreurs.

        // PROFILE PICTURE

        if ($result_pp === 1)
        {
            $error_pp = "Extension du fichier invalide !";
        }
        elseif ($result_pp === 2)
        {
            $error_pp = "Fichier trop lourd !";
        }


        // EMAIL

        if ($result_mail === 1)
        {
            $error_mail = "Email déjà existant !";
        }
        elseif ($result_mail === 2)
        {
            $error_mail = "L'email doit contenir 'ynov' et faire moins de 100 caractères !";
        }
        elseif ($result_mail === 3)
        {
            $error_mail = "Email invalide !";
        }


        // NICKNAME

        if ($result_name === 1)
        {
            $error_nickname = "Nom déjà existant !";
        }
        elseif ($result_name === 2)
        {
            $error_nickname = "Pseudo invalide (3 à 30 caractères) !";
        }

        
        // PASSWORD

        if ($result_pwd === 1)
        {
            $error_pwd = "Mot de passe invalide (Il faut au moins 1 maj, 1 chiffre et 8 caractères";
        }

    }else $error_form = "Un ou plusieurs champs ne sont pas remplis";
}

$title = "Profile";


// GESTION DES POSTS

if (isset($_POST['suppost'])){
    $supprpost = $bdd->prepare('DELETE FROM post WHERE id_post = ?');
    $supprpost->execute(array($_POST['suppost']));
}

if (isset($_POST['modif'])){
    setcookie("id", $_POST['modif']);
    setcookie("type", "modif");
    header("Location: /modif_new_post");
}

$articles = $bdd->prepare('SELECT * FROM post WHERE id_user = ? ORDER BY post_mel DESC');
$articles->execute(array($_SESSION['id_user']));

require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/profile_page.php');

?>