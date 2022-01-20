<?php


function is_logged(): bool
{
    return isset($_SESSION['connected']);
}


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

function connect_admin (string $email, string $password, PDO $bdd)
{
    $verify = $bdd->prepare('SELECT id_user, user_name, user_mail, user_role, user_pwd, user_pp, admin FROM user WHERE user_mail = ?');
    $verify->execute(array($email));
    // On lit la ligne correspondante.
    $data = $verify->fetch();
    // On vérifie si l'adresse mail rentrée existe bien dans notre BDD.
    $row = $verify->rowCount();

    if ($row == 1)
    {
        if (!empty($data) && password_verify($password, $data['user_pwd']))
        {
            if ($data['admin'] == 0){
                return 2;
            }else{
                
            $_SESSION['connected'] = true;
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['user_name'] = $data['user_name'];
            $_SESSION['user_mail'] = $data['user_mail'];
            $_SESSION['user_role'] = $data['user_role'];
            $_SESSION['user_pp'] = $data['user_pp'];
            $_SESSION['admin'] = 1;

            /* Gestion de l'écriture des logs dans un fichier */

            $file = fopen("../public/log.txt", "a");
            date_default_timezone_set('Europe/Paris');
            // On récupère la date d'aujourd'hui sous la forme d'un tableau.
            $todayDate=getdate();
            // mday = jour du mois / mon = mois / year = année.
            $day = $todayDate["mday"] ."/". $todayDate["mon"] . "/" .$todayDate["year"];
            $hour = $todayDate["hours"] ."H". $todayDate["minutes"];
            $d = $day ." à ". $hour;
            fwrite($file, $_SESSION['user_name'] . " (admin) : " . $_SESSION['user_mail'] . " s'est connecté(e) le " . $d . "\r\n");
            fclose($file);
            }
        } else return false;
    } else return 1;
}



function change_pp(array $pp, PDO $bdd)
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
                $result = move_uploaded_file($pp['tmp_name'], $path);
                if ($result)
                {
                    $sql = 'UPDATE user SET user_pp = :user_pp WHERE id_user = :id_user';
                    $updateAvatar = $bdd->prepare($sql);
                    return $updateAvatar->execute(array(
                        'user_pp' => $_SESSION['id_user'] . "." . $extensionUpload,
                        'id_user' => $_SESSION['id_user']
                    ));
                }else return false;
            }else return 1;
        }else return 2;
    } 
}

function change_nickname (string $nickname, PDO $bdd) 
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
                $sql = 'UPDATE user SET user_name = :user_name WHERE id_user = :id_user';
                $updateAvatar = $bdd->prepare($sql);
                return $updateAvatar->execute(array(
                    'user_name' => $nickname,
                    'id_user'   => $_SESSION['id_user']
                ));
            } else return 1;
        } else return 2;
    } else return 0;
}


function updating(string $email, PDO $bdd)
{
    $sql = 'SELECT user_name, user_mail, user_pp FROM user WHERE user_mail = ?';
    $verify = $bdd->prepare($sql);
    $verify->execute(array($email));
    // On lit la ligne correspondante.
    $data = $verify->fetch();
    // On vérifie si l'adresse mail rentrée existe bien dans notre BDD.
    $row = $verify->rowCount();

    if ($row == 1)
    {
        if (!empty($data))
        {
            $_SESSION['user_name'] = $data['user_name'];
            $_SESSION['user_pp'] = $data['user_pp'];
            return true;
        } else return false;
    } else echo 'aïe !';
}


function newPost(int $postnumber, PDO $bdd)
{
    $sql = 'SELECT post_title, post_image, post_content, post_mel FROM post WHERE id_post = ?';
    $verify = $bdd->prepare($sql);
    $verify->execute(array($postnumber));
    $data = $verify->fetch();

    if (!empty($data))
    {
        return $data;
    }
}

?>