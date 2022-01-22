<?php
$bdd = new PDO("mysql:host=127.0.0.1; dbname=articles;charset=utf8" , "root" , "");

if(isset($_GET['id']) AND !empty($_GET['id']))//on recup l'article
{

    $get_id = htmlspecialchars($_GET['id']);

    $article = $bdd ->prepare('SELECT * FROM articles WHERE id = ?');
    $article->execute(array($get_id));

    if($article->rowCount() == 1)
    {
        $article = $article->fetch(); //on va chercher l'article dans la bdd
        $titre = $article['titre'];
        $contenu = $article['contenu'];
    }else {
        die('l\'article n\'existe pas');
    }

}else {
    die('Erreur');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
</head>
<body>
<h1><?= $titre ?></h1> 
   <p><?= $contenu ?></p>
</body>
</html>