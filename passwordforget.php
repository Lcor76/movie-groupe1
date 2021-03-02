<?php
session_start();
require('inc/fonction.php');
require('inc/pdo.php');
$errors = array();
if(!empty($_POST['submitted'])) {
    $email = cleanXss('email');
    $errors = validEmail($errors,$email,'email');
    if(count($errors) == 0) {
        $sql = "SELECT email,token FROM users WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email',$email,PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();
        if(!empty($user)) {
            // ici le lien créé, il devra etre envoyé par email
            $html = '<a href="changepassword.php?email='.urlencode($email).'&token='.urlencode($user['token']).'">Click ici pour changer ton mot de passe</a>';
            echo $html;
        } else {
            $errors['email'] = 'tu sors';
        }
    }
}

include('inc/header.php'); ?>
<div class="wrap2">
    <h1>Mot de passe oublié</h1>
    <form action="" method="post" novalidate>
        <label for="email">E-mail *</label>
        <input type="email" id="email" name="email" value="<?= getValue('email'); ?>">
        <span class="error"><?= getError($errors,'email'); ?></span>

        <input type="submit" name="submitted" value="Inscription">
    </form>
</div>
<?php include('inc/footer.php');
