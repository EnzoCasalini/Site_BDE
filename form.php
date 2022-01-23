<?php

//on include la class csrf
require_once("CSRF.php");

?>


<form method="POST" action="submit.php">
    <?php

    CSRF::creationDuToken(); //on accede a la methode creationDuToken de la classe CSRF
    ?>
    <!-- formulaire -->
    <input name="name" placeholder="Enter name" />

    <!--boutton envoyer-->
    <input type="submit"/>

</form>
