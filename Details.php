<?php
$bdd = new PDO("mysql:host=127.0.0.1; dbname=articles;charset=utf8" , "root" , "");

$articles = $bdd->query('SELECT * FROM articles ORDER BY date_time_publication DESC');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New</title>
</head>
<body>
<ul> 
        <?php while($a = $articles->fetch()) {?> 
            <li><a href="Details2.php?id=<?= $a['id'] ?>"><?= $a['titre'] ?> | 
        <a href="NEW.php?edit=<?= $a['id'] ?>">Modifier</a> | <a href="EditSuppr.php?id=<?= $a['id'] ?>">Supprimer</a></li> 
            <?php } ?>

        <ul>
</body>
</html>