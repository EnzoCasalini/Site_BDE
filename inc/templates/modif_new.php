<body>
<form method="POST">
        <input type="text" name="titre" placeholder="Titre"<?php if($edition == 1){ ?> value="<?=$edit_article['post_title']?>" <?php } ?> /><br />
        <textarea name="contenu" placeholder="Contenu de l'article"><?php if($edition == 1){ ?><?=$edit_article['post_content'] ?><?php } ?></textarea><br />
        <input type="submit" value="Envoyer l'article" />
</form>