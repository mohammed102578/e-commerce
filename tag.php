
<?php
ob_start();
session_start();
$pageTitle="category";
 include 'initialize1.php';

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



 <?php
ob_end_flush();
  include $template."footer.inc"; ?>
