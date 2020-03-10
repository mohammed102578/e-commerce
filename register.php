<?php 
ob_start();
session_start();
//htis varible work prpose no navbar show
$nonavbar='';
$pageTitle="Register";
include 'initialize1.php';
//htis varible work prpose no navbar show
$nonavbar='';
//check if method request

if ($_SERVER['REQUEST_METHOD']=='POST') {
	echo " <h1>Insert Members</h1>";
	//Get varibal from the form of Add
$user                 =$_POST['username'];
$pass                 =$_POST['password'];
$email                =$_POST['email'];
$fullName             =$_POST['fullname'];
$avatarName           =$_FILES['avatar']['name'];
$avatarSize           =$_FILES['avatar']['size'];
$avatarTemName        =$_FILES['avatar']['tmp_name'];
$avatartype           =$_FILES['avatar']['type'];
$avatarAllowedExten   =array("jpeg","jpg","gif","png");
$avatarExten          =strtolower(end(explode(".",$avatarName )));



$hashpassword=sha1($pass);
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
	HomeRedirerct($theMsg,'back',5);
}


//START EMPTY $formError
if (empty($formError)) {

$Avatar=rand(0,100000).'_'.$avatarName;
move_uploaded_file($avatarTemName, "adminstration/upload/avatar//".$Avatar);




//CHECK ITEM
$checkItem=checkItem('username','users',$user);
if ($checkItem==1) {
	$theMsg=" <div class='alert alert-danger'>sory this user name is Exist</div>";

HomeRedirerct($theMsg,'back',5);

}else{

$sql="INSERT INTO `users`(`username`, `password`, `email`, `fullname`,`regStatus`,`Date`,`avatar`) VALUES (:username,:pass,:email,:fullname,0,now(),:avatar)";
$stmt=$con->prepare($sql);
$exe=$stmt->execute(array(':username'=>$user,':pass'=>$hashpassword,':email'=>$email,':fullname'=>$fullName ,':avatar'=>$Avatar));
$count=$stmt->rowCount(); 

//ECHO succes mesage
$theMsg= "<div class='alert  alert-success'>"."<strong>".$count ." your data is Inserted"."</strong>"."</div>";

	$_SESSION['user']=$user;

	header('location: index.php');
	exit();


}//end of if check item
}//end of form error
}//end of request equal post
else {

$theMsg= "<div class='alert  alert-danger'>"."<strong>". "you cannot browse this page directory"."</strong>"."</div>";
HomeRedirerct($theMsg,'back',2);
}

echo "</div>";
ob_end_flush();

?>


