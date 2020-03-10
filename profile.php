<?php
ob_start();
session_start();

if (isset($_SESSION['user'])) {
	
$pageTitle="profile";
include 'initialize1.php';

echo "<h1>"."My Profile"."</h1>";

$sql="SELECT * FROM users WHERE `username`=?";
$stmt=$con->prepare($sql);
$stmt->execute(array($session_user));
$row=$stmt->fetch();
echo"<div class='cent'>";
echo"<img   class='promimg img-fluid rounded-circle'
   src='adminstration/upload/avatar/".$row['avatar']."'alt='no picture'>";
echo"</br>";
echo "<h2>"."wellcom  ".$_SESSION['user']."</h2>";
echo"</div>";
?>

<div class="container">

  <div class="row">

     <div class="col col-md-12">
   
       <div class="card">
            <div class="card-header">
    
            <i class="fa fa-info"></i>  My Information
            </div>
            <div class="card-body3 card-body">
           <ul class="list-unstyled">
             


<li>
<i class="fa fa-unlock-alt fa-fw"></i>
  <span>Name   :  </span><?php echo $row['username'];?></li>
<li>
<i class="fa fa-envelope fa-fw"></i>
  <span>Email  :</span><?php echo $row['email'];?></li>
<li>
<i class="fa fa-user fa-fw"></i>
  <span>Full Name  :</span><?php echo $row['fullname'];?></li>
<li>
<i class="fa fa-calendar fa-fw"></i>
  <span>Register Date  :</span><?php echo $row['Date'];?></li>
<li>
<i class="fa fa-tags fa-fw"></i><span>favorit categoreis  :</span>
<li>
  <a href="Edit.php?userID=<?php echo $_SESSION['userID']?>" class="mem btn btn-dark"><i class='fa fa-edit'></i>Edit</a>
</li>
           </ul>

</div>
            
            </div>
       </div>
 
    </div>

  </div>
<br>
<!--/////////////////////////////////////////////////////////////////////////////////////// -->
 <div class="row">

     
            
                
         
 
           <?php
          $member_ID=$row['userID'];
          //this to indicate to this function is appproved=null to include approve =1 else found any 
          //number the make to select all
          $items=getAllform("*","item","WHERE `Member-ID`=$member_ID","","`Item-ID`");

         #$items=getitems('Member-ID',$member_ID,4);
         if (!empty($items)) {
          
          echo "<div class='container'>";
         echo "<div class='row'>";
           foreach ($items as $item) {
            
            
            






echo"<div class='col-xm-12 col-sm-6 col-md-3 '>";

  echo "<div class='tag'>";
  

echo "<div class='price'>"."$".$item['Price']."</div>";

            if($item['Approve']==0){
              echo "<span class='approx'>"."Not Approved"."</span>";
            }

echo"<img   class='itemimg img img-responsive  col-xm-12 col-sm-6 col-md-3' src='adminstration/upload/avatar/".$item['avatar']."' alt='no picture'>";

 
echo "<h3>"."<a href='Items.php?ItemID=".$item['Item-ID']."'>".$item['Name']."</a>"."</h3>";
  echo"<p>".$item['Description']."</p>";
   
  echo"<i class='fa fa-calendar fa-fw'>"."</i>".
   "<span>".$item['Add-Date']."</span>";


echo"</div>";
echo"</div>";












         }
         echo"</div>";
         echo"</div>";
         }
         else{

          echo"<div class='container'>"."<h6>".  " NO item TO SHOW"."</h6>"."     "."<i class='fa fa-plus fa-fw'>"."</i>".'<a class="btn sing" href="creatITEM.php">'."<strong>".'Add New Item'.
        "</strong>".'</a>'."</div>";
         }
         ?>
  <br>
<!--/////////////////////////////////////////////////////////////////////////////////////// -->
<div class='container'>
 <div class="row">

     <div class="col-md-12 ">
   
       <div class="card">
            <div class="card-header">
    
            <i class="fa fa-comment-o"></i>  Comments
            </div>
            <div class="card-body3 card-body">
            <?php 
$sql="SELECT `Comment` FROM comment WHERE `User_ID`=?";
$stmt=$con->prepare($sql);
$stmt->execute(array($member_ID));
$com=$stmt->fetchAll();
$comCount=$stmt->rowcount();
if ($comCount>0) {
  foreach($com as $coms){
echo "/*".$coms['Comment']."."."<br>";

   }
}
else{

  echo "</div class='alert alert-danger'>NOT FOUNT COMMENT</div>";
}
         



            ?>
            </div>
       </div>
 
    </div>

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