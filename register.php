<?php
session_start();
require('inc/fonction.php');
require('inc/pdo.php');
$errors = [];

if(isLogged()) {
    header('Location: 403.php');
}

if(!empty($_POST['submitted'])) {
    // Faille xss
    $pseudo = cleanXss('pseudo');
    $email = cleanXss('email');
    $password = cleanXss('password');
    $password2 = cleanXss('password2');
    // Validation
    $errors = validText($errors,$pseudo,'pseudo',3, 50);
    if(empty($errors['pseudo'])) {
        $sql = "SELECT * FROM users WHERE pseudo = :pseudo";
        $query = $pdo->prepare($sql);
        $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
        $query->execute();
        $verifPseudo = $query->fetch();
        if(!empty($verifPseudo)) {
            $errors['pseudo'] = 'Pseudo existe dèjà';
        }
    }
    $errors = validEmail($errors,$email,'email');
    if(empty($errors['email'])) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email',$email,PDO::PARAM_STR);
        $query->execute();
        $verifEmail = $query->fetch();
        if(!empty($verifEmail)) {
            $errors['email'] = 'Email existe dèjà';
        }
    }
    // password
    if(!empty($password) || !empty($password2)) {
        if($password != $password2) {
            $errors['password'] = 'Veuillez renseigner des mot de passe identiques';
        } elseif (strlen($password2) < 6) {
            $errors['password'] = 'Min 6 caractères pour votre mot de passe';
        }
    } else {
        $errors['password'] = 'Veuillez renseigner un mot de passe';
    }
    if(count($errors) == 0) {
        // generate token
        $token = generateRandomString(100);
        // hashpassword
        $hashpassword = password_hash($password,PASSWORD_DEFAULT);
        // INSERT INTO
        $sql = "INSERT INTO users (pseudo,email,password,token,created_at,role)
                VALUES (:pseudo,:email,:password,:token,NOW(),'abonne')";
        $query = $pdo->prepare($sql);
        $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
        $query->bindValue(':email',$email,PDO::PARAM_STR);
        $query->bindValue(':password',$hashpassword,PDO::PARAM_STR);
        $query->bindValue(':token',$token,PDO::PARAM_STR);
        $query->execute();
        // redirection
        header('Location: login.php');
    }
}
include('inc/header.php'); ?>
<div id="mainform">
    <h1 class="titreh1">Formulaire d'inscription</h1>
    <div class="wrap2">
        <form action="" method="post" novalidate><br>
            <label  id="labs" for="pseudo">Pseudo *</label><br>
            <input  type="text" id="pseudo" name="pseudo" value="<?= getValue('pseudo'); ?>"><br>
            <span class="error"><?= getError($errors,'pseudo'); ?></span><br>

            <label  id="labs"for="email">E-mail *</label><br>
            <input  type="email" id="email" name="email" value="<?= getValue('email'); ?>"><br>
            <span class="error"><?= getError($errors,'email'); ?></span><br>

            <label id="labs" for="password">Password*</label><br>
            <input type="password" id="password" name="password" value=""><br>
            <span class="error"><?= getError($errors,'password'); ?></span><br>

            <label  id="labs"for="password2">Password confirm *</label><br>
            <input  type="password" id="password2" name="password2" value=""><br>

            <input id="sub"type="submit" name="submitted" value="Inscription">
        </form>
    </div>
</div>
<?php include('inc/footer.php');
