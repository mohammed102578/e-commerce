<?php

//==================================
//==manage members page
//==you can Add Edit Delete Insert from this page
//================================== 
ob_start();

session_start();

 $pageTitle="members";
if (isset($_SESSION['username'])) {
 include 'initialize.php';
	
		 //define do it's represent Get and divied pages depent him 
 //$do= isset($_GET['do'])?$_GET['do']:'manage';
 


if(isset($_GET['do'])){
	
	$do=$_GET['do'];
}else{
 $do="manage";
}



 //========================================================================   
 //=================start manage page
 //=========================================================================   
if($do=='manage'){
//this condition to fetch pending members

if (isset($_GET['page'])&&$_GET['page']=='pending') {
	$query='AND regStatus = 0';
}else{
	$query='';
}
$rows=getAllform("*","`users`","WHERE GroupID != 1","$query","userID","DESC");

 ?>

<h1 class="text-center">Manage Members</h1>

<div class="container">
	<div class="col-md-12 col-sm-12">
	<div class="table-normal">
		
<table class="table table-bordered">
<tr>
	<thead>
<td>#ID</td>
<td>picture</td>
<td>user-name</td>
<td>Email</td>
<td>Full-name</td>
<td>Register Date</td>
<td>Control</td>
	</thead>
</tr>
<?php 

foreach ($rows as $row) {
echo "<tr>";
    echo "<td>".$row['userID']."</td>";
     echo "<td>";
if (empty($row['avatar'])) {
	echo "No Image";
}else{
     echo"<img src='upload/avatar/".$row['avatar']."' alt='no picture' class='imgg'>";
 }
     echo"</td>";
      echo "<td>".$row['username']."</td>";
        echo "<td>".$row['email']."</td>";
          echo "<td>".$row['fullname']."</td>";
           echo "<td>".$row['Date']."</td>";
             echo "<td> 
             <a href='members.php?do=Edit&userID=".$row["userID"]."' class='mem btn btn-dark'><i class='fa fa-edit'></i>Edit</a>
<a href='members.php?do=Delete&userID=".$row["userID"]."'class='mem btn btn-danger confirm' ><i 
class='fa fa-close'></i>Delete</a>"; 
//button Activate
if ($row['regStatus']==0) {
	
	echo "<a href='members.php?do=Activate&userID=".$row["userID"]."'class='activate btn btn-info ' ><i class='fa fa-check'></i>Activate</a>";
}

echo "</td>";
echo"</tr>";
}

?>

</table>
</div>
<a href='members.php?do=Add' class="mem btn-add btn btn-dark"><i class="fa fa-plus"></i>New Member</a>
	
</div>


</div>
<?php

 }
//==========================================================================
//==================start Add page
//==========================================================================
 elseif ($do=='Add') {

echo " <h1>Add Members</h1>";

 	?>
	<div class="offset-md-4   col-md-4 col-sm-12">

<form class="login " action="<?php echo htmlspecialchars('?do=Insert'); ?>" method="POST" enctype="multipart/form-data">
			
			
			<div class="div-form-login"><h1>Add Member</h1></div>
			<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-user-circle-o" style="font-size:36px"></i> <h5  class="online"> User Name :</h1> </div>
			<input type="text" class="Member form-control " name="username" placeholder="username" autocomplete="off"  required= "required">
			</div> 


			<div class="form-group">
			<div class="text-left">  <i class="fa fa-key" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Password:</h1></div>
			<input type="password" class="password  Member form-control" placeholder="please Enter password" autocomplete="password" name="password" required= "required">
			<i class="showpass fa fa-eye fa-2x">	</i>
			</div>



			<div class="form-group">
			<div class="text-left"> <i class="fa fa-envelope" aria-hidden="true"style="font-size:36px"></i> <h5  class="online"> Email:</h1></div>
			<input type="email" class="Member form-control"  aria-describedby="emailHelp" placeholder="Enter email" name="email" required= "required">
			</div>

			<div class="form-group">
			<div class="text-left"> <i class="fa fa-user-plus" aria-hidden="true"style="font-size:36px"></i> <h5  class="online"> Full Name:</h1></div>
			<input type="text" class="Member form-control"placeholder="please Enter fullname" name="fullname" required= "required">
			</div>
            

            <div class="form-group">
			<div class="text-left"><i class="fa fa-file" aria-hidden="true"style="font-size:36px"></i> <h5  class="online"> Choose profile :</h1></div>
			<input type="file" class="form-control col-lg-6 col-md-6 col-sm-10"  aria-describedby="emailHelp" name="avatar" required= "required">
			</div>


<div class="text-left"><i class="fa fa-user-plus" aria-hidden="true"style="font-size:36px"></i><h5 class="online">type of member:</h5></div>
	<div class="text-left"><input id="vis" type="radio" name="memb" value='1'>
	<label for='visi'><h6>admin</h6></label></div>
	<div class="text-left"><input id="visi" type="radio" name="memb" value='0' checked="">
	<label for='vis'><h6>user</h6></label></div>


	<button type="submit" class="btn btn-primary">Add Member</button>

</form>

</div>

<?php

}

//==========================================================================
//==================start Insert page
//==========================================================================
elseif ($do=='Insert') {
echo "<div class='container'>";

if ($_SERVER['REQUEST_METHOD']=='POST') {
	echo " <h1>Insert Members</h1>";
	//Get varibal from the form of Add
$user                 =$_POST['username'];
$pass                 =$_POST['password'];
$email                =$_POST['email'];
$fullName             =$_POST['fullname'];
$typememb             =$_POST['memb'];
$avatarName           =$_FILES['avatar']['name'];
$avatarSize           =$_FILES['avatar']['size'];
$avatarTemName        =$_FILES['avatar']['tmp_name'];
$avatartype           =$_FILES['avatar']['type'];
$avatarAllowedExten   =array("jpeg","jpg","gif","png");
$avatarExten          =strtolower(end(explode(".",$avatarName )));



$hashpassword=sha1($_POST['password']);
//insert the database with this info
//form ERROR
$formError = array();

if (empty($user )) {
$formError[]="user name can't Be <strong>empty</strong>";	
}

if (empty($pass )) {
$formError[]="password can't Be <strong>empty</strong>";	
}

if (empty($email )) {
$formError[]=" Email can't Be <strong>empty</strong>";	
}


if (empty($fullName )) {
$formError[]="fullname can't Be <strong>empty</strong>";	
}


if (strlen($user )<3) {
$formError[]= "user can't less than three <strong> characters </strong>";	
}

if (strlen($user )>20) {
$formError[]=" user can't be greater than towenty <strong>characters</strong>";	
}

if (!empty($avatarName) && !in_array($avatarExten,$avatarAllowedExten )) {
	$formError[]=" Avatar Been Not Allowed To  <strong>Upload</strong>";	

}

if (empty($avatarName)) {
	$formError[]=" Avatar can't to be <strong>Empty</strong>";	

}


if ($avatarSize >4194304) {
	$formError[]=" Avatar can't Larger Than <strong>4MG</strong>";	

}
foreach ($formError as $error) {
	$theMsg= "<div class='alert alert-danger'>".$error."</div>"."<br>";
	HomeRedirerct($theMsg,'back',2);
}


//START EMPTY $formError
if (empty($formError)) {

$Avatar=rand(0,100000).'_'.$avatarName;
move_uploaded_file($avatarTemName, "upload/avatar//".$Avatar);




//CHECK ITEM
$checkItem=checkItem('username','users',$user);
if ($checkItem==1) {
	$theMsg=" <div class='alert alert-danger'>sory this user name is Exist</div>";

HomeRedirerct($theMsg,'back',2);

}else{

$sql="INSERT INTO `users`(`username`, `password`, `email`, `fullname`,`GroupID`,`regStatus`,`Date`,`avatar`) VALUES (:username,:pass,:email,:fullname,:GroupID,1,now(),:avatar)";
$stmt=$con->prepare($sql);
$stmt->execute(array(':username'=>$user,':pass'=>$hashpassword,':email'=>$email,':fullname'=>$fullName ,':GroupID'=>$typememb,':avatar'=>$Avatar)); 

//ECHO succes mesage
$theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() ." your data is Inserted"."</strong>"."</div>";


HomeRedirerct($theMsg,'back',2);
}//end of if check item
}//end of form error
}//end of request equal post
else {

$theMsg= "<div class='alert  alert-danger'>"."<strong>". "you cannot browse this page directory"."</strong>"."</div>";
HomeRedirerct($theMsg,'back',2);
}

echo "</div>";

}//end of insert


//==========================================================================
//==================start Edit page
//==========================================================================

elseif ($do=='Edit') {
	//if abbrevation
$userID=isset($_GET['userID'])&&is_numeric($_GET['userID']) ?intval($_GET['userID']):0;

//select data depent to ID
$sql=" SELECT * FROM users WHERE userID=? LIMIT 1";
$stmt=$con->prepare($sql);
$stmt->execute(array($userID)); 
//FETCH DATA
$row=$stmt->fetch();
//the row count
$count=$stmt->rowCount();
//IF there ID show form
if ($count>0) { ?>
<div class="offset-md-4   col-md-4 col-sm-12">
			<form class="login"  action="<?php echo htmlspecialchars('?do=Update'); ?>" method="POST" enctype="multipart/form-data">
			<div class="div-form-login"><h1>Edit Member</h1></div>

			<input type="hidden" name="userID" value="<?php echo $userID?>">
			<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-user-circle-o" style="font-size:36px"></i> <h5  class="online"> User Name :</h1> </div>
			<input type="text" class="Member form-control " name="username" placeholder="username" autocomplete="off" value="<?php echo $row["username"]?>" required= "required">
			</div>


			<div class="form-group">
			<div class="text-left">  <i class="fa fa-key" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Password:</h1></div>
			<input type="hidden" name="oldpassword" value="<?php echo $row['password']?>" >
			<input type="password" class="Member form-control" placeholder="Leave Blank If you Dont Change password" autocomplete="new-password" name="newpassord">
			</div>



			<div class="form-group">
			<div class="text-left"> <i class="fa fa-envelope" aria-hidden="true"style="font-size:36px"></i> <h5  class="online"> Email:</h1></div>
			<input type="email" class="Member form-control"  aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?php echo $row["email"]?>" required= "required">
			</div>

			<div class="form-group">
			<div class="text-left"><i class="fa fa-user-plus" aria-hidden="true"style="font-size:36px"></i> <h5  class="online"> Full Name :</h1></div>
			<input type="text" class="Member form-control"placeholder="fullname" name="fullname" value= "<?php echo $row["fullname"]?>" required= "required">
			</div>
             
              

             <div class="form-group">
			<div class="text-left"><i class="fa fa-file" aria-hidden="true"style="font-size:36px"></i> <h5  class="online"> Choose profile :</h1></div>
             <input type="file" class="form-control "  aria-describedby="emailHelp" name="avatar" required= "required">
             </div>
           
            <div class="form-group">

            <div class="text-left"><i class="fa fa-user-plus" aria-hidden="true"style="font-size:36px"></i><h5 class="online">type of member:</h5></div>
	<div class="text-left"><input id="vis" type="radio" name="memb" value='1'<?php  if($row["GroupID"]==1){
		echo "checked";}?>>
	<label for='visi'><h6>admin</h6></label></div>
	<div class="text-left"><input id="visi" type="radio" name="memb" value='0'<?php  if($row["GroupID"]==0){
		echo"checked";}?>>
	<label for='vis'><h6>user</h6></label></div>
</div>

</br>
			<button type="submit" class="btn btn-primary">save</button>
		</div>
			</form>

</div>

	<?php
}//end acount

// IF IS there not id excute this
else{

	$theMsg="<div class='alert  alert-danger'>"."<strong>".' this id not found  '."<strong>"."</div>";
	HomeRedirerct($theMsg,'home',2);

}
}//end edit page

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//===================================================================================
//=================================== start update page
//===================================================================================

elseif ($do=='Update') {
 	
echo " <h1>Update Members</h1>";
echo "<div class='container'>";
if ($_SERVER['REQUEST_METHOD']=='POST') {
	//Get varibal from the form of edit
$id      =$_POST['userID'];
$user    =$_POST['username'];
$email   =$_POST['email'];
$fullName=$_POST['fullname'];
$adminmem=$_POST['memb'];
$avatarName           =$_FILES['avatar']['name'];
$avatarSize           =$_FILES['avatar']['size'];
$avatarTemName        =$_FILES['avatar']['tmp_name'];
$avatartype           =$_FILES['avatar']['type'];
$avatarAllowedExten   =array("jpeg","jpg","gif","png");
$avatarExten          =strtolower(end(explode(".",$avatarName )));
//update the database with this info
//password trik

$pass= empty($_POST['newpassord'])?$_POST['oldpassword']:sha1($_POST['newpassord']);

//form ERROR
$formError = array();

if (empty($user )) {
$formError[]="user name can't Be <strong>empty</strong>";	
}

if (empty($pass )) {
$formError[]="password can't Be <strong>empty</strong>";	
}

if (empty($email )) {
$formError[]=" Email can't Be <strong>empty</strong>";	
}


if (empty($fullName )) {
$formError[]="fullname can't Be <strong>empty</strong>";	
}


if (strlen($user )<3) {
$formError[]= "user can't less than three <strong> characters </strong>";	
}

if (strlen($user )>20) {
$formError[]=" user can't be greater than towenty <strong>characters</strong>";	
}


foreach ($formError as $error) {
	echo "<div class='alert alert-danger'>".$error."</div>"."<br>";
}

if (empty($formError)) {

$Avatar=rand(0,100000).'_'.$avatarName;
move_uploaded_file($avatarTemName, "upload/avatar//".$Avatar);


$sql="SELECT * FROM users WHERE username= ? AND userID !=?";
$statement=$con->prepare($sql);
$statement->execute(array($user,$id));
$count=$statement->rowcount();
if($count==0){
$sql="UPDATE `users` SET `username`= ?, `password`= ? ,`email`= ?,`fullname`= ?,`GroupID`=?,`avatar`=? WHERE `userID`= ? ";
$stmt=$con->prepare($sql);
$stmt->execute(array($user,$pass,$email,$fullName, $adminmem,$Avatar, $id)); 
//ECHO succes mesage
$theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() ." your data is updated"."</strong>"."</div>";


HomeRedirerct($theMsg,'back',2);
}
else{
$theMsg= "<div class='alert  alert-success'>"."<strong>"."this user name is exist"."</strong>"."</div>";


HomeRedirerct($theMsg,'back',2);
}
}//end if (empty($formError))
}//end $_SERVER['REQUEST_METHOD']=='POST'
else {


$theMsg= "<div class='alert  alert-danger'>"."<strong>". "you cannot browse this page directory"."</strong>"."</div>";
HomeRedirerct($theMsg,'home',2);

}

echo "</div>";

}//end else if  update

//==========================================================================
//==================start delete page
//==========================================================================
elseif($do=='Delete') {
	echo "<h1>Delete Page </h1>";
	//this is userid the http
$userID= isset($_GET['userID'])&&is_numeric($_GET['userID'])?intval($_GET['userID']):0;
//select data depent to ID
//thi is function checkitem
$checkItem=checkItem('userID','users',$userID);

//IF there ID show form
if ($checkItem>0) {
$sql="DELETE FROM `users` WHERE userID=:userID";
$stmt=$con->prepare($sql);
$stmt->bindparam(":userID",$userID);
$stmt->execute();

$theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() .'  your data is Deleted'."<strong>"."</div>";

HomeRedirerct($theMsg,2);
}else{

	$theMsg="<div class='alert  alert-danger'>"."<strong>".' this id not found  '."<strong>"."</div>";
	HomeRedirerct($theMsg,'home',2);
}
}//end else if Delete
//===========================================================================
//=====start activate page
//===========================================================================
elseif ($do=='Activate') {
	echo "<h1>Activate Page </h1>";
		//this is userid the http
$userID= isset($_GET['userID'])&&is_numeric($_GET['userID'])?intval($_GET['userID']):0;
//select data depent to ID
//thi is function checkitem
$checkItem=checkItem('userID','users',$userID);

//IF there ID show form
if ($checkItem>0) {
$sql="UPDATE `users` SET `regStatus`= :regStatus WHERE userID=:userID";
$stmt=$con->prepare($sql);
$stmt->execute (array(":regStatus"=>1,":userID"=>$userID));

$theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() .'  your data is Activated'."<strong>"."</div>";

HomeRedirerct($theMsg,2);
}else{

	$theMsg="<div class='alert  alert-danger'>"."<strong>".' this id not found  '."<strong>"."</div>";
	HomeRedirerct($theMsg,'home',2);
}
}//end  of the  activate else if

else{

	$do=header("location:?do=manage");
}//end of the main else if







//end of the sesstion
}


// is not found sesstion execute this

else{
header('location: index.php');	
exit();
include $template."footer.inc";
}
// is not found sesstion
ob_end_flush(); 
?>