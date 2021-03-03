<?php

session_start();

require('inc/fonction.php');
require('inc/pdo.php');



if(!isLogged()) {
    die('403');
}


$user_id = $_SESSION['user']['id'];



// RIGHT JOIN movies_full ON add_movies.id = movies_full.id
        
$sql = "SELECT * FROM add_movies AS ad
        LEFT JOIN movies_full AS m
        ON ad.id_movie = m.id
        WHERE ad.id_user = $user_id
        ";

$query = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetchAll();


if(empty($movies)){
    die('404');

} 


include('inc/header.php');


    foreach($movies as $movie){?>
        <div id="fav">
        <p><img class="poster" src="posters/<?= $movie['id']?>.jpg"></p>
        </div>
   <?php  } ?>
    
  













<?php
include('inc/footer.php');