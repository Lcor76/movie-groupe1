<?php

require('inc/fonction.php');
require('inc/pdo.php');


if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {                                         
    $id = $_GET['id'];

    $sql = "SELECT * FROM movies_full WHERE $slug = slug";

    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
    $movie = $query->fetch();
    if(empty($movie)){
        die('404');
    }

} else {
    die('404');
}


include('inc/header.php');?>


        <h2><?= $movie['name'] ?></h2><br/>
        <p>-Titre du film : <?= $movie['title'] ?></p>
        <p>-Année         : <?= $movie['year'] ?></p>
        <p>-Genre         : <?= $movie['genres'] ?></p><br/>




<?php
include('inc/footer.php');
