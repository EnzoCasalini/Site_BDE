<body>
    <section class="site">
        <section class="section13">
            <div class="section13__topbar">
                <a href="/connexion">CONNEXION</a>
                <div class="burger" id="burger-icon">
                    <div></div>
                </div>
            </div>


            <div class="section13__title">
                <h1>INSCRIPTION</h1>
                <img src="./assets/IMG/Ynov.svg" alt="Ynov Sophia Campus">
                <form method="post">
                    <div class="section13__inscription">
                        <h2>INSCRIPTION</h2>
                        <div class="input-data3">
                            <!-- Ici le onkeydown permet de ne pas prendre en compte la touche espace !-->
                            <input type="text" onkeydown="if(event.keyCode==32) return false;" name="user_name" <?php if(isset($nickname)) { echo 'value="'.$nickname.'"';} ?> required>
                            <div class="underline3"></div>
                            <label>Nom d'utilisateur</label>
                            <?php
                                if (isset($error_nickname))
                                {
                                    echo "<p style='color:red'>". $error_nickname . "</p>";
                                }
                            ?>
                        </div>

                        <div class="input-data3">
                            <input type="text" onkeydown="if(event.keyCode==32) return false;" name="user_mail" <?php if(isset($email)) { echo 'value="'.$email.'"';} ?> required>
                            <div class="underline3"></div>
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
                            ?>
                        </div>
                
                        <div class="input-data3">
                            <input type="text" onkeydown="if(event.keyCode==32) return false;" name="user_role" <?php if(isset($class)) { echo 'value="'.$class.'"';} ?> required>
                            <div class="underline3"></div>
                            <label>Classe</label>
                            <?php
                            if (isset($_POST['SendSub']))
                                if (isset($error_class))
                                {
                                    echo "<p style='color:red'>". $error_class . "</p>";
                                }
                            ?>
                        </div>

                        <div class="input-data3">
                            <input type="password" onkeydown="if(event.keyCode==32) return false;" name="user_pwd" required>
                            <div class="underline3"></div>
                            <label>Password</label>
                            <?php
                                if (isset($error_pwd))
                                {
                                    echo "<p style='color:red'>". $error_pwd . "</p>";
                                }
                            ?>
                        </div>
                        <?php
                            if (isset($error_form))
                            {
                                echo "<p style='color:red'>". $error_form . "</p>";
                            }
                        ?>
                        <div class="section13__inscription__bottom">
                            <a href="/connexion">Vous avez déjà un compte ? Se connecter</a>
                            <button type="submit" name="SendSub">Inscription</button>
                        </div>
                    </div>
                </form>
            </div>

        </section>