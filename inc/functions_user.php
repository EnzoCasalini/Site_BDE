<?php


function is_logged(): bool
{
    return isset($_SESSION['connected']);
}

// INSCRIPTION.

function subscribe(string $nickname, string $email, string $class, string $password, PDO $bdd)
{
    // On vérifie que l'adresse entrée par l'utilisateur n'existe pas déjà.
    $verify = $bdd->prepare('SELECT user_name, user_mail, user_role, user_pwd, user_pp FROM user WHERE user_mail = ?');
    $verify->execute(array($email));
    // On cherche le nombre de lignes qui possèdent l'adresse mail entrée par l'utilisateur (il y en aura au max 1).
    $row = $verify->rowCount();

    $verify = $bdd->prepare('SELECT user_name, user_mail, user_role, user_pwd, user_pp FROM user WHERE user_name = ?');
    $verify->execute(array($nickname));
    $row2 = $verify->rowCount();

    if ($row == 0)
    {
        if ($row2 == 0)
        {
            // On insert dans la BDD les valeurs inscrites dans les champs du formulaire.
            $sql = 'INSERT INTO user (user_name, user_mail, user_role, user_pwd, user_pp) VALUES (:user_name, :user_mail, :user_role, :user_pwd, :user_pp)';
            $stmt = $bdd->prepare($sql);
            return $stmt->execute(array(
                'user_name' => $nickname,
                'user_mail' => $email,
                'user_role' => $class,
                'user_pwd'  => password_hash($password, PASSWORD_DEFAULT),
                'user_pp'   => 'default_pp.jpg'
            ));
        } return 1;
    } return false;
}

// CONNECTION.

function connect (string $email, string $password, PDO $bdd)
{
    $verify = $bdd->prepare('SELECT id_user, user_name, user_mail, user_role, user_pwd, user_pp FROM user WHERE user_mail = ?');
    $verify->execute(array($email));
    // On lit la ligne correspondante.
    $data = $verify->fetch();
    // On vérifie si l'adresse mail rentrée existe bien dans notre BDD.
    $row = $verify->rowCount();

    if ($row == 1)
    {
        if (!empty($data) && password_verify($password, $data['user_pwd']))
        {
            $_SESSION['connected'] = true;
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['user_name'] = $data['user_name'];
            $_SESSION['user_mail'] = $data['user_mail'];
            $_SESSION['user_role'] = $data['user_role'];
            $_SESSION['user_pp'] = $data['user_pp'];

            /* Gestion de l'écriture des logs dans un fichier */

            $file = fopen("../public/log.txt", "a");
            date_default_timezone_set('Europe/Paris');
            // On récupère la date d'aujourd'hui sous la forme d'un tableau.
            $todayDate=getdate();
            // mday = jour du mois / mon = mois / year = année.
            $day = $todayDate["mday"] ."/". $todayDate["mon"] . "/" .$todayDate["year"];
            $hour = $todayDate["hours"] ."H". $todayDate["minutes"];
            $d = $day ." à ". $hour;
            fwrite($file, $_SESSION['user_name'] . " : " . $_SESSION['user_mail'] . " s'est connecté(e) le " . $d . "\r\n");
            fclose($file);
        } else return false;
    } else return 1;
}


// VÉRIFICATION ET CHANGEMENT DE LA PP.

function check_pp (array $pp)
{
    $maxSize = 2097152;
    $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');

    if(!empty($pp['name']))
    {
        if($pp['size'] <= $maxSize)
        {
            // Ici, strrchr : Renvoie l'extension du fichier (avec le point). Pour enlever le point, on fait un substr qui enlève le premier caractère de la chaîne (donc le point).
            $extensionUpload = strtolower(substr(strrchr($pp['name'], '.'), 1));
            // On vérifie que le format du fichier correspond bien à ceux qu'on autorise.
            if(in_array($extensionUpload, $extensionsValides))
            {
                $path = "./assets/IMG/PP/" . $_SESSION['id_user'] . "." . $extensionUpload;
                // ['tmp_name'] correspond à un chemin temporaire (le dossier où est actuellement le fichier).
                return move_uploaded_file($pp['tmp_name'], $path);
            }else return 1;
        }else return 2;
    }else return 0;
}

