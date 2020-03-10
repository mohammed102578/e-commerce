
<nav class="navbar navbar-expand-lg navbar-light bg-color justify-content-between ">
  <a class="navbar-brand" href="index.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i>Home Page</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="catnavbr navbar-nav nav-ml mr-auto" >
      <?php 
 //$categories=getAllform("*","categories","","","ID");     
#$categories=getcategories();
foreach ($categories as $categorie) {

echo '<li><a class="acat" href="item-cat.php?catID='.$categorie['ID'].'">'.$categorie['Name']."</a>"."</li>";


}



      ?>
      
  </ul>
    
  </div>
</nav>

<?php include $template."footer.inc"; ?>




