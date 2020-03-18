<?php
ob_start(); 
session_start();
//htis varible work prpose no navbar show
$nonavbar='';
$pageTitle="login";
include 'initialize.php';
//check if method request
if ($_SERVER['REQUEST_METHOD']=='POST'){
	$user_name=$_POST['user'];
	$password =$_POST['pass'];
	$hashedpass=sha1($password);
 
//echo $user_name."<br>".$password."<br>".$hashedpass;
$sql="SELECT userID,username,password FROM users WHERE username=?  AND password=? AND GroupID=1 LIMIT 1";
$stmt=$con->prepare($sql);
$stmt->execute(array($user_name,$hashedpass )); 
$row=$stmt->fetch();
$count=$stmt->rowCount();
if ($count>0) {


	$_SESSION['username']=$user_name;
	$_SESSION['ID']=$row['userID'];

	
	header('location: dashbord.php');
	exit();
}

else{

	echo $theMsg= "<div class='alert   alert-danger alert1'>"."<strong>"."Please Enter correct User Name"."</strong>"."</div>";



}


}
?>
<h1> Wellcom Admin please Login </h1>
<div class="offset-md-4   col-md-4 col-sm-12">
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" class="login">

	
	<div class="div-form-login"><h3>login</h3></div>
<!--<span class="ICON"><i class="fa fa-user" aria-hidden="true"></i></span>-->	
<input class="form-control" type="text" name="user" placeholder="Enter user name" autocomplete="off">
<input class="form-control" type="password" name="pass" placeholder="Enter your password" autocomplete="new-password">
<input class="btn" type="submit" name="submit" value="login">	


</form>
</div>
<?php


include $template."footer.inc"; 

ob_end_flush();
?>