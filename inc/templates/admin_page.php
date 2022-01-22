<body>
    <section class="site">
        <section class="section12">
            <div class="section12__topbar">
                <?php
                if (isset($_SESSION['user_name'])) {
                    echo '<a href="/profile">' . $_SESSION['user_name'];
                }
                ?></a>
                <div class="burger" id="burger-icon">
                    <div></div>
                </div>
            </div>

            <div class="section12__title">
                <h1>ADMIN</h1>
                <img src="./assets/IMG/Ynov.svg" alt="Ynov Sophia Campus">
                <div class="section12__gestion">
                    <div class="section12__admin">
                        <h2>Utilisateur</h2>
                        <div class="section12__admin__utilisateur">
                            <ul>
                                <?php while ($a = $utilisateur->fetch()) { ?>
                                    <li>
                                        <form method="post">
                                            <?= $a['user_name'] ?> | <?= $a['user_role'] ?> | <?= $a['user_mail'] ?>
                                            <button type="submit"><input type="number" value="<?= $a['id_user'] ?>" name="user">Supprimer</button>

                                        </form>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="section12__admin">
                        <h2>PostForum</h2>
                        <div class="section12__admin__utilisateur ">
                            <ul>
                                <?php while ($a = $articles->fetch()) { ?>
                                    <li>
                                        <?= $a['post_title'] ?> |
                                        <form method="post"><button type="submit"><input type="number" value="<?= $a['id_post'] ?>" name="modif">Modifier</button></form>
                                        <form method="post"><button type="submit"><input type="number" value="<?= $a['id_post'] ?>" name="suppost">Supprimer</button></form>
                                    </li>
                                <?php } ?>

                                <ul>
                        </div>
                    </div>
                </div>
            </div>

        </section>