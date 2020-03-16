<?php
ob_start();
session_start();
$pageTitle="index";
include 'initialize1.php';


echo"<h1>","Wellcom In The Sudshop","</h1>";
include "slid.inc";
$getitem=getAllform("*","item","where Approve=1","","`Item-ID`");
echo "<div class='container'>";

echo "<div class='row'>";
foreach ($getitem as$getitems) {


echo"<div class='col-xm-12 col-sm-6 col-md-3 '>";
	

	echo "<div class='tag'>";
	

echo "<div class='price'>"."$".$getitems['Price']."</div>";

            if($getitems['Approve']==0){
              echo "<span class='approx'>"."Not Approved"."</span>";
            }

echo"<img   class='itemimg img img-responsive  col-xm-12 col-sm-6 col-md-3' src='adminstration/upload/avatar/".$getitems['avatar']."' alt='no picture'>";

 
echo "<h3>"."<a href='Items.php?ItemID=".$getitems['Item-ID']."'>".$getitems['Name']."</a>"."</h3>";
  echo"<p>".$getitems['Description']."</p>";
   
  echo"<i class='fa fa-calendar fa-fw'>"."</i>".
   "<span>".$getitems['Add-Date']."</span>";


echo"</div>";
echo"</div>";
	

}

echo"</div>";
echo"</div>";


?>

<br><br><br><br><br><br><br><br><br>

<div class='footer'>
<div class="container">
	
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

<?php include $template."footer.inc"; 
ob_end_flush();
?>