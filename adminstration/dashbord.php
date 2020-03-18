<?php 
ob_start();
session_start();
$pageTitle="Elalamiaa";

if (isset($_SESSION['username'])) {

include 'initialize.php';
//start dashbord.php



//=============================================
//just to identify userid into edit
   $sql="SELECT userID FROM users";
$stmt=$con->prepare($sql);
$stmt->execute();
$row=$stmt->fetch();
//===================================================

//just to identify itemrid into edit
   $sql="SELECT `Item-ID` FROM item";
$stmt1=$con->prepare($sql);
$stmt1->execute();
$row1=$stmt1->fetch();
//=============================================
 $count_latest_user =5;//count of user latest inn database 
 $latest_users=getLatest("username","users","username",$count_latest_user);//get latest user array
//=================================================
 $count_latest_item =5;//count of user latest inn database 
 $latest_items=getLatest("Name","item","Name",$count_latest_item);//get latest item array

 //===================================================
 //comment

$countcomment=5;
$sql="SELECT comment.*,users.username FROM comment INNER JOIN users ON users.userID=comment.`User_ID` ORDER BY Com_ID DESC 
 LIMIT $countcomment";
//====================================================================================

$stmt=$con->prepare($sql);
$stmt->execute();
$Coms=$stmt->fetchAll();
?>
<h1>Dashboard</h1>
<div class="container">


 <div class="row">
     <div class="col-xm-12 col-sm-6  col-lg-3">
         <div class="col1">
	         <h1>Total Members</h1>
	         <h1>
	           <a href="members.php"> <?php echo CountItem('userID','users')?></a>
	         </h1>
         </div>
     </div>





     <div class=" col-xm-12 col-sm-6  col-lg-3">
    	<div class="col2">
	       <h1>Total Comments</h1>
	        <h1>
	    	  <a href="comment.php"><?php echo CountItem('Com_ID','comment')?></a>
	       </h1>
       </div>
     </div>



     <div class=" col-xm-12 col-sm-6  col-lg-3">
    	  <div class="col3">
	       <h1>pending Members</h1>
	       <h1>
	    	 <a href="members.php?do=manage&page=pending"><?php echo checkItem("regStatus","users",0);?></a>
	       </h1>
       </div>
     </div>




  <div class=" col-xm-12 col-sm-6  col-lg-3">
     <div class="col4 ">
	     <h1>Total of Items</h1>
	     <h1>
     <!------<?php// $sql="SELECT count(`Item-ID`) FROM item";
     // $stmt2=$con->prepare($sql);
      //$stmt2->execute();
      //$row2=$stmt2->fetchColumn();
      //echo $row2;?>----------->
      <a href="Item.php"> <?php $sql="SELECT count(`Item-ID`) FROM item";
      $stmt2=$con->prepare($sql);
      $stmt2->execute();
      $row2=$stmt2->fetchColumn();
      echo $row2;?> </a>
      </h1>
       </div>
   </div>
</div>




 <!--==========================================================================-->
<div class="row">
     <div class="col-sm-12 col-lg-6">
   
      	<div class="card1 card">
         <div class="card-header">
    
           <i class="fa fa-user"></i> latest <?php echo $count_latest_user;?> Register Users
          </div>
      <div class="card-body1 card-body">
   	<?php
   
if(!empty($latest_users)){
foreach ($latest_users as $latest_user) {
  echo"<li>";
  echo "<a href='members.php?do=Edit&&userID=".$row['userID']."' class='edit'>".$latest_user['username']."<a/>";
  echo "<a href='members.php?do=Edit&&userID=".$row['userID']."'  class='mem1 btn btn-info pull-right'><i class='fa fa-edit'></i>Edit</a>";
  echo "</li>";
}
}else{

echo "No Record Show";

}



     ?>
   </div>
    </div>
 
		</div>
	
<!--===================================================================-->
    
     <div class=" col-sm-12  col-lg-6  ">
   
     	<div class="card1 card">
  <div class="card-header">
   <i class="fa fa-inbox" aria-hidden="true"></i> latest <?php echo $count_latest_item; ?>  Item
  </div>


   <div class="card-body1 card-body">
   	<?php
   
if(!empty($latest_items)){
foreach ($latest_items as $latest_item) {
  echo"<li>";
  echo "<a href='Item.php?do=Edit&&ItemID=".$row1['Item-ID']."'  class='edit'>" .$latest_item['Name']."</a>";
echo "<a href='Item.php?do=Edit&&ItemID=".$row1['Item-ID']."'  class='mem1 btn btn-info pull-right'><i class='fa fa-edit'></i>Edit</a>";
  echo "</li>";
}}
else{
echo "No Items Show";

}




     ?>
   </div>


    </div>

		</div>
  



<!--===============================================================================================-->






   


     <div class=" col-sm-12  col-lg-6  ">
   
      <div class="card3 card">
  <div class="card-header">
    
   <i class="fa fa-comment-o"></i>  latest <?php echo $countcomment;?> Comments
  </div>
   <div class="card-body3 card-body">
    <?php


if(!empty($Coms)){ 
foreach ($Coms as $Com ) {
echo "<li >".$Com['username']."<span class='comment-box  pull-right'>".$Com['Comment']."</span>"."</li>"."</br>";


}
}
else{

  echo "No Comments Show";
}

?>
   </div>
    </div>
 
    </div>
</div>




<!--===============================================================================================-->
<?php
//end dashbord.php

 
}//end of the if the session
else{

		header('location login.php');
		exit();
	}

//include $template."footer.inc";

ob_end_flush(); 
?>
