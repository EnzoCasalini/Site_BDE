<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/functions_user.php');
require_once($_SERVER['DOCUMENT_ROOT'] . "/../inc/CSRF.php");

if (is_logged()) {
    header('Location: /');
}
else {
    if (isset($_POST['SendSub']))
    {
        // On vérifie que tous les input sont bien remplis
        if (isset($_POST['user_name']) && isset($_POST['user_mail']) && isset($_POST['user_role']) && isset($_POST['user_pwd'])) 
        {

            // htmlspecialchars pour éviter les injections SQL

            $nickname = htmlspecialchars($_POST['user_name']);
            $email = htmlspecialchars($_POST['user_mail']);
            $class = htmlspecialchars($_POST['user_role']);
            $password = htmlspecialchars($_POST['user_pwd']);
            $space_nickname = strpos($nickname, " ");
            
            // On effectue les différents tests sur les champs du formulaire

            $error = 0;
            if (strlen($nickname) < 3 || strlen($nickname) > 30 || $space_nickname == true)
            {
                $error++;
                $error_nickname = "Pseudo invalide (3 à 30 caractères)";
            }
            if (strlen($email) > 100 || strpos($email, "@ynov") != true)
            {
                $error++;
                $error_mail = "Email invalide (Doit contenir '@ynov')";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $error++;
                $error_mail = "Email invalide";
            }
            if (strlen($class) > 2 || (($class != 'B1') && ($class != 'B2') && ($class != 'B3') && ($class != 'M1') && ($class != 'M2')))
            {
                $error++;
                $error_class = "Classe invalide (B1, B2, B3, M1, M2)";
            }
            if (!preg_match('#^(?=.*\d)(?=.*[A-Z]).{8}#', $password))
            {
                $error++;
                $error_pwd = "Mot de passe invalide (Il faut au moins 1 maj, 1 chiffre et 8 caractères";
            }

            if ($error == 0)
            {
                $testbool = subscribe($nickname, $email, $class, $password, $bdd); 
                // Si $testbool vaut faux, d'après la fonction subscribe, cela veut dire que l'email est déjà pris
                if ($testbool === false)
                {
                    $error_alr = "Email déjà existant";
                }
                elseif ($testbool === 1)
                {
                    $error_nickname = "Nom déjà pris"; 
                }
                else
                header('Location: /connexion');
            }
        } else $error_form = "Un ou plusieurs champs ne sont pas remplis";
    }
}

$title = "Subscribe";

require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/templates/subscription_page.php');

?>