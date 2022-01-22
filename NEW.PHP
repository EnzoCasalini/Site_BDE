<?php
$bdd = new PDO("mysql:host=127.0.0.1; dbname=articles;charset=utf8" , "root" , "");

$edition = 0;

if(isset($_POST['edit'])  AND  !empty($_POST['edit']))
{
    $edition = 1;//on passe en mode edition de l'article
    $edit_id = htmlspecialchars($_POST['edit']);
    $edit_article = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
    $edit_article->execute(array($edit_id));


    if($edit_article->rowCount() == 1)
    {
        $edit_article = $edit_article->fetch();
        
    } else {
        die('L\'article n\'existe pas !');
    }

}


if(isset($_POST['article_titre'] , $_POST['article_contenu']))
{
    if(!empty($_POST['article_titre']) AND !empty($_POST['article_contenu']))
    {
        $article_titre = htmlspecialchars($_POST['article_titre']);//on securise avec htmlspecialchars dans le but qu'aucun utilisateur puisse mettre du code malveillant
        $article_contenu = htmlspecialchars($_POST['article_contenu']);    
   
   if($edition == 0)
   {
       $insertion = $bdd->prepare('INSERT INTO articles (titre, contenu, date_time_publication) 
       VALUES (?,?, NOW())');//on insere les donnees dans la table article
       $insertion->execute(array($article_titre , $article_contenu));//ce sont les valeurs que l'on mettra a la place des ?
    
  $message = 'Votre article est poste !!';
   } else {
       $update = $bdd->prepare('UPDATE articles SET titre = ? , contenu = ? , date_time_edition = NOW() WHERE id = ?');
       $update->execute(array($article_titre , $article_contenu , $edit_id ));
        header('Location: http://php-tp2/Details2.php?id='.$edit_id);
  $message = 'Votre article est a jour !!';
    }

   
   
    } else {
        $message = 'Remplissez tous les champs svp !!';//si le champ existe mais qu'ils sont pas tous les deux remplis ont met une erreur
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEW</title>
</head>
<body>
<form method="POST">
        <input type="text" name="article_titre" placeholder="Titre"<?php if($edition == 1){ ?> value="<?=$edit_article['titre']?>" <?php } ?> /><br />
        <textarea name="article_contenu" placeholder="Contenu de l'article"><?php if($edition == 1){ ?><?=$edit_article['contenu'] ?><?php } ?></textarea><br />
        <input type="submit" value="Envoyer l'article" />
</form>
<br />
<?php if(isset($message)) //si il y a une erreur on affiche l'erreur
{
    echo $message;
}
?>
</body>
</html>