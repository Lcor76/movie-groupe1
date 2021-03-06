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
            $html = '<a href="changePassword.php?email='.urlencode($email).'&token='.urlencode($user['token']).'">Click ici pour changer ton mot de passe</a>';
            echo $html;
        } else {
            $errors['email'] = 'tu sors';
        }
    }
}


 include('inc/header.php'); ?>
<div class="wrap2">
    <h1 id="titremdp" >Mot de passe oublié</h1><br>
    <form action="" method="post" novalidate>
        <label id="labs" for="email">E-mail *</label><br>
        <input type="email" id="email" name="email" value="<?= getValue('email'); ?>">
        <span class="error"><?= getError($errors,'email'); ?></span>

        <input id="linkmdp1" type="submit" name="submitted" value="Envoyer">

    </form>

</div>
<?php include('inc/footer.php');
