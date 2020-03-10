<?php
ob_start();
session_start();
$pageTitle="category";
 include 'initialize1.php';

?>

<div class="container">
	<h1 class="text-center">Show category</h1>
<div class="row">
<?php
$CatID=isset($_GET['depID'])&&is_numeric($_GET['depID'])?intval($_GET['depID']):0;

$items=getAllform("*","item","WHERE `Cat-ID`=$CatID","AND Approve=1","`Item-ID`");

if (!empty($items)) {
	foreach ($items as $item) {
	

echo"<div class='col-xm-12 col-sm-6 col-md-3 '>";

	echo "<div class='tag'>";
	

echo "<div class='price'>"."$".$item['Price']."</div>";

echo"<img   class='itemimg img img-responsive  col-xm-12 col-sm-6 col-md-3' src='adminstration/upload/avatar/".$item['avatar']."' alt='no picture'>";

 
echo "<h3>"."<a href='Items.php?ItemID=".$item['Item-ID']."'>".$item['Name']."</a>"."</h3>";
  echo"<p>".$item['Description']."</p>";
   
  echo"<i class='fa fa-calendar fa-fw'>"."</i>".
   "<span>".$item['Add-Date']."</span>";


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



 <?php
ob_end_flush();
  include $template."footer.inc"; ?>
