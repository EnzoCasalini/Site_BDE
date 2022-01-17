<?php

$dsn = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../config/dsn');
$credentials_handle = fopen($_SERVER['DOCUMENT_ROOT'] . '/../config/credentials', 'r');
$credentials_array = [];


$username = fgets($credentials_handle);
$credentials_array[] = trim($username);
$meta = "charset=utf8";

[$user] = $credentials_array;

try {
    $bdd = new PDO($dsn, $user, '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

?>