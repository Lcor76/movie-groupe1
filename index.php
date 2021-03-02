<?php
session_start();

require('inc/fonction.php');
require('inc/pdo.php')?>






<?php


 $sql = "SELECT * FROM movies_full ORDER BY rand() LIMIT 20";
 $query = $pdo->prepare($sql);
 $query->execute();
 $movies = $query->fetchall();




include('inc/header.php');?>



      <div id="headerfiltre">
        <div class="checkbox">
           <h1 class="titrefiltre">FILTRER :</h1>
           <label for="drame">DRAMA<input type="checkbox" class="drame" name="drame"></label>
           <label for="comedy">COMEDY<input type="checkbox" class="comedy" name="comedy"></label>
           <label for="action">ACTION<input type="checkbox" class="action" name="action"></label>
           <label for="crime">CRIME<input type="checkbox" class="crime" name="crime"></label>
           <label for="horror">HORROR<input type="checkbox" class="horror" name="horror"></label>
           <label for="romance">ROMANCE<input type="checkbox" class="romance" name="romance"></label>
           <input id="subfiltre"type="submit" name="" value="FILTRER">
        </div>
      </div>

      <div class="clear"></div>

<div class="wrap">
     <div id="movies">
         <?php foreach ($movies as $movie) { ?>
             <div id="imagebox">
                 <a id="affiches" href="details.php?slug=<?= $movie['slug']; ?>" "style=width:auto;height:200px;">
                    <?php echo imageMovie($movie); ?>
                  </a>

             </div>


         <?php } ?>
    </div>
    <div id="btnplusbox">
        <button   class="btnplus" type="submit" name="button"><a href="index.php"> + de films !</a></button>
    </div>

</div>

   <div class="clear"></div>





<?php include('inc/footer.php');?>
