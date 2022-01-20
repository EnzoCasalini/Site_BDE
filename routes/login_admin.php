<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/functions_user.php');

if (is_logged()) {
    header('Location: /');
}

if (isset($_POST['SendSub']))
{
    if (isset($_POST['user_mail']) && isset($_POST['user_pwd']))
    {
        $email = htmlspecialchars($_POST['user_mail']);
        $password = htmlspecialchars($_POST['user_pwd']);

        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $testbool = connect_admin($email, $password, $bdd);
                if ($testbool === false)
                {
                    $error_alr = "Identifiant ou mot de passe invalide !";
                }
                elseif ($testbool === 1)
                {
                    $error_nomail = "Email inconnu ! Inscrivez-vous !";
                }
                elseif ($testbool === 2)
                {
                    $error_admin = "Compte non admin !";
                }else{
                    header('Location: /');
                }
        } else $error_mail = "Email invalide";
    }
}

$title = "Connexion";

require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/connexion_page_admin.php');

?>