<?php
session_start();
require('inc/fonction.php');
require('inc/pdo.php');

if(isLogged()) {
    header('Location: 403.php');
}

$errors = [];
if(!empty($_POST['submitted'])) {
    $login    = cleanXss('login');
    $password = cleanXss('password');
    $sql = "SELECT * FROM users WHERE email = :login OR pseudo = :login";
    $query = $pdo->prepare($sql);
    $query->bindValue(':login', $login, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();
    if(!empty($user)) {
        if(password_verify($password,$user['password'])) {
            $_SESSION['user'] = array(
                    'id' => $user['id'],
                'pseudo' => $user['pseudo'],
                 'email' => $user['email'],
                  'role' => $user['role'],
                    'ip' => $_SERVER['REMOTE_ADDR']
            );
            // debug($_SESSION);
            header('Location: index.php');
        } else {
            $errors['login'] = 'The credentials you supplied were not correct';
        }
    } else {
        $errors['login'] = 'The credentials you supplied were not correct';
    }
}

include('inc/header.php'); ?>
    <div class="wrap">
        <h1>Connexion</h1>
        <div class="wrap2">
            <form action="" method="post" novalidate>
                <label for="login">Pseudo or E-mail</label>
                <input type="text" id="login" name="login" value="<?= getValue('login'); ?>">
                <span class="error"><?= getError($errors,'login'); ?></span>

                <label for="password">Password *</label>
                <input type="password" id="password" name="password" value="">

                <input type="submit" name="submitted" value="Connexion">
            </form>

            <a href="passwordforget.php">Mot de passe oublié</a>
        </div>
    </div>

<?php include('inc/footer.php');