function change_pp (array $pp, PDO $bdd)
{
    $extensionUpload = strtolower(substr(strrchr($pp['name'], '.'), 1));

    // Mise à jour dans la BDD.
    $sql = 'UPDATE user SET user_pp = :user_pp WHERE id_user = :id_user';
    $updateAvatar = $bdd->prepare($sql);
    return $updateAvatar->execute(array(
        'user_pp' => $_SESSION['id_user'] . "." . $extensionUpload,
        'id_user' => $_SESSION['id_user']
    ));
}


// VÉRIFICATION ET CHANGEMENT DU NICKNAME.

function check_nickname (string $nickname, PDO $bdd)
{
    $verify = $bdd->prepare('SELECT user_name, user_mail, user_role, user_pwd, user_pp FROM user WHERE user_name = ?');
    $verify->execute(array($nickname));
    $row = $verify->rowCount();

    $space_nickname = strpos($nickname, " ");

    if (!empty($nickname))
    {
        // Si le pseudo n'existe pas ou que c'est le même qu'actuellement.
        if($row == 0 || $nickname == $_SESSION['user_name'])
        {
            if (strlen($nickname) > 2 && strlen($nickname) < 31 && $space_nickname == false)
            {
                return true;
            } else return 2;
        } else return 1;
    } else return 0;
}

function change_nickname (string $nickname, PDO $bdd)
{
    // Mise à jour dans la BDD.
    $sql = 'UPDATE user SET user_name = :user_name WHERE id_user = :id_user';
    $updateNickname = $bdd->prepare($sql);
    return $updateNickname->execute(array(
        'user_name' => $nickname,
        'id_user'   => $_SESSION['id_user']
    ));
}


// VÉRIFICATION ET CHANGEMENT DE L'EMAIL.

function check_mail (string $email, PDO $bdd)
{
    $verify = $bdd->prepare('SELECT user_name, user_mail, user_role, user_pwd, user_pp FROM user WHERE user_mail = ?');
    $verify->execute(array($email));
    $row = $verify->rowCount();

    if (!empty($email))
    {
        // Si le mail n'existe pas ou que c'est le même qu'actuellement.
        if ($row == 0 || $email == $_SESSION['user_mail'])
        {
            if (strlen($email) <= 100 && strpos($email, "@ynov") == true)
            {
                if (filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    return true;
                } else return 3;
            } else return 2;
        } else return 1;
    } else return 0;
}

function change_mail (string $email, PDO $bdd)
{
    // Mise à jour dans la BDD.
    $sql = 'UPDATE user SET user_mail = :user_mail WHERE id_user = :id_user';
    $updateAvatar = $bdd->prepare($sql);
    return $updateAvatar->execute(array(
        'user_mail' => $email,
        'id_user'   => $_SESSION['id_user']
    ));
}


// VÉRIFICATION ET CHANGEMENT DU PASSWORD.

function check_pwd (string $pwd)
{
    if(!empty($pwd))
    {
        // On vérifie si le mot de passe contient au moins une majuscule, un chiffre et 8 caractères au total.
        if (preg_match('#^(?=.*\d)(?=.*[A-Z]).{8}#', $pwd))
        {
            return true;
        }else return 1;
    }else return 0;
}

function change_pwd (string $pwd, PDO $bdd)
{
    // Mise à jour dans la BDD.
    $sql = 'UPDATE user SET user_pwd = :user_pwd WHERE id_user = :id_user';
    $updatePassword = $bdd->prepare($sql);
    return $updatePassword->execute(array(
        'user_pwd' => password_hash($pwd, PASSWORD_DEFAULT),
        'id_user'   => $_SESSION['id_user']
    ));
}

// Actualisation des informations de l'utilisateur.

function updating(int $user_id, PDO $bdd)
{
    $sql = 'SELECT id_user, user_name, user_mail, user_pp, user_pwd FROM user WHERE id_user = ?';
    $verify = $bdd->prepare($sql);
    $verify->execute(array($user_id));
    // On lit la ligne correspondante.
    $data = $verify->fetch();
    // On vérifie si l'user_id rentré existe bien dans notre BDD.
    $row = $verify->rowCount();

    if ($row == 1)
    {
        if (!empty($data))
        {
            $_SESSION['user_name'] = $data['user_name'];
            $_SESSION['user_pp'] = $data['user_pp'];
            $_SESSION['user_mail'] = $data['user_mail'];
            $_SESSION['user_pwd'] = $data['user_pwd'];
            return true;
        } else return false;
    } else echo 'aïe !';
}

?>