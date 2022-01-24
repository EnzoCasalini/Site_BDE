<body>
    <section class="site">
        <section class="section11">
            <div class="section11__topbar">
                <a href="/subscribe">INSCRIPTION</a>
                <div class="burger" id="burger-icon">
                    <div></div>
                </div>
            </div>

            <div class="section11__title">
                <h1>CONNEXION ADMIN</h1>
                <img src="./assets/IMG/Ynov.svg" alt="Ynov Sophia Campus">
                <form method="post">
                    <div class="section11__connexion">
                        <h2>CONNEXION ADMIN</h2>
                        <div class="input-data1">
                            <input type="text" onkeydown="if(event.keyCode==32) return false;" name="user_mail" <?php if(isset($email)) { echo 'value="'.$email.'"';} ?> required>
                            <div class="underline1"></div>
                            <label>Email</label>
                            <?php
                                if (isset($error_mail))
                                {
                                    echo "<p style='color:red'>". $error_mail . "</p>";
                                }
                                elseif (isset($error_alr))
                                {
                                    echo "<p style='color:red'>". $error_alr . "</p>";
                                }
                                elseif (isset($error_nomail))
                                {
                                    echo "<p style='color:red'>". $error_nomail . "</p>";
                                }
                            ?>
                        </div>
                
                        <div class="input-data1">
                            <input type="password" onkeydown="if(event.keyCode==32) return false;" name="user_pwd" <?php if(isset($password)) { echo 'value="'.$password.'"';} ?> required>
                            <div class="underline1"></div>
                            <label>Password</label>
                            <?php
                                if (isset($error_alr))
                                {
                                    echo "<p style='color:red'>". $error_alr . "</p>";
                                }
                                if (isset($error_admin))
                                {
                                    echo "<p style='color:red'>". $error_admin . "</p>";
                                }
                            ?>
                        </div>
                        <input type="checkbox" class="remember1" name="remember">
                        <label for="remember">Se souvenir de moi</label>
                        <div class="section11__connexion__bottom">
                            <a href="/subscribe">Vous n'avez pas de compte ? Créez un compte !</a>
                            <button type="submit" name="SendSub">Connexion</button>
                            <a href="/connexion">Vous n'êtes pas admin ? Connectez vous ici !</a>
                        </div>
                    </div>
                </form>
            </div>

        </section>