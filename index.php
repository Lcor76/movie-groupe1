<?php
require('inc/fonction.php');
require('inc/pdo.php')?>


<<<<<<< HEAD
include('inc/header.php'); ?>
=======
<h1>Home</h1>
>>>>>>> 51ba68bfce114ae89fd38196a84a882f93ed168e





<<<<<<< HEAD
<?php include('inc/footer.php');
=======


<?php


 $sql = "SELECT * FROM movies_full ORDER BY rand() LIMIT 20";
 $query = $pdo->prepare($sql);
 $query->execute();
 $movies = $query->fetchall();

debug($movies);

 include('admin/inc/header.php');?>

 <div id="movies">
     <?php foreach ($movies as $movie) { ?>
         <div>
             <a href="details.php<?= $movie['id']; ?>">
                 <?php echo imageMovie($movie); ?>
             </a>

         </div>
     <?php } ?>
</div>






<?php include('admin/inc/footer.php');
>>>>>>> 51ba68bfce114ae89fd38196a84a882f93ed168e
