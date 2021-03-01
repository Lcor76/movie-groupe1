<?php

require('inc/fonction.php');
require('inc/pdo.php');


if(!empty($_GET['slug']) && ctype_digit($_GET['slug'])) {
    $slug = $_GET['slug'];

    $sql = "SELECT * FROM movies_full WHERE $slug = slug LIMIT 10";

    $query = $pdo->prepare($sql);
    $query->bindValue(':slug',$slug,PDO::PARAM_INT);
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
        <p>-Directeur         : <?= $movie['directors'] ?></p><br/>
        <p>-Casting         : <?= $movie['cast'] ?></p><br/>
        <p>-Writers         : <?= $movie['writers'] ?></p><br/>





<?php
include('inc/footer.php');
