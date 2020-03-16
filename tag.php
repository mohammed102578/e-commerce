
<?php
ob_start();
session_start();
$pageTitle="category";
 include 'initialize1.php';
include "slid.inc";
?>



<div class="container">
	

<?php
if(isset($_GET['Name'])&&is_string($_GET['Name'])){
$tagname=strval($_GET['Name']);
}else{
$tagname="NO FOUND THIS TAG";
}
echo"<h1 class='text-center'>"."Tag name is "."$tagname"."</h1>";
echo'<div class="row">';
$tags=getAllform("*","item","WHERE `tag` like'%$tagname%'","AND Approve=1","`Item-ID`");

if (!empty($tags)) {
	foreach ($tags as $tag) {



echo"<div class='col-xm-12 col-sm-6 col-md-3 '>";
	

	echo "<div class='tag'>";
	

echo "<div class='price'>"."$".$tag['Price']."</div>";

            

echo"<img   class='itemimg img img-responsive  col-xm-12 col-sm-6 col-md-3' src='adminstration/upload/avatar/".$tag['avatar']."' alt='no picture'>";

 
echo "<h3>"."<a href='Items.php?ItemID=".$tag['Item-ID']."'>".$tag['Name']."</a>"."</h3>";
  echo"<p>".$tag['Description']."</p>";
   
  echo"<i class='fa fa-calendar fa-fw'>"."</i>".
   "<span>".$tag['Add-Date']."</span>";


echo"</div>";
echo"</div>";
	


}
}
else{
	echo "<div class='alert alert-danger'>"."NO ITEM TO SHOW"."</div>";
}



?>
</div>
</div>

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

 <?php
ob_end_flush();
  include $template."footer.inc"; ?>
