<?php
session_start();

require('inc/fonction.php');
require('inc/pdo.php');



if(!empty($_GET['slug'])) {
    $slug = $_GET['slug'];

    $sql = "SELECT * FROM movies_full where slug = :slug";

    $query = $pdo->prepare($sql);
    $query->bindValue(':slug',$slug,PDO::PARAM_STR);
    $query->execute();
    $movies = $query->fetch();



    if(empty($movies)){
        die('404');
    }

} else {
    die('404');
}

if(isLogged()){ 

  echo 'Bonjour : '.$_SESSION['users']['pseudo'];

} else {

  echo 'Vous n\'êtes pas connecté';
}

// debug($movies);





include('inc/header.php');?>

      <div id="boxslug">
        <div class="boxslug2">
          <img class="poster" src="posters/<?= $movies['id']?>.jpg">
            <div id="boxdetails">
              <h2 class="title" ><?= $movies['slug'] ?></h2><br/>
              <p >-Titre du film : <?= $movies['title'] ?></p>
              <p>-Année         : <?= $movies['year'] ?></p>
              <p>-Genre         : <?= $movies['genres'] ?></p><br/>
              <p>-Directeur     : <?= $movies['directors'] ?></p><br/>
              <p>-Casting       : <?= $movies['cast'] ?></p><br/>
              <p>-Writers       : <?= $movies['writers'] ?></p><br/>
            </div>
        </div>
     </div>




<?php
include('inc/footer.php');
