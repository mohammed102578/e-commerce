<?php
ob_start();
session_start();

if (isset($_SESSION['user'])) {
	
$pageTitle="Creat Item";
include 'initialize1.php';


if ($_SERVER['REQUEST_METHOD']=='POST') {
  
  
  //Get varibal from the form of Add
$Name       =filter_var($_POST['Name'],FILTER_SANITIZE_STRING);
$Description=filter_var($_POST['Description'],FILTER_SANITIZE_STRING);
$Price      =filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);
$Country    =filter_var($_POST['Country'],FILTER_SANITIZE_STRING);
$Status     =filter_var($_POST['Status'],FILTER_SANITIZE_NUMBER_INT);
$category   =filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
$tag        =filter_var($_POST['tag'],FILTER_SANITIZE_STRING);
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
if ($category===0) {
$formError[]="category can't Be <strong>empty</strong>";  
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


//START EMPTY $formError
if (empty($formError)) {
//CHECK ITEM  
$Avatar=rand(0,100000).'_'.$avatarName;
move_uploaded_file($avatarTemName, "upload/avatar//".$Avatar);



$sql="INSERT INTO `Item`(`Name`,`Description`,`Price`,`Add-Date`,`Country-Made`,`Status`,`Cat-ID`,`Member-ID`,`tag`,`avatar`) VALUES (:N,:D,:P,now(),:C,:S,:CA,:M,:tag,:avatar)";
$stmt=$con->prepare($sql); 
$stmt->execute(array(':N'=>$Name,':D'=>$Description,':P'=>$Price,':C'=>$Country ,':S'=>$Status,':CA'=>$category,':M'=>$_SESSION['userID'] ,':tag'=>$tag,':avatar'=>$Avatar)); 
//ECHO succes mesage
$theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() ." your data is Inserted"."</strong>"."</div>";


HomeRedirerct($theMsg,'back',6);

}//end of form error
}//end of request equal post

echo "</div>";






//=============================================================================================
?>
<h1>Creat Item</h1>
<!--/////////////////////////////////////////////////////////////////////////////////////// -->
    <div class="container">
     <div class="col-sm-12 col-md-12 col-lg-12 col-xm-12">
   
       <div class="card">
          <div class="card-header">
    
                      <i class="fa fa-tags"></i>  Add Item
            </div>
             <div class="card-body3 card-body">
              <div class="row">
  


<div class=" col-sm-12 col-md-8 col-lg-8">
  <form method="post" action="creatITEM.php" class="Item-form" enctype="multipart/form-data">

  
  <div class="div-form-login"><h3>Items</h3></div>


  
    <input class="form-control live-name" type="text" name="Name" placeholder="Enter Item Name" autocomplete="off" required="required">
  


<input class="form-control live-Description" type="text" name="Description" placeholder="Enter Item Description" autocomplete="off"required="required">


  
    <input class="form-control live-Price" type="text" name="price" placeholder="Enter price of the Item" autocomplete="off"required="required">
  
    <input class="form-control" type="text" name="Country" placeholder="Enter Country Made of the Item" autocomplete="off"required="required">

  


  
    
<!--start status select-->
<select name="Status" class="form-control">
    
<option value="0" class="Status">Status</option>
<option value="1">New</option>
<option value="2">Like-New</option>
<option value="3">Used</option>
<option value="4">Very-old</option>
</select>
<!--end status select-->

  

  
    
<!--start category select-->
<select  name="category" class="form-control">
  <option  value="0" class="Status">Category</option>
<?php 
$categories_name=getAllform("*","categories","where parent=0","","Name","ASC");
foreach ($categories_name as $categorie_name) {
  echo "<option value='".$categorie_name['ID']."'>" .$categorie_name['Name']. "</option>";
$childc=getAllform("*","categories","WHERE parent={$categorie_name['ID']}","","Name","ASC");
foreach ($childc as $childcat) {
  echo "<option value='".$childcat['ID']."'>" ."*".$childcat['Name']."  Child From ".$categorie_name['Name']. "</option>";
}

}

echo "</select>";

//=====================================================================
//select item to use date just

$sql="SELECT * FROM `item`";
$stmt2=$con->prepare($sql);
$stmt2->execute();
$item=$stmt2->fetch();

?>

  

<input class="form-control" type="text" name="tag" placeholder="Enter tags and seprate by ," autocomplete="off"required="required" >

<input type="file" class="form-control"  aria-describedby="emailHelp" name="avatar" required= "required">
<!--end category select-->
<input class="btn" type="submit" name="submit" value="Add Item">

</form>

</div>

<!-----------------------start the design picture--------------------->

         
             <div class=" col-xm-12 col-sm-12 col-md-6 col-lg-4 ">
            <div class=' LIVE-PREVIWE'>
            <div class='price'>price</div>
            <?php
            echo"<img   class='itemimg img img-responsive col-xm-12 col-sm-12 col-md-6 col-lg-4'  src='pic.png' alt='no picture'>";?>
             <div class='caption'>
             <h3>Titel</h3>
             <p>description</p>
             


             </div>
             <div><?php echo $item['Add-Date'];?></div>      
             </div>
            

</div>


               
            </div>
           </div>
        </div>
      </div>
    </div>





<br><br><br><br>


<div class='footer'>
<div class="container">
  <div class="row">
    <div class="col-md-12 ">

<span class="centeros">Copyright 2020 ,All Rights Reserved &copy</span>
</div>




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


<?php

}//==============end if user
else{

	header("location:login.php");
}
ob_end_flush();
include $template."footer.inc"; 
?>