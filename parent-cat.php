<?php
ob_start();
session_start();



$pageTitle="Department";
include 'initialize1.php';
//CHECK THE ID GET FROM HEADER PAGE
if (isset($_GET['catID'])) {
	$ID=$_GET['catID'];
}else{
	$ID=0;
}
echo "<h1>"."Show Department"."</h1>";
$departs=getAllform("*","categories","WHERE `parent`=$ID","","Name");





if (!empty($departs)) {
	echo "<div class='container'>";
    echo "<div class='row'>";
	foreach ($departs as $depart) {
		
		




echo"<div class='col-xm-12 col-sm-6 col-md-3 '>";

	echo "<div class='tag'>";
	


echo"<img   class='itemimg img img-responsive  col-xm-12 col-sm-6 col-md-3' src='adminstration/upload/avatar/".$depart['avatar']."' alt='no picture'>";

 
echo "<h3>"."<a href='item-cat.php?depID=";

 

	echo $depart['ID'];

 	

 echo "'>".$depart['Name']."</a>"."</h3>";
echo"</div>";
echo"</div>";








	
}
echo"</div>";
}
else{
	echo "<div class='alert alert-danger'>"."NO ITEM TO SHOW"."</div>";
}
echo"</div>";

ob_end_flush();
include $template."footer.inc"; 
?>