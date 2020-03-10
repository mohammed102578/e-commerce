<?php 
ob_start();

session_start();
$pageTitle='categoreis';
if ($_SESSION['username']) {
include 'initialize.php';
//if abbrevation
$do= isset($_GET['do'])?$_GET['do']:"manage";
//the start manage page
if ($do=='manage') {
$sort="ASC";

$sortArray=array('ASC','DESC');
if (isset($_GET['sort'])&&in_array($_GET['sort'], $sortArray)) {
	
$sort=$_GET['sort'];

}
 $fetch= getAllform("*","categories","WHERE `parent` = 0","","`Ordering`","$sort");

	?>



	<h1 class="text-center">Manage Categories</h1>
<div class="container">
	 
  <div class="row">
    
<div class="col-sm-12 col-md-12 col-lg-12 ">

     <div class="cardca1 card">
     <div class="card-header"><i class='fa fa-edit'></i>Manage Categories

     	<a href='categoreis.php?do=Add' class=' btn btn-info btn-sm membt'><i class='fa fa-plus'></i>Add</a>
<span class="pull-right"> <i class='fa fa-sort'></i> Order By :[

<a href="?sort=ASC" class="<?php if($sort=='ASC'){echo 'active';}?>">ASC</a>
/
<a href="?sort=DESC" class="<?php if($sort=='DESC'){echo 'active';}?>">DESC</a>
]


     </span></div>
   <div>
   	<?php
    

foreach ($fetch as $fetching) {
	echo "<ol class='list-unstyled'>";
  echo"<li>"."<a href='categoreis.php?do=Edit&&CatID=".$fetching['ID']."' class='acat'>"."<strong class='strong'>".$fetching['Name'].":-"."</strong>"."</a>"."</br>";


  echo "<div class='full-view'>";
   echo "/*".$fetching['description']."*/"."</br>";

   echo "<a href='categoreis.php?do=Edit&&CatID=".$fetching['ID']."' class=' btn btn-info btn-sm pull-right membt'><i class='fa fa-edit'></i>Edit</a>";


echo "<a href='categoreis.php?do=Delete&&CatID=".$fetching['ID']."' class=' btn btn-danger btn-sm pull-right confirm membt'><i 
class='fa fa-close'></i>Delete</a>";

 echo "</br>"."</br>";
  if ($fetching['Visibilty']==1) {
  	echo "<span class='visib'>"."<i class='fa fa-eye'>"."</i>"."Hidden"."</span>";}

  if ($fetching['Allow-Comments']==1) {
  	echo "<span class='comm'>"."<i class='fa fa-close'>"."</i>"."can't Comments"."</span>";
  }


  if ($fetching['Allow-Advs']==1) {
  	echo "<span class='adv'>"."<i class='fa fa-close'>"."</i>"."can't show advertisment "."</span>";
  }
  echo "</br>";



echo "</div>";

  echo "</li>";
  echo "</ol>";
  $ID=$fetching['ID'];
  $catchild=getAllform("*","categories","WHERE parent= $ID","","ID","ASC");
  if (!empty($catchild)) {
  	echo "<h4 class='child'>"."Child Categories :-"."</h4>";
  	foreach ($catchild as $child) {
  	
  	echo "<ul class='ulchild'>";
  	echo "<li class='child-link'>"."---"."<a href='categoreis.php?do=Edit&&CatID=".$child['ID']."' class='acat'>".$child['Name']."</a>";

echo "<a href='categoreis.php?do=Delete&&CatID=".$child['ID']."' class='show-Delete confirm'>Delete</a>";

  	echo "</li>";
    echo "</ul>";
  }
  }
  
  echo "<hr>";
}




     ?>
   </div> 
</div>
</div>
</div>
</div>

<?php 
}//the end manage page

//the start add page
elseif ($do=='Add') {

	?>
	<h1>Add Categories</h1>
			<div class="offset-md-4   col-md-4 col-sm-12">
<form class="login" action="<?php echo htmlspecialchars('?do=Insert'); ?>" method="POST" >
<div class="div-form-login"><h1>Add Categorie</h1></div>



<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-shopping-cart" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Categorie Name :</h1> </div>
<input class="form-control" type="text" name="name" placeholder="Enter Name of Categoreis" required="required">
</div>


<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-comments-o" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Categorie Description :</h1> </div>
<input class="form-control" type="text" name="description" placeholder="Enter your description" required="required">
</div>




<div class="form-group">
			<div class="text-left"> <i class="icon icon fa fa-exchange" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Categorie Ordering :</h1> </div>
<input class="form-control" type="text" name="order" placeholder="Enter Ordering of the Categories" 
required="required">
</div>


<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-arrows-h" aria-hidden="true" style="font-size:36px"></i> <h5  class="online">Categorie  Main OR Branch:</h1> </div>
<select class="form-control" name="parent">
	<option class="Status">parent..?</option>
	<option value="0">none parent</option>
	<?php
$getcat=getAllform("*","categories","WHERE `parent` =0","","ID","ASC");
foreach ($getcat as $getcats ) {
	echo "<option value='".$getcats['ID']."'>";
	echo $getcats['Name'];
	echo "</option>";

}



echo"</select>";
echo"</div>";

?>

			<br>
<div class="online">
	<div class="dis">
	<h5 class="online">visibility: /</h5>
	<div><input id='visi' type="radio" name="visibility" value='0 ' checked>
	<label for='visi'>Yes</label></div>
	<div><input id='visi' type="radio" name="visibility" value='1'>
	<label for='visi'>No</label></div>

</div>



	<div class="dis">
	<h5 class="online">Allo Comments: /</h5>
	<div><input id='com' type="radio" name="Comments" value='0 ' checked>
	<label for='com'>Yes</label></div>
	<div><input id="com" type="radio" name="Comments" value='1'>
	<label for="com">No</label></div>

</div>


	<div class="dis">
	<h5 class="online">Allow Ads:</h5>
	<div><input id='advs' type="radio" name="advs" value='0 ' checked>
	<label for='advs'>Yes</label></div>
	<div><input id='advs' type="radio" name="advs" value='1'>
	<label for='advs'>No</label></div>
</div>

<input class="btn btn-primary" type="submit" name="submit" value="Add Categories">

</div>
</div>

</form>
</div>

<?php

}//the end  add page

//=================================================================================
//the start  insert page
elseif ($do=='Insert') {
	

if ($_SERVER['REQUEST_METHOD']=='POST') {
	echo " <h1>Insert Categories</h1>";
	//Get varibal from the form of Add
	
$Name                 =$_POST['name'];
$Description          =$_POST['description'];
$parent               =$_POST['parent'];
$Ordering             =$_POST['order'];
$Visibility           =$_POST['visibility'];
$Comments             =$_POST['Comments'];
$advs                 =$_POST['advs'];
          
//insert the database with this info

	$formError = array();
if (empty($Name )) {
$formError[]="Categories name can't Be <strong>empty</strong>";	
}



if (empty($Description )) {
$formError[]=" Categories Description can't Be <strong>empty</strong>";	
}


if (empty($Ordering )) {
$formError[]="Categories Ordering can't Be <strong>empty</strong>";	
}




foreach ($formError as $error) {
	echo "<div class='alert alert-danger'>".$error."</div>"."<br>";
}

if (empty($formError)) {

if (!empty($Name)) {

//CHECK ITEM
$checkItem=checkItem('Name','categories',$Name);
if ($checkItem==1) {
	$theMsg=" <div class='alert alert-danger'>sory this user name is Exist</div>";

HomeRedirerct($theMsg,'back',6);

}else{

$sql="INSERT INTO `categories`(`Name`, `description`,`parent`,`Ordering`, `Visibilty`,`Allow-Comments`,`Allow-Advs`) VALUES (:name,:des,:parent,:orde,:vis,:allco,:allad)";
$stmt=$con->prepare($sql);
$stmt->execute(array(':name'=>$Name,':des'=>$Description,':parent'=>$parent,':orde'=>$Ordering,':vis'=>$Visibility
,':allco'=>$Comments,':allad'=>$advs )); 

//ECHO succes mesage
$theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() ." your data is Inserted"."</strong>"."</div>";


HomeRedirerct($theMsg,'back',6);
}//end of if check item

}//end of if check input is empty
}//end of if form error

//start elseif of check input is empty
else{
$theMsg= "<div class='alert  alert-danger'>"."<strong>"." you must be write name of categoreis"." </br>"."and check Ordering you must be integer"."</strong>"."</div>";


HomeRedirerct($theMsg,'back',6);

}//end of else if check input is empty




}//end of request equal post
else {

$theMsg= "<div class='alert  alert-danger'>"."<strong>". "you cannot browse this page directory"."</strong>"."</div>";
HomeRedirerct($theMsg,'back',6);
}	

}//the end insert page


//======================================================================
//the start   edit page
elseif ($do=='Edit') {
		//if abbrevation
$catID= isset($_GET['CatID'])&&is_numeric($_GET['CatID'])?intval($_GET['CatID']):0;
//select data depent to ID
$sql=" SELECT * FROM  `categories` WHERE ID=? ";
$stmt=$con->prepare($sql);
$stmt->execute(array($catID)); 
//FETCH DATA
$fetch=$stmt->fetch();
//the row count
$count=$stmt->rowCount();
//IF there ID show form
if ($count>0) { ?>


<h1>Edit Categories</h1>
<div class="offset-md-4   col-md-4 col-sm-12">
		<form class="login" action="<?php echo htmlspecialchars('?do=Update'); ?>" method="POST" >
<div class="div-form-login"><h1>Edit Categorie</h1></div>


			<input type="hidden" name="CATID" value="<?php echo $catID ?>">
		
<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-shopping-cart" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Categorie Name :</h1> </div>

<input class="form-control" type="text" name="name" placeholder="Enter Name of Categoreis" required="required" value="<?php echo $fetch['Name']?>">
</div>


<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-comments-o" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Categorie Description :</h1> </div>
<input class="form-control" type="text" name="description" placeholder="Enter your description" required="required" value="<?php echo $fetch['description']?>">
</div>



<div class="form-group">
			<div class="text-left"> <i class="icon icon fa fa-exchange" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Categorie Ordering :</h1> </div>
<input class="form-control" type="text" name="order" placeholder="Enter Ordering of the Categories" value="<?php echo $fetch['Ordering']?>" required="required">

</div>
<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-arrows-h" aria-hidden="true" style="font-size:36px"></i> <h5  class="online">Categorie  Main OR Branch:</h1> </div>
<select class="form-control" name="parent">
	<option class="Status" value="-1">parent..?</option>
	<option value="0" selected>none parent</option>
	<?php
$getca=getAllform("*","categories","WHERE `parent` =0","","ID","ASC");
foreach ($getca as $getc ) {
	echo "<option value='".$getc['ID']."'";


	if($fetch['parent']==$getc['ID']){echo 'Selected';}

	 echo ">";
	echo $getc['Name'];
	echo "</option>";

}


	?>
</select>

</div>





			<br>


<div class="online">
	<div class="dis">
	<h5 class="online">visibility: /</h5>
	<div><input id='visi' type="radio" name="visibility" value='0'<?php if($fetch['Visibilty']==0)echo'checked' ?> >
	<label for='visi'>Yes</label></div>
	<div><input id='visi' type="radio" name="visibility" value='1'<?php if($fetch['Visibilty']==1)echo'checked' ?>>
	<label for='visi'>No</label></div>

</div>



	<div class="dis">
	<h5 class="online">Allo Comments: /</h5>
	<div><input id='com' type="radio" name="Comments"  value='0'<?php if($fetch['Allow-Comments']==0)echo'checked' ?>>
	<label for='com'>Yes</label></div>
	<div><input id="com" type="radio" name="Comments" value='1'<?php if($fetch['Allow-Comments']==1)echo'checked' ?>>
	<label for="com">No</label></div>

</div>


	<div class="dis">
	<h5 class="online">Allow Ads:</h5>
	<div><input id='advs' type="radio" name="advs" value='0'<?php if($fetch['Allow-Advs']==0)echo'
checked' ?>>
	<label for='advs'>Yes</label></div>
	<div><input id='advs' type="radio" name="advs" value='1'<?php if($fetch['Allow-Advs']==1)echo'checked' ?>>
	<label for='advs'>No</label></div>
</div>
</div>
</div>


<input class="btn btn-primary" type="submit" name="submit" value="Edit Categories">



</form>
</div>

	<?php
}//end acount

// IF IS there not id excute this
else{

	$theMsg="<div class='alert  alert-danger'>"."<strong>".'please Enter correct ID '."<strong>"."</div>";
	HomeRedirerct($theMsg,'home',6);

}
}//the end  edit page

//============================================================================================

//the start update page
elseif ($do=='Update') {



	echo " <h1>Update Categories</h1>";
echo "<div class='container'>";
if ($_SERVER['REQUEST_METHOD']=='POST') {
	//Get varibal from the form of edit
$catID                =htmlspecialchars($_POST['CATID']);	
$Name                 =htmlspecialchars($_POST['name']);
$Description          =htmlspecialchars($_POST['description']);
$parents              =htmlspecialchars($_POST['parent']);
$Ordering             =htmlspecialchars($_POST['order']);
$Visibility           =htmlspecialchars($_POST['visibility']);
$Comments             =htmlspecialchars($_POST['Comments']);
$advs                 =htmlspecialchars($_POST['advs']);

//update the database with this info
//password trik

//form ERROR
$formError = array();
if (empty($Name )) {
$formError[]="Categories name can't Be <strong>empty</strong>";	
}



if (empty($Description )) {
$formError[]=" Categories Description can't Be <strong>empty</strong>";	
}


if (empty($Ordering )) {
$formError[]="Categories Ordering can't Be <strong>empty</strong>";	
}


foreach ($formError as $error) {
	echo "<div class='alert alert-danger'>".$error."</div>"."<br>";
}

if (empty($formError)) {


$sql="UPDATE `categories` SET `Name`= ?, `description`= ?,`Ordering`= ?,`parent`=?,`Visibilty`=?,`Allow-Comments`=?,`Allow-Advs`= ? WHERE `ID`= ? ";
$stmt=$con->prepare($sql);
$stmt->execute(array($Name ,$Description ,$Ordering ,$parents ,$Visibility ,$Comments ,$advs ,$catID)); 
//ECHO succes mesage
$theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() ." your data is updated"."</strong>"."</div>";


HomeRedirerct($theMsg,'back',6);

}//end if (empty($formError))
}//end $_SERVER['REQUEST_METHOD']=='POST'
else {


$theMsg= "<div class='alert  alert-danger'>"."<strong>". "you cannot browse this page directory"."</strong>"."</div>";
HomeRedirerct($theMsg,'home',6);

}

echo "</div>";


}//the end update page


//==============================================================
//the start delete page
elseif ($do=='Delete') {
	

echo "<h1>Delete Page </h1>";
	//this is item id the http
$catID= isset($_GET['CatID'])&&is_numeric($_GET['CatID'])?intval($_GET['CatID']):0;
//select data depent to ID
//thi is function checkitem
$checkItem=checkItem('ID','categories',$catID);

//IF there ID show form
if ($checkItem>0) {
$sql="DELETE FROM `categories` WHERE ID =:catID";
$stmt=$con->prepare($sql);
$stmt->bindparam(":catID",$catID);
$stmt->execute();

$theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() .'  your data is Deleted'."<strong>"."</div>";

HomeRedirerct($theMsg,6);
}else{

	$theMsg="<div class='alert  alert-danger'>"."<strong>".' this id not found  '."<strong>"."</div>";
	HomeRedirerct($theMsg,'home',6);
}
}//end else if Delete


}//end of the if $session



// is not found sesstion execute this

else{


header('location: index.php');	
exit();
include $template."footer.inc";
}
// is not found sesstion

ob_end_flush(); 
