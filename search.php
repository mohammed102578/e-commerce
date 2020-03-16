<?php

ob_start();
session_start();
$pageTitle="search";

include 'initialize1.php';
include "slid.inc";
echo '<div class="container">';
$searget=$_GET['search'];


if (!empty($searget)) {
	
if (isset($searget)&&is_string($searget)) {
	
$search=strval($searget);


$SEARCH=getAllform("*","item","WHERE Name LIKE '%$search%'","","Name","ASC");

if (!empty($SEARCH)) {
echo"<h1 class='text-center'>"."search result "."$search"."</h1>";

echo'<div class="row">';

	foreach ($SEARCH as $searchs) {



echo"<div class='col-xm-12 col-sm-6 col-md-3 '>";
	

	echo "<div class='tag'>";
	

echo "<div class='price'>"."$".$searchs['Price']."</div>";

            

echo"<img   class='itemimg img img-responsive  col-xm-12 col-sm-6 col-md-3' src='adminstration/upload/avatar/".$searchs['avatar']."' alt='no picture'>";

 
echo "<h3>"."<a href='Items.php?ItemID=".$searchs['Item-ID']."'>".$searchs['Name']."</a>"."</h3>";
  echo"<p>".$searchs['Description']."</p>";
   
  echo"<i class='fa fa-calendar fa-fw'>"."</i>".
   "<span>".$searchs['Add-Date']."</span>";


echo"</div>";
echo"</div>";
	


}
}
else{

echo"<h1 class='text-center'>"."search result "."<strong>$search</strong>"."is not found"."</h1> <br> <br> <br> <br>
";


	echo "<div class='alert alert-danger'>"."NO Item like your search"."</div>";
}

}
else{

	echo "<div class='alert alert-danger'>NOT FOUNT</div>";
}
}else{
echo"<h1 class='text-center'>"."search result is empty "."</h1><br><br><br><br>";

echo "<div class='alert alert-danger'> you are not search</div>";

}



?>
</div>
</div>




<br><br><br><br><br><br><br><br><br>

<div class='footer'>
<div class="container">
	
	<div class="row">


		<div class=" col-xm-4 col-md-4 ">
language English
	</div>

	<div class=" col-sm-4 col-md-4 ">
$ USD-U.S.Dollar   
	</div>

	<div class=" col-sm-4 col-md-4 ">
SUDAN
	</div>





</div>

<br>


  <div class="row">
    <div class="col-md-12 ">

<span class="centeros">Copyright 2020 ,All Rights Reserved &copy</span>
</div>




</div>

<br><br>
<div class="row">
<div class="col-sm-12 col-md-12 ">
<span    class="centeros">
<a href="facebook.com"><i class="fa fa-facebook" style="font-size:26px; color: #3399FF">  </i>&nbsp&nbsp&nbsp&nbsp</a>
<a href="telegram.com"><i class="fa fa-telegram" style="font-size:26px; color: #3399FF">   </i>&nbsp&nbsp&nbsp&nbsp</a>
<a href="twitter.com"><i class="fa fa-twitter" style="font-size:26px; color: #3399FF">     </i>&nbsp&nbsp&nbsp&nbsp</a>
<a href="google.com"><i class="fa fa-google" style="font-size:26px; color: #FF6666">       </i>&nbsp&nbsp&nbsp&nbsp</a>
<a href="youtube.com"><i class="fa fa-youtube" style="font-size:26px; color: #FF6666">       </i>&nbsp&nbsp&nbsp&nbsp</a>
</span>

</div>
</div>
</div>

 <?php


  include $template."footer.inc";

  
ob_end_flush();
  ?>

