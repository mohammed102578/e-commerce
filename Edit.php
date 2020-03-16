<?php
ob_start();
session_start();

if (isset($_SESSION['user'])) {
$pageTitle="Edit Profile";
include 'initialize1.php';


$userID= isset($_GET['userID'])&&is_numeric($_GET['userID'])?intval($_GET['userID']):0;
//select data depent to ID
$sql=" SELECT * FROM users WHERE userID=? LIMIT 1";
$stmt=$con->prepare($sql);
$stmt->execute(array($userID)); 
//FETCH DATA
$row=$stmt->fetch();
//the row count
$count=$stmt->rowCount();
//IF there ID show form
if ($count>0) { 

	echo"<div class='cent'>";
echo"<img   class='proimg img-fluid rounded-circle'
   src='adminstration/upload/avatar/".$row['avatar']."'alt='no picture'>";
echo"</br>";
echo "<h1>"."wellcom  ".$_SESSION['user']."</h1>";
echo"</div>";?>
           
			<form class="loginedit" action="<?php echo htmlspecialchars('?do=Update') ?>" method="POST" enctype="multipart/form-data">
			
			<div class="div-form-login"><h1>Edit Profile</h1></div>
			<input type="hidden" name="userID" value="<?php echo $userID?>">
			
			 
			 <div class="form-group">
			 	<span class="ali">Name:</span>
			<input type="text" class="form-control" name="username" placeholder="username" autocomplete="off" value="<?php echo $row["username"]?>" required= "required">
			</div>


			
			
			<div class="form-group">
				<span class="ali">Password:</sapn>
			<input type="hidden" name="oldpassword" value="<?php echo $row['password']?>" >
			<input type="password" class="form-control" placeholder="Leave Blank If you Dont Change password" autocomplete="new-password" name="newpassord">
			</div>



			<div class="form-group">
			<span class="ali">  Email:</span>
			<input type="email" class="form-control"  aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?php echo $row["email"]?>" required= "required">
			</div>
            



			<div class="form-group">
		    <span class="ali">Full Name:</span>
			
			<input type="text" class="form-control" placeholder="fullname" name="fullname" value= "<?php echo $row["fullname"]?>" required= "required">
			</div>
             
            
            
			
			<div class="form-group">
				<span class="ali">Avatar:</span>
            <input type="file" class="form-control"  aria-describedby="emailHelp" name="avatar"  placeholder="please Enter password"
			required= "required">
             </div>
			<button type="submit" class="btn btn-primary form-control" style="text-align: center;"> save</button>
			</form>



	<?php
}//end acount

// IF IS there not id excute this
else{

	$theMsg="<div class='alert  alert-danger'>"."<strong>".' this id not found  '."<strong>"."</div>";
	HomeRedirerct($theMsg,'home',2);

}


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//===================================================================================
//=================================== start update page
//===================================================================================


 	

echo "<div class='container'>";
if ($_SERVER['REQUEST_METHOD']=='POST') {
	//Get varibal from the form of edit
$id                   =htmlspecialchars($_POST['userID']);
$user                 =htmlspecialchars($_POST['username']);
$email                =htmlspecialchars($_POST['email']);
$fullName             =htmlspecialchars($_POST['fullname']);
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
	echo "<div class='alert alert-danger'>".$error."</div>"."<br>";
}

if (empty($formError)) {

$Avatar=rand(0,100000).'_'.$avatarName;
move_uploaded_file($avatarTemName, "adminstration/upload/avatar//".$Avatar);
$sql="SELECT * FROM users WHERE username= ? AND userID !=?";
$statement=$con->prepare($sql);
$statement->execute(array($user,$id));
$count=$statement->rowcount();
if($count==0){
$sql="UPDATE `users` SET `username`= ?, `password`= ? ,`email`= ?,`fullname`= ?,`avatar`=? WHERE `userID`= ? ";
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
echo "</div>";
?>
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


}else{
	"<div class='alert  alert-danger'>"."<strong>". "you cannot browse this page directory"."</strong>"."</div>";
}


ob_end_flush();
include $template."footer.inc";
?>