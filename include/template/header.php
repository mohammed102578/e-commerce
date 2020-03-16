<!DOCTYPE html>
<html>
<head>
	<title><?php title() ?></title>
	<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="design/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="design/css/font-awesome.min
.css">
<link rel="stylesheet" type="text/css" href="design/css/control.css">
</head>
<body class="back ground">


<?php

if (isset($_SESSION['user'])) {
$sql="SELECT * FROM users WHERE `username`=?";
$stmt=$con->prepare($sql);
$stmt->execute(array($_SESSION['user']));
$row=$stmt->fetch();?>

 <div class="dropdown online ">
  <?php echo "<img   class='proimg img-fluid rounded-circle'
   src='adminstration/upload/avatar/".$row['avatar']."'alt='no picture'>" ;?>
  <a class=" dropdown-toggle mr" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo $session_user;?>
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

    <a class="dropdown-item" href="creatITEM.php"><i class="fa fa-eye" aria-hidden="true"></i>
    Add New Item</a>
    <a class="dropdown-item" href="profile.php"><i class="fa fa-pencil" aria-hidden="true"></i> 
    profile</a>
    
    <a class="dropdown-item" href="logout1.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
    log out</a>
  </div>
</div>

&nbsp&nbsp&nbsp&nbsp
<div class="dropdown online">
  <a class=" dropdown-toggle mr" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    
    Categories
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
     


<?php 
 $categories=getAllform("*","categories","WHERE parent=0","","ID"); 

foreach ($categories as $categorie) {

echo '<a class="dropdown-item " href="parent-cat.php?catID='.$categorie['ID'].'">'.$categorie['Name']."</a>";


}



      ?>

      
  </div>
</div>

<img  src='logo.jpg' class="logo1 pull-right">


<?php
$status=checkuser($session_user);
	if($status==1){
     echo "this user is need activated";
}
}else{
	$login="login.php";
  $register="register1.php";
?>
<div class="container">
	<div class="upper-bar">
	
		<div class="pull-right"><a class='sing'href="<?php echo $login;?>">login   /</a>
		<a class='sing '  href="<?php echo $register;?>">sing up</a></div>

    <img  src='logo.jpg' class="logo">
	</div>
</div>
<?php
}

?>


<nav class="navbar navbar-expand-lg navbar-light bg-color justify-content-between ">
  <a class="navbar-brand" href="index.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i>Home Page</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">



 <ul class="navbar-nav nav-ml mr-auto" >
    
     
<li class="nav-item ">
        <a class="nav-link nav-activ bold" href="#">web site</a>
      </li>
<li class="nav-item ">
        <a class="nav-link nav-activ bold" href=#>Company</a>
      </li>
<li class="nav-item ">
        <a class="nav-link nav-activ bold" href="#">Applications</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link nav-activ bold" href="#">Advestment</a>
      </li>


  </ul>
<!--search-->
  <form class="form-inline" action="<?php echo htmlspecialchars('search.php?search=$_GET["search"]')?>" method="GET" >
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php 


if(isset($_GET['search'])){

  echo $_GET['search'];
}
else{
  echo"";
}

?>">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
<!--end search-->
  </div>
</nav>

<?php include $template."footer.inc";?>