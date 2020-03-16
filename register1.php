<?php 
//htis varible work prpose no navbar show
$nonavbar='';
$pageTitle="Register";
include 'initialize1.php';
//htis varible work prpose no navbar show
$nonavbar=''





;?>

<div class="container">
	<div class="row">


<div class="col-sm-6 col-md-6 logn">

	<i class="cent icon fa fa-user-circle-o " style="font-size:70px; color:rgba(117, 117, 117, 1);margin-left: 210px"></i>
		<h1> Hello customer ....</h1>
	
	
		<p>wellcome in <strong>sudashop</strong></p>
		<p> please SignUp  in Sudashop and after that you can interaction ,sale ,purchasing ...etc </p>
		<br>.<br>.<br>.<br>.<br>.<br>
		<p class="cent"> I Wish You agood visit</p>
	</div>



	<div class="col-sm-6 col-md-6">
		
<form class="Register" action="<?php echo htmlspecialchars('register.php'); ?> " method="POST" enctype="multipart/form-data">
			<div class="div-form-login"><h1>Register</h1></div>
			
			
			<div class="text-left"> <i class="icon fa fa-user-circle-o" style="font-size:20px"></i> <h5  class="online"> User Name :</h1> </div>
			<input type="text" class="Member form-control " name="username" placeholder="Enter user name"  autocomplete="off"  required= "required">
			
			

            <div class="form-group">
			<div class="text-left">  <i class="fa fa-key" aria-hidden="true" style="font-size:20px"></i> <h5  class="online"> Password:</h1></div>
			<input type="password" class="password  Member form-control" name="password" placeholder="Enter your password" autocomplete="new-password" required= "required">
			<i class="showpass fa fa-eye fa-2x">	</i>
			</div>


			<div class="form-group">
			<div class="text-left"> <i class="fa fa-envelope" aria-hidden="true"style="font-size:20px"></i> <h5  class="online"> Email:</h1></div>
			<input type="email" class="Member form-control"  aria-describedby="emailHelp" placeholder="Enter email" name="email" required= "required">
			</div>
			
			
            <div class="form-group">
			<div class="text-left"> <i class="fa fa-user-plus" aria-hidden="true"style="font-size:20px"></i> <h5  class="online"> Full Name:</h1></div>
			<input type="text" class="Member form-control"placeholder="please Enter fullname" name="fullname" required= "required" autocomplete="off">
			</div>
            
			
			

            

           <div class="form-group">
			<div class="text-left"><i class="icon fa fa-file-image-o" aria-hidden="true"style="font-size:20px"></i> <h5  class="online"> Choose profile :</h1></div>
			<input type="file" class="form-control "  aria-describedby="emailHelp" name="avatar" required= "required">
			</div>

			
<br>

			<button type="submit" class="btn btn-primary"> register</button>


			<p> <a href="login.php" class="link">تسجل الدخول  </a> هل لديك حساب؟</p>
		
			</form>
          



          </div></div></div>

















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
