<body>
    <section class="site">
        <section class="section12">
            <div class="section12__topbar">
            <?php 
                if (isset($_SESSION['user_name']))
                {
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
                    <div class="section12__profil">
                        <h2>Utilisateur</h2>
                        
                    </div>
                    <div class="section12__gestion__profil">
                        <h2>PostForum</h2>
                        <form method="post" enctype="multipart/form-data">
                        <div class="section12__gestion__profil__pp">

                        </div>
                        <div class="section12__gestion__profil__infos">

                        </div>
                        <button type="submit" name="Save">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>

        </section>