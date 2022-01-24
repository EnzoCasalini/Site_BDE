<?php

class CSRF
{
    public static function creationDuToken()
    {
        //on genere le token
        $token = md5(time()); //resultat sous forme de string

        //on le sauvegarde dans une Session
        $_SESSION["token"] = $token;

        //on cree un champ masque 
        echo "<input type='hidden' name='token' value='$token' />"; 
    }

    public static function TokenValide($token)
    {
        //JETON VALIDE
        return isset($_SESSION["token"]) && $_SESSION["token"] == $token; 
    }
}