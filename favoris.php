<?php


session_start();


require('inc/fonction.php');
require('inc/pdo.php');



if(!isLogged()) {
    die('403');
}


if (!empty($_GET['id'])) {
    $movie_id = $_GET['id'];


    $sql = "SELECT * FROM movies_full WHERE id = $movie_id";

    $query = $pdo->prepare($sql);

    $query->execute();
    $movie = $query->fetch();


    $utilisateur = $_SESSION['user']['id'];
  


    if(!empty($movie)) {

 
      
        $sql = "INSERT INTO add_movies (id_user, id_movie) VALUES (:id_user, :id_movie)";

        $query = $pdo->prepare($sql);
        $query->bindValue(':id_user'    ,$utilisateur ,PDO::PARAM_INT );
        $query->bindValue(':id_movie'   ,$movie_id ,PDO::PARAM_INT );
        $query->execute();

        ?>
        <?php
         include('inc/header.php'); ?>
       
        <?php header('Refresh:2;url=index.php');?>

       
         <div class= "refresh">
         <h1>Film sauvegardé dans vos favoris</h1>
        </div>

        
         <?php
       
       


        
    
    


    }

} else {

    die('404');
}
include('inc/footer.php');