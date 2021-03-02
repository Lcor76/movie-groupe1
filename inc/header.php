<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MOVIES AND POSTER</title>
    <link rel="stylesheet" href="asset/style.css">
</head>
<body>
<header>
    <div class="wrap">
        <nav>
            <ul class="ulcenter">
                <li><a href="admin/index.php">Back</a></li>
                <?php if(isLogged()) { ?>
                    <li><a href="logout.php">Déconnexion</a></li>
                    <li>Bonjour <?= ucfirst($_SESSION['user']['pseudo']) ?></li>
                <?php } else { ?>
                    <li><a href="register.php">Inscription</a></li>
                    <li><a href="login.php">Connexion</a></li>
                <?php } ?>
            </ul>
        </nav>
        <div id="filtres">
          <label for="scales">DRAME</label>
          <input type="checkbox" id="drame" name="scales">
        </div>
    </div>
</header>
