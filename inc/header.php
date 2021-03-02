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
  <header class="site-header">
    <div class="wrapper site-header__wrapper">
      <h1 href="#" class="brand">Ace Of Hearts</h1>
      <nav class="nav">
        <button class="nav__toggle" aria-expanded="false" type="button">
          menu
        </button>
        <ul class="nav__wrapper">
          <li class="nav__item"><a href="index.php">Home</a></li>
          <li class="nav__item"><a href="#">About</a></li>
          <?php if(isLogged()) { ?>
              <li><a class="nav__item" href="logout.php">Déconnexion</a></li>
              <li>Bonjour <?= ucfirst($_SESSION['user']['pseudo']) ?></li>
          <?php } else { ?>
              <li class="nav__item"><a  href="register.php">Inscription</a></li>
              <li class="nav__item"><a  href="login.php">Connexion</a></li>
          <?php } ?>

        </ul>
      </nav>
    </div>
  </header>
