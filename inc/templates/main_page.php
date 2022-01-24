<body>
    <section class="site">
        <section class="section1">
            <div class="section1__topbar">
                <?php
                if (isset($_SESSION['user_name'])) {
                    echo '<a href="/profile">' . $_SESSION['user_name'];
                } else {
                    echo '<a href="/connexion">CONNEXION';
                }
                ?>
                </a>
                <div class="burger" id="burger-icon">
                    <div></div>
                </div>
            </div>

            <div class="section1__title">
                <h1>BDE SOPHIA</h1>
                <img src="./assets/IMG/Ynov.svg" alt="Ynov Sophia Campus">
                <a href="#">Contacter</a>
                <div class="section1__events">
                    <h2>ÉVÉNEMENTS</h2>
                    <p>Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression.<br><br> Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour</p>
                </div>
            </div>

        </section>

        <section class="section2">
            <div class="section2__news">
                <form method="post" action="submit.php"><button type="submit"><input name="newpost">Nouveau Post</button></form>
                <div class="news">
                    <ul>
                        <?php while ($a = $post->fetch()) { ?>
                            <li>
                                <div class="news__text">
                                    <p> poster le <?php echo $a['post_mel'];?> par <?php for ($i = 0; $i < sizeof($u); $i++) { if($u[$i]['id_user'] == $a['id_user']){ echo $u[$i]['user_name']; }} if($a['post_modif'] != NULL){?> / modifier le <?php echo $a['post_modif'];}?></p>
                                    <h2> <?php echo $a['post_title']; ?> </h2>
                                    <span> <?php echo $a['post_content']; ?> </span>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

        </section>