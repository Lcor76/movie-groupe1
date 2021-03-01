<?php
require('inc/function.php');
require('inc/pdo.php');




if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

 $id = $_GET ['id'];
 $sql = "SELECT * FROM movies_full WHERE id = :id ORDER BY rand()LIMIT 20";
 $query = $pdo->prepare($sql);
 $query->bindValue(':id',$id,PDO::PARAM_STR);
 $query->execute();q
 $movies = $query->fetchall();

   }


} else {
  die('404');
}








include('inc/header.php'); ?>




<?php include('inc/footer.php');
