<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/functions_user.php');

if (isset($_POST['Save']))
{
    if (isset($_FILES['user_pp']) || isset($_POST['user_name']))
    {
        $nickname = htmlspecialchars($_POST['user_name']);

            $exit_nickname = change_nickname($nickname, $bdd);

            if ($exit_nickname === 0 || $exit_nickname === true)
            {
                $exit_pp = change_pp($_FILES['user_pp'], $bdd);
                if ($exit_pp === false)
                {
                    $error_pp = "Une erreur est survenue.";
                }
                elseif ($exit_pp === 1)
                {
                    $error_pp = "Ce format n'est pas pris en compte (Il faut : jpg, jpeg, png ou gif).";
                }
                elseif ($exit_pp === 2)
                {
                    $error_pp = "Votre image est trop lourde : Taille max 2Mo.";
                }
                else {
                    $success = "Les informations ont bien été modifiées! ";
                    updating($_SESSION['user_mail'], $bdd);
                }
            }
            elseif ($exit_nickname === 2)
            {
                $error_nickname = "Ce nom d'utilisateur est déjà utilisé !";
            }
            elseif ($exit_nickname === 1)
            {
                $error_nickname = "Pseudo invalide (3 à 30 caractères)";
            }

    }else $error_form = "Un ou plusieurs champs ne sont pas remplis";
}

$title = "Profile";

require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/profile_page.php');

?>