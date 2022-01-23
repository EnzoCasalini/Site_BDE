<?php

session_unset();

unset($_COOKIE['id']);
unset($_COOKIE['type']); 

header('Location: /connexion');

?>