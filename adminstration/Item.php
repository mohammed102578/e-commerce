<?php 
ob_start();
session_start();
$pageTitle="Item";
if (isset($_SESSION['username'])) {
	include 'initialize.php';
    
//$do=(isset($_GET['do']))?$_GET['do']:"manage";
if (isset($_GET['do'])) {
	$do=$_GET['do'];
}else{

	$do="manage";
}

//=====================================================================================
//start manage page
if ($do=="manage") {
	$sql="SELECT item.*,categories.Name AS `cat-Name`,users.username FROM item INNER JOIN categories ON categories.ID=item.`Cat-ID` INNER JOIN users ON users.userID=item.`Member-ID` ORDER BY`Item-ID` DESC";


$stmt=$con->prepare($sql);
$stmt->execute();
$Items=$stmt->fetchAll(); 
?>

<h1 class="text-center">Manage Items</h1>

<div class="container">
	<div class="col-md-12 col-sm-12">
	<div class="table-normal">
		
	
		
<table class="table table-bordered">
<tr>
	<thead>
		<td>#ID</td>
		<td>Avatar</td>
<td>Item-Name</td>
<td>Description</td>
<td>Price</td>
<td> Date</td>
<td>category</td>
<td>Member</td>
<td>Control</td>
	</thead>
</tr>
<?php 
foreach ($Items as $Item) {
echo "<tr>";
     echo "<td>".$Item['Item-ID']."</td>";

     echo "<td>";
if (empty($Item['avatar'])) {
	echo "No Image";
}else{
     echo"<img src='upload/avatar/".$Item['avatar']."' alt='no picture' class='imgg'>";
 }



     echo "</td>";
      echo "<td>".$Item['Name']."</td>";
        echo "<td>".$Item['Description']."</td>";
          echo "<td>".$Item['Price']."</td>";
           echo "<td>".$Item['Add-Date']."</td>";
            echo "<td>".$Item['cat-Name']."</td>";
             echo "<td>".$Item['username']."</td>";
             echo "<td> 
             <a href='Item.php?do=Edit&ItemID=".$Item["Item-ID"]."' class='mem btn btn-dark'><i class='fa fa-edit'></i>Edit</a>
<a href='Item.php?do=Delete&ItemID=".$Item["Item-ID"]."'class='mem btn btn-danger confirm' ><i 
class='fa fa-close'></i>Delete</a>"." ";
if ($Item['Approve']==0) {
	echo"<a href='Item.php?do=Approve&ItemID=".$Item["Item-ID"]."' class='mem btn btn-info'><i class='fa fa-check'></i>Approve</a>"; 
}

//button Activate

echo "</td>";
echo"</tr>";
}
?>

</table>
</div>
<a href='Item.php?do=Add' class="mem btn-add btn btn-dark"><i class="fa fa-plus"></i>New Item</a>
	</div>
</div>

<?php
}//end manage page

//=====================================================================================
//start add page

//end insert page

elseif ($do=="Add") {
?>
<h1>Add Item</h1>
<div class="offset-md-4   col-md-4 col-sm-12">
<form class="login" action="<?php echo htmlspecialchars('?do=Insert'); ?>" method="POST" enctype="multipart/form-data">
<div class="div-form-login"><h1>Add Item</h1></div>



			<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-shopping-cart" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Item Name :</h1> </div>
<input class="form-control" type="text" name="Name" placeholder="Enter Item Name" autocomplete="off" required="required">
</div>


			<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-comments-o" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Item Description :</h1> </div>
<input class="form-control" type="text" name="Description" placeholder="Enter Item Description" autocomplete="off"required="required"></div>



			<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-money" aria-hidden='true' style="font-size:36px"></i> <h5  class="online"> Item Price :</h1> </div>
<input class="form-control" type="text" name="price" placeholder="Enter price of the Item" autocomplete="off"required="required"></div>



			<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-font-awesome" aria-hidden='true' style="font-size:36px"></i> <h5  class="online"> Item Country Made :</h1> </div>
<input class="form-control" type="text" name="Country" placeholder="Enter Country Made of the Item" autocomplete="off"required="required"></div>



			<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-arrows-h" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Item Status:</h1> </div>
<!--start status select-->
<select name="Status" class="form-control">
		
<option value="0" class="Status">Status</option>
<option value="1">New</option>
<option value="2">Like-New</option>
<option value="3">Used</option>
<option value="4">Very-old</option>
</select>
<!--end status select-->
<!--start member select-->
<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-user-o" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Item Added By :</h1> </div>
<select name="member" class="form-control comment">
	<option value="0" class="Status">Member</option>
<?php 
 $users=getAllform("*","users","","","username","ASC");
foreach ($users as $user) {
	echo "<option value='".$user['userID']."'>" .$user['username']. "</option>";
}
?>
</select>
</div>
<!--end member select-->
<!--start category select-->
<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-exchange" aria-hidden='true' style="font-size:36px"></i> <h5  class="online"> Item  Category :</h1> </div>
<select  name="category" class="form-control">
	<option  value="0" class="Status">Category</option>
<?php 
$categories_name=getAllform("*","categories","WHERE parent=0","","Name","ASC");
	
foreach ($categories_name as $categorie_name) {
	echo "<option value='".$categorie_name['ID']."'>".$categorie_name['Name'].":-". "</option>";
	$childc=getAllform("*","categories","WHERE parent={$categorie_name['ID']}","","Name","ASC");
foreach ($childc as $childcat) {
	echo "<option value='".$childcat['ID']."'>" ."---------".$childcat['Name']."Child From ".$categorie_name['Name']. "</option>";
}
}
?>
</select>
</div>


			<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-tag" style="font-size:36px"></i> <h5  class="online"> Item Tag :</h1> </div>
<!--end category select-->
<input class="form-control" type="text" name="tag" placeholder="Enter tags and seprate by ," autocomplete="off"required="required">
</div>



			<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-file-image-o" aria-hidden='true' style="font-size:36px"></i> <h5  class="online"> Item profile Picture :</h1> </div>
			<input type="file" class="form-control col-lg-12 col-md-12 col-sm-12"  aria-describedby="emailHelp" name="avatar" required= "required">
			<div>
			<br>

<input class="btn" type="submit" name="submit" value="Add Item">

</form>
</div>
<?php 
      }//end manage page



//=====================================================================================
//start insert page
elseif ($do=="Insert") {

echo "<div class='container'>";

if ($_SERVER['REQUEST_METHOD']=='POST') {
	echo " <h1>Insert Item</h1>";
	//Get varibal from the form of Add
$Name                 =$_POST['Name'];
$Description          =$_POST['Description'];
$Price    		      =$_POST['price'];
$Country              =$_POST['Country'];
$Status   		      =$_POST['Status'];
$member               =$_POST['member'];
$category             =$_POST['category'];
$tag                  =$_POST['tag'];
$avatarName           =$_FILES['avatar']['name'];
$avatarSize           =$_FILES['avatar']['size'];
$avatarTemName        =$_FILES['avatar']['tmp_name'];
$avatartype           =$_FILES['avatar']['type'];
$avatarAllowedExten   =array("jpeg","jpg","gif","png");
$avatarExten          =strtolower(end(explode(".",$avatarName )));

//insert the database with this info
//form ERROR
$formError = array();

if (empty($Name )) {
$formError[]="Name can't Be <strong>empty</strong>";	
}

if (empty($Description )) {
$formError[]="Description can't Be <strong>empty</strong>";	
}

if (empty($Price )) {
$formError[]=" Price can't Be <strong>empty</strong>";	
}


if (empty($Country)) {
$formError[]="Country can't Be <strong>empty</strong>";	
}
if ($Status===0) {
$formError[]="Status can't Be <strong>empty</strong>";	
}
if ($member===0) {
$formError[]="member can't Be <strong>empty</strong>";	
}
if ($category===0) {
$formError[]="category can't Be <strong>empty</strong>";	
}

if (!empty($avatarName) && !in_array($avatarExten,$avatarAllowedExten )) {
	$formError[]=" Avatar Been Not Allowed To  <strong>Upload</strong>";	
if (!is_string($avatarName)) {
	$formError[]=" only allow the write avatar name by  <strong>charactars</strong>";
}
}

if (empty($avatarName)) {
	$formError[]=" Avatar can't to be <strong>Empty</strong>";	

}


if ($avatarSize >4194304) {
	$formError[]=" Avatar can't Larger Than <strong>4MG</strong>";	

}

foreach ($formError as $error) {
	echo "<div class='alert alert-danger'>".$error."</div>"."<br>";
}


//START EMPTY $formError
if (empty($formError)) {
//CHECK ITEM  


$Avatar=rand(0,100000).'_'.$avatarName;
move_uploaded_file($avatarTemName, "upload/avatar//".$Avatar);


$sql="INSERT INTO `Item`(`Name`,`Description`,`Price`,`Add-Date`,`Country-Made`,`Status`,`Cat-ID`,`Member-ID`,`tag`,`avatar`) VALUES (:N,:D,:P,now(),:C,:S,:CA,:M,:tag,:avatar)";
$stmt=$con->prepare($sql); 
$stmt->execute(array(':N'=>$Name,':D'=>$Description,':P'=>$Price,':C'=>$Country ,':S'=>$Status,':CA'=>$category,':M'=>$member,':tag'=>$tag,':avatar'=>$Avatar)); 
//ECHO succes mesage
$theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() ." your data is Inserted"."</strong>"."</div>";


HomeRedirerct($theMsg,'back',6);

}//end of form error
}//end of request equal post
else {

$theMsg= "<div class='alert  alert-danger'>"."<strong>". "you cannot browse this page directory"."</strong>"."</div>";
HomeRedirerct($theMsg,'back',6);
}
echo "</div>";
}//end of insert

//=====================================================================================
//start edit page
elseif ($do=="Edit") {
   
echo "<h1>"."Edit Item"."</h1>";
$ItemID= isset($_GET['ItemID'])&&is_numeric($_GET['ItemID'])?intval($_GET['ItemID']):0;
//select data depent to ID
$sql=" SELECT * FROM `item` WHERE `Item-ID` = ?";
$stmt=$con->prepare($sql);
$stmt->execute(array($ItemID)); 
//FETCH DATA
$Item=$stmt->fetch();
//the row count
$count=$stmt->rowCount();
//IF there ID show form
if ($count>0){?>
	<div class="offset-md-4   col-md-4 col-sm-12">
	<form class="login" action="<?php echo htmlspecialchars('?do=Update'); ?>" method="POST" enctype="multipart/form-data">
<div class="div-form-login"><h1>Edit Item</h1></div>


	
	<input type="hidden" name="id" value="<?php echo $Item['Item-ID'] ?>">


<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-shopping-cart" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Item Name :</h1> </div>	
<input class="form-control" type="text" name="Name" value="<?php echo $Item['Name'] ?>" placeholder="Enter Item Name" autocomplete="off" required="required">
</div>


<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-comments-o" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Item Description :</h1> </div>
<input class="form-control" type="text" name="Description"  value="<?php echo $Item['Description'] ?>"placeholder="Enter Item Description" autocomplete="off"required="required">
</div>


<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-money" aria-hidden='true' style="font-size:36px"></i> <h5  class="online"> Item Price :</h1> </div>
<input class="form-control" type="text" name="price"  value="<?php echo $Item['Price'] ?>"placeholder="Enter price of the Item" autocomplete="off"required="required">
</div>



<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-font-awesome" aria-hidden='true' style="font-size:36px"></i> <h5  class="online"> Item Country Made :</h1> </div>
<input class="form-control" type="text" name="Country" value="<?php echo $Item['Country-Made'] ?>" placeholder="Enter Country Made of the Item" autocomplete="off"required="required">
</div>
<!--start status select-->
<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-arrows-h" aria-hidden='true' style="font-size:36px"></i> <h5  class="online"> Item Status :</h1> </div>
<select name="Status" class="form-control">
		
<option value="0" class="Status">Status</option>
<option value="1"<?php if($Item['Status']==1){echo "selected";}?>> New </option>
<option value="2"<?php if($Item['Status']==2){echo "selected";}?>>Like-New</option>
<option value="3"<?php if($Item['Status']==3){echo "selected";}?>>Used</option>
<option value="4"<?php if($Item['Status']==4){echo "selected";}?>>Very-old</option>
</select>
</div>
<!--end status select-->
<!--start member select-->
<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-user-o" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Item Added By :</h1> </div>
<select name="member" class="form-control">
	<option value="0" class="Status">Member</option>
<?php 
$users=getAllform("*","users","","","username","ASC");
	
foreach ($users as $user) {
	echo "<option value='".$user['userID']."'";


	if($Item['Member-ID']==$user['userID']){echo 'selected';} 

	echo">" .$user['username']. "</option>";
}

?>
</select>
</div>
<!--end member select-->
<!--start category select-->
<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-exchange" aria-hidden='true' style="font-size:36px"></i> <h5  class="online"> Item  Category :</h1> </div>
<select  name="category" class="form-control">
	<option  value="0" class="Status">Category</option>
<?php 
$cate_name=getAllform("*","categories","WHERE parent=0","","Name","ASC");
foreach ($cate_name as $cats_name) {
	echo "<option value='".$cats_name['ID']."'";
	if($Item['Cat-ID']==$cats_name['ID']){echo 'selected';} 

echo">" .$cats_name['Name']. "</option>";





$childc=getAllform("*","categories","WHERE parent={$cats_name['ID']}","","Name","ASC");
foreach ($childc as $childcat) {
	echo "<option value='".$childcat['ID']."'";
	if($Item['Cat-ID']==$childcat['ID']){echo 'selected';} 

	echo ">" ."*".$childcat['Name']."  Child From ".$cats_name['Name']. "</option>";
}//end of for each parent


}//end of foreach all


?>

</select>
</div>
<!--end category select-->


<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-tag" style="font-size:36px"></i> <h5  class="online"> Item Tag :</h1> </div>
<input class="form-control" type="text" name="tag" placeholder="Enter tags and seprate by ," autocomplete="off"required="required" value="<?php echo $Item['tag'] ?>"></div>



<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-file-image-o" aria-hidden='true' style="font-size:36px"></i> <h5  class="online"> Item profile Picture :</h1> </div>
			<input type="file" class="form-control col-lg-12 col-md-12 col-sm-12"  aria-describedby="emailHelp" name="avatar" required= "required">
			<div>
			<br>
<input class="btn" type="submit" name="submit" value="Edit Item">

</form>
</div>
</div>
</div>
<hr>
<!--//==========================================================================================-->
<?PHP

$sql="SELECT comment.*,users.username FROM comment INNER JOIN users ON users.userID=comment.`User_ID` 

WHERE `Item_ID`=?";


$stmt=$con->prepare($sql);
$stmt->execute(array($ItemID));
$Coms=$stmt->fetchAll(); 
if(!empty($Coms)){
 ?>


<h1 class="text-center">Manage [<?php echo $Item['Name'] ?>] Comments</h1>

<div class="container">
	<div class="table-responsive">
		
<table class="table table-bordered" style="color: #fff;">
<tr>
	<thead>
		
<td>Comment</td>
<td>Member-comment</td>
<td>Comment-Date</td>
<td>Control</td>
	</thead>
</tr>
<?php 
foreach ($Coms as $Com) {
echo "<tr>";
      echo "<td>".$Com['Comment']."</td>";
          echo "<td>".$Com['username']."</td>";
           echo "<td>".$Com['Comment_date']."</td>";
             echo "<td> 
            <a href='comment.php?do=Edit&ComID=".$Com["Com_ID"]."' class='mem btn btn-dark'><i class='fa fa-edit'></i>Edit</a>
<a href='comment.php?do=Delete&ComID=".$Com["Com_ID"]."'class='mem btn btn-danger confirm' ><i 
class='fa fa-close'></i>Delete</a>"; 
//button Activate
if ($Com['Status']==0) {
	
	echo "<a href='comment.php?do=Approve&ComID=".$Com["Com_ID"]."'class='activate btn btn-info ' ><i class='fa fa-check'></i>Approve</a>";
}
//button Activate

echo "</td>";
echo"</tr>";
}

?>

</table>

	



<!--//=========================================================================================-->
<?php
}
} 
}
//=====================================================================================
//start update page
elseif ($do=="Update") {

	echo " <h1>Update Items</h1>";
echo "<div class='container'>";
if ($_SERVER['REQUEST_METHOD']=='POST') {
	//Get varibal from the form of edit
$ID                   =$_POST['id'];
$Name                 =$_POST['Name'];
$Description          =$_POST['Description'];
$Price                =$_POST['price'];
$Country              =$_POST['Country'];
$Status               =$_POST['Status'];
$member               =$_POST['member'];
$category             =$_POST['category'];
$tag                  =$_POST['tag'];
$avatarName           =$_FILES['avatar']['name'];
$avatarSize           =$_FILES['avatar']['size'];
$avatarTemName        =$_FILES['avatar']['tmp_name'];
$avatartype           =$_FILES['avatar']['type'];
$avatarAllowedExten   =array("jpeg","jpg","gif","png");
$avatarExten          =strtolower(end(explode(".",$avatarName )));

//update the database with this info
//password trik

//form ERROR
$formError = array();

if (empty($Name )) {
$formError[]="Item name can't Be <strong>empty</strong>";	
}



if (empty($Description )) {
$formError[]=" Item Description can't Be <strong>empty</strong>";	
}


if (empty( $Price)) {
$formError[]="Item  price can't Be <strong>empty</strong>";	
}
if (empty($Country )) {
$formError[]="Item Country can't Be <strong>empty</strong>";	
}
if ($Status==0) {
$formError[]="Item  Status  can't Be <strong>empty</strong>";	
}
if ($member==0) {
$formError[]="Item Member can't Be <strong>empty</strong>";	
}
if ($category==0) {
$formError[]="Item  Categories can't Be <strong>empty</strong>";	
}

if (!empty($avatarName) && !in_array($avatarExten,$avatarAllowedExten )) {
	$formError[]=" Avatar Been Not Allowed To  <strong>Upload</strong>";	
if (!is_string($avatarName)) {
	$formError[]=" only allow the write avatar name by  <strong>charactars</strong>";
}
}

if (empty($avatarName)) {
	$formError[]=" Avatar can't to be <strong>Empty</strong>";	

}


if ($avatarSize >4194304) {
	$formError[]=" Avatar can't Larger Than <strong>4MG</strong>";	

}

foreach ($formError as $error) {
	echo "<div class='alert alert-danger'>".$error."</div>"."<br>";

$theMsg= "<div class='alert  alert-success'>"."<strong>".$error."</strong>"."</div>";

HomeRedirerct($error,'back',6);
}

if (empty($formError)) {

$Avatar=rand(0,100000).'_'.$avatarName;
move_uploaded_file($avatarTemName, "upload/avatar//".$Avatar);



$sql="UPDATE `item` SET `Name`= ?, `Description`= ?,`Price`= ?,`Country-Made`=?,`Status`=?,`Member-ID`= ?,`Cat-ID`=? ,`tag`=? , `avatar`= ? WHERE `Item-ID`= ? ";
$stmt=$con->prepare($sql);
$stmt->execute(array( $Name,$Description,$Price,$Country,$Status,$member,$category,$tag,$Avatar,$ID)); 
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
}


//=====================================================================================
//start manage page
elseif ($do=="Delete") {
echo "<h1>Delete Page </h1>";
	//this is userid the http
$ItemID= isset($_GET['ItemID'])&&is_numeric($_GET['ItemID'])?intval($_GET['ItemID']):0;
//select data depent to ID
//thi is function checkitem
$sql="SELECT `Item-ID` FROM `item` WHERE `Item-ID`= ?";
$statement=$con->prepare($sql);
$statement->execute(array($ItemID));
$count=$statement->rowcount();
//IF there ID show form*/
if ($count>0) {
$sql="DELETE FROM `item` WHERE `Item-ID` =:itemID ";
$stmt=$con->prepare($sql);
$stmt->bindparam(":itemID",$ItemID);
$stmt->execute();

$theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() .'  your data is Deleted'."<strong>"."</div>";

HomeRedirerct($theMsg,6);
}else{

	$theMsg="<div class='alert  alert-danger'>"."<strong>".' this id not found  '."<strong>"."</div>";
	HomeRedirerct($theMsg,'home',6);
}
}//end Delete page


//=====================================================================================
//start Approve page
elseif ($do=="Approve") {
echo "<h1>Aprrove Page </h1>";
$ItemID=isset($_GET['ItemID'])&&is_numeric($_GET['ItemID'])?intval($_GET['ItemID']):0;
$check=checkitemid($ItemID);
if ($check==1) {

$sql="UPDATE `item` SET `Approve`=? WHERE `Item-ID`=? ";
$stmt=$con->prepare($sql);
$stmt->execute(array(1,$ItemID));

$theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() .'  your data is Approved'."<strong>"."</div>";

HomeRedirerct($theMsg,6);
}else{

	$theMsg="<div class='alert  alert-danger'>"."<strong>".' this id not found  '."<strong>"."</div>";
	HomeRedirerct($theMsg,'home',6);
}



}//end Approve page
}//end of the if session


else{

echo "you can't browse this page directory";
header('location:index.php');
exit();
include $template."footer.inc";
}//end of the else session
?>