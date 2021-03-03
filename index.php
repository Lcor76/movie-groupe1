<?php
session_start();

require('inc/fonction.php');
require('inc/pdo.php')?>


<?php


 $sql = "SELECT * FROM movies_full ORDER BY rand() LIMIT 20";
 $query = $pdo->prepare($sql);
 $query->execute();
 $movies = $query->fetchall();


 $categorys = array('drama','comedy','animation','crime','horror','romance',);

if (!empty($_GET['submitted'])) {



    if(!empty($_GET['genres'])) {
        $genres = $_GET['genres'];

        if(!empty($_GET['year1'])){
            $year1  = $_GET['year1'];
            }

            if(!empty($_GET['year2'])){
            $year2  = $_GET['year2'];
             }

    } else {
        $genres = array();
        $year1  = $_GET['year1'];
        $year2 =  $_GET['year2'];


    }

    $sql = "SELECT * FROM movies_full WHERE  year >= $year1 AND year <= $year2";
    if(!empty($genres)) {
        foreach($genres as $genre) {
            $sql .= " AND genres LIKE :$genre";
        }
    }



    $sql .= " ORDER BY RAND() LIMIT 20";


    $query = $pdo->prepare($sql);

    if(!empty($genres)) {
        foreach($genres as $genre) {
            $query->bindValue(':'.$genre,'%' . $genre . '%',PDO::PARAM_STR);

        }
    }

    $query->execute();
    $movies = $query->fetchAll();


}





include('inc/header.php');?>

<form action="" method="GET">
      <div id="headerfiltre">
        <div class="checkbox">
           <h1 class="titrefiltre">FILTRES :</h1>
          <?php foreach($categorys as $category)  { ?>
            <label for="<?= $category; ?>"><?= ucfirst($category); ?><input name="genres[]" type="checkbox" value="<?= $category; ?>"></label>
          <?php }  ?>

           <input type="number" name="year1" value="1900" />
           <input type="number" name="year2" value="2020" />
           <input id="subfiltre" type="submit" name="submitted" value="FILTRER">
        </div>


      </div>
    </form>




      <div class="clear"></div>

<div class="wrap">
     <div id="movies">
         <?php foreach ($movies as $movie) { ?>
             <div id="imagebox">
                 <a style=width:auto;height:200px; id="affiches" href="details.php?slug=<?= $movie['slug']; ?>" >
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
