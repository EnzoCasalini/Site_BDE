<?php

require_once("CSRF.php");


//jeton valide ou pas ?
if(CSRF::TokenValide($_POST["token"]))
{
    echo "Pas de Hackers mon reuf !";
}
else 
{
    echo "chelou tu sort d'ou toi ?";
}