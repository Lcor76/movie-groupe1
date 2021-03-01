<?php
require('inc/fonction.php');
require('inc/pdo.php')?>



<h1>Home</h1>


<?php


 $sql = "SELECT * FROM movies_full ORDER BY rand() LIMIT 20";
 $query = $pdo->prepare($sql);
 $query->execute();
 $movies = $query->fetchall();?>




 <?php include('inc/header.php');?>
<div class="wrap">
     <div id="movies">
         <?php foreach ($movies as $movie) { ?>
             <div id="imagebox">
                 <a id="affiches" href="details.php?slug=<?= $movie['slug']; ?>">
                     <?php echo imageMovie($movie); ?>
                 </a>

             </div>

         <?php } ?>
    </div>
</div>
   <div class="clear"></div>





<?php include('inc/footer.php');?>
