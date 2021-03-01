<?php
require('inc/function.php');
require('admin/inc/pdo.php')














include('inc/header.php');?>

<div id="movies">

<?php foreach ($movies as $movie){ ?>

  <div class="boximages"><?php echo $movie['id']; ?></div>


<?php } ?>

</div>




<?php include('admin/inc/footer.php');
