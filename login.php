<?php
ob_start(); 
session_start();
//htis varible work prpose no navbar show
if (isset($_SESSION['user'])) {
	header("location:index.php");
}
$pageTitle="login";
include 'initialize1.php';
//check if method request
if ($_SERVER['REQUEST_METHOD']=='POST'){
	$user=$_POST['user'];
	$password =$_POST['pass'];
	$hashedpass=sha1($password);





$sql="SELECT `userID`,`username`,`password` FROM users WHERE `username`=?  AND password=?";
$stmt=$con->prepare($sql);
$stmt->execute(array($user,$hashedpass )); 
$row=$stmt->fetch();
$count=$stmt->rowCount();
if ($count>0) {


	$_SESSION['user']=$user;
	$_SESSION['userID']=$row['userID'];

	
	header('location: index.php');
	exit();
}

else{

	$theMsg= "<div class='alert  alert-danger'>"."<strong>"."Please Enter correct User Name"."</strong>"."</div>";


HomeRedirerct($theMsg,'back',3);
}


}



?>

<div class="container">
	<div class="row">


<div class="col-xm-6 col-md-6 logn">

	<i class="cent icon fa fa-user-circle-o " style="font-size:70px; color:rgba(117, 117, 117, 1);margin-left: 210px"></i>
		<h1> Hello customer ....</h1>
	
	
		<p>wellcome in <strong>sudashop</strong></p>
		<p> please SignIn  in sudashop and after that you can interaction ,sale ,purchasing ...etc </p>
		<br><br>
		<p class="cent"> I Wish You agood visit</p>
	</div>



	<div class="col-xm-6 col-md-6">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" class="login">

	
	<div class="div-form-login"><h1>login</h1></div>
<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-user-circle-o" style="font-size:20px"></i> <h5  class="online"> User Name :</h1> </div>
			<input type="text" class="Member form-control " name="user" placeholder="Enter user name"  autocomplete="off"  required= "required">
			</div>
<div class="form-group">
			<div class="text-left">  <i class="fa fa-key" aria-hidden="true" style="font-size:20px"></i> <h5  class="online"> Password:</h1></div>
			<input type="password" class="password  Member form-control" name="pass" placeholder="Enter your password" autocomplete="new-password" required= "required">
			<i class="showpass fa fa-eye fa-2x">	</i>
			</div>

<input class="btn btun" type="submit" name="submit" value="login">	
<p> <a href="register1.php" class="link">sign in</a> تسجيل جديد ؟</p>

</form>
</div>
</div>
</div>






<div class='footer'>
<div class="container">
	
	<div class="row">


		<div class=" col-sm-4 col-md-4 ">
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