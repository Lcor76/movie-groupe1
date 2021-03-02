<?php
session_start();
require('inc/fonction.php');
require('inc/pdo.php');

$errors = array();

if(!empty($_GET['email']) && !empty($_GET['token'])) {
    $email = urldecode($_GET['email']);
    $token = urldecode($_GET['token']);
    $sql = "SELECT * FROM users WHERE email = :email AND token = :token";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->bindValue(':token',$token,PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();
    if(!empty($user)) {
        if(!empty($_POST['submitted'])) {
            $password = cleanXss('password');
            $password2 = cleanXss('password2');
            // password
            if(!empty($password) || !empty($password2)) {
                if($password != $password2) {
                    $errors['password'] = 'Veuillez renseigner des mots de passe identiques';
                } elseif (strlen($password2) < 6) {
                    $errors['password'] = 'Min 6 caractères pour votre mot de passe';
                }
            } else {
                $errors['password'] = 'Veuillez renseigner un mot de passe';
            }
            if(count($errors) == 0) {
                $token = generateRandomString(100);
                $hashpassword = password_hash($password,PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password = :hash, token = :token WHERE id = :id";
                $query = $pdo->prepare($sql);
                $query->bindValue(':hash',$hashpassword,PDO::PARAM_STR);
                $query->bindValue(':token',$token,PDO::PARAM_STR);
                $query->bindValue(':id',$user['id'],PDO::PARAM_INT);
                $query->execute();
                header('Location: login.php');
            }
        }
    } else {
        die('404');
    }
} else {
    die('404');
}

include('inc/header.php'); ?>
    <div class="wrap2">
        <form action="" method="post" novalidate>
            <label id="labs" for="password">Password *</label>
            <input type="password" id="password" name="password" value="">
            <span class="error"><?= getError($errors,'password'); ?></span>

            <label id="labs" for="password2">Password confirm *</label>
            <input type="password" id="password2" name="password2" value="">

            <input id="sub" type="submit" name="submitted" value="Inscription">
        </form>
    </div>

<?php include('inc/footer.php');
