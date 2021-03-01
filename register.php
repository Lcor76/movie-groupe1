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
<div class="wrap">
    <h1>Enregistrement</h1>
    <div class="wrap2">
        <form action="" method="post" novalidate>
            <label for="pseudo">Pseudo *</label>
            <input type="text" id="pseudo" name="pseudo" value="<?= getValue('pseudo'); ?>">
            <span class="error"><?= getError($errors,'pseudo'); ?></span>

            <label for="email">E-mail *</label>
            <input type="email" id="email" name="email" value="<?= getValue('email'); ?>">
            <span class="error"><?= getError($errors,'email'); ?></span>

            <label for="password">Password *</label>
            <input type="password" id="password" name="password" value="">
            <span class="error"><?= getError($errors,'password'); ?></span>

            <label for="password2">Password confirm *</label>
            <input type="password" id="password2" name="password2" value="">

            <input type="submit" name="submitted" value="Inscription">
        </form>
    </div>
</div>
<?php include('inc/footer.php');
