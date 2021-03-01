<?php
<<<<<<< HEAD

session_start();
require('inc/fonction.php');
require('inc/pdo.php');
=======
require('inc/fonction.php');
require('inc/pdo.php')?>
>>>>>>> 51ba68bfce114ae89fd38196a84a882f93ed168e


<h1>Home</h1>







<<<<<<< HEAD





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
>>>>>>> 51ba68bfce114ae89fd38196a84a882f93ed168e






<?php include('admin/inc/footer.php');
