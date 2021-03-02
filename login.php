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
        <h1 id="titreconnect">Connexion</h1>
        <div id="boxslug">
          <div class="boxslug2">
            <form action="" method="post" novalidate>
                <label id="pseudoemail" for="login">Pseudo or E-mail</label><br>
                <input type="text" id="login" name="login" value="<?= getValue('login'); ?>"><br>
                <span class="error"><?= getError($errors,'login'); ?></span><br>

                <label id="labs" for="password">Password *</label><br>
                <input type="password" id="password" name="password" value="">

                <input id="sub" type="submit" name="submitted" value="Connexion">
            </form>
               <a id="linkmdp" href="passwordforget.php">Mot de passe oublié</a>
          </div>

        </div>
    </div>

<?php include('inc/footer.php');
