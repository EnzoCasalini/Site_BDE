<body>
    <section class="site">
        <section class="section1">
            <div class="section1__topbar">
                <?php 
                    if (isset($_SESSION['user_name']))
                    {
                        echo '<a href="/profile">' . $_SESSION['user_name']; 
                    }
                    else 
                    {
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
                <div class="news">
                <?php if (isset($firstpost['post_image'])) { echo '<img src="./assets/IMG/Posts/' . $firstpost['post_image'] . '" alt="Img">'; } ?>
                    <div class="news__text">
                    <p> <?php if (isset($firstpost['post_mel'])) { $date_en_fr = implode('/',array_reverse(explode('-',$firstpost['post_mel'])));  echo $date_en_fr; }?></p>
                        <h2> <?php if (isset($firstpost['post_title'])) { echo $firstpost['post_title']; }?> </h2>
                        <span> <?php if (isset($firstpost['post_content'])) { echo $firstpost['post_content']; }?> </span>
                    </div>
                </div>
                <div class="news">
                <?php if (isset($secondpost['post_image'])) { echo '<img src="./assets/IMG/Posts/' . $secondpost['post_image'] . '" alt="Img">'; } ?>
                    <div class="news__text">
                    <!-- Le implode/explode etc en dessous permet de diviser la date de mysql, la reverse et mettre des / entre chaque chiffres pour passer de la date anglaise à française. !-->
                    <p> <?php if (isset($secondpost['post_mel'])) { $date_en_fr = implode('/',array_reverse(explode('-',$secondpost['post_mel'])));  echo $date_en_fr; }?></p>
                        <h2> <?php if (isset($secondpost['post_title'])) { echo $secondpost['post_title']; }?> </h2>
                        <span> <?php if (isset($secondpost['post_content'])) { echo $secondpost['post_content']; }?> </span>
                    </div>
                </div>
            </div>

        </section>
