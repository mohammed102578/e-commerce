<?php 
ob_start();
$pageTitle="Comments";
session_start();
if (isset($_SESSION['username'])) {
include 'initialize.php';

$do=isset($_GET['do'])?$_GET['do']:"manage";
//=========================================================================start manag
//do ==manage
if ($do=="manage") {
	$sql="SELECT comment.*,item.Name AS `item-Name`,users.username FROM comment INNER JOIN item ON item.`Item-ID`=comment.`Item_ID` INNER JOIN users ON users.userID=comment.`User_ID`  ORDER BY `Com_ID` DESC ";


$stmt=$con->prepare($sql);
$stmt->execute();
$Coms=$stmt->fetchAll(); 

 ?>

<h1 class="text-center">Manage Comments</h1>

<div class="container">
	<div class="col-md-12 col-sm-12">
	<div class="table-normal">
		
<table class="table table-bordered">
<tr>
	<thead>
		<td>#ID</td>
<td>Comment</td>
<td>Item-comment</td>
<td>Member-comment</td>
<td>Comment-Date</td>
<td>Control</td>
	</thead>
</tr>
<?php 
foreach ($Coms as $Com) {
echo "<tr>";
     echo "<td>".$Com['Com_ID']."</td>";
      echo "<td>".$Com['Comment']."</td>";
        echo "<td>".$Com['item-Name']."</td>";
          echo "<td>".$Com['username']."</td>";
           echo "<td>".$Com['Comment_date']."</td>";
             echo "<td> 
            <a href='comment.php?do=Edit&ComID=".$Com["Com_ID"]."' class='mem btn btn-dark'><i class='fa fa-edit'></i>Edit</a>
<a href='comment.php?do=Delete&ComID=".$Com["Com_ID"]."'class='mem btn btn-danger confirm' ><i 
class='fa fa-close'></i>Delete</a>"; 
//button Activate
if ($Com['Status']==0) {
	
	echo "<a href='comment.php?do=Approve&ComID=".$Com["Com_ID"]."'class='activate btn btn-info ' ><i class='fa fa-check'></i>Approve</a>";
}
//button Activate

echo "</td>";
echo"</tr>";
}

?>

</table>
</div>
	</div>
</div>
<?php
}//end manage page
//===========================================================================end manag

//===========================================================================start edit
//do ==Edit
elseif ($do=="Edit") {
echo "<h1>"."Edit Comment"."</h1>";
//select data depent to ID
$ComID= isset($_GET['ComID'])&&is_numeric($_GET['ComID'])?intval($_GET['ComID']):0;
$sql=" SELECT * FROM `comment` WHERE `Com_ID` = ?";
$stmt=$con->prepare($sql);
$stmt->execute(array($ComID)); 
//FETCH DATA
$com=$stmt->fetch();
//the row count
$count=$stmt->rowCount();
//IF there ID show form




if ($count>0) { 
?>
<div class="offset-md-4   col-md-4 col-sm-12">
<form method="post" action="?do=Update" class="login">

	
	<div class="div-form-login"><h1>Edit Comment</h1></div>
<input type="hidden" name="id" value="<?php echo $com['Com_ID'] ?>">
	<div class="form-group">
			<div class="text-left"> <i class="icon fa fa-comments-o" aria-hidden="true" style="font-size:36px"></i> <h5  class="online"> Item Description :</h1> </div>
	
<textarea class="form-control" name="Comment" autocomplete="off" required="required"><?php echo $com['Comment'] ?></textarea>  
</div> 

<input class="btn" type="submit" name="submit" value="Edit Item">

</form>
</div>


<?php	
}//end acount

// IF IS there not id excute this
else{

	$theMsg="<div class='alert  alert-danger'>"."<strong>".' this id not found  '."<strong>"."</div>";
	HomeRedirerct($theMsg,'home',6);
}
}//end if the do=Edit
//=============================================================================end edit

//==============================================================================start update
//do ==update
elseif ($do=="Update") {
	$Comid=$_POST['id'];
	$Comment=$_POST['Comment'];
	$count=checkItem('Com_ID','Comment',$Comid);
	if($count==1){

$sql="UPDATE comment SET `Comment`=? WHERE Com_ID=?";
$stmt=$con->prepare($sql);
$stmt->execute(array($Comment,$Comid));
$count=$stmt->rowcount();

$theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() ." your data is updated"."</strong>"."</div>";


HomeRedirerct($theMsg,'back',6);
	}//end of if $count==1
else {


$theMsg= "<div class='alert  alert-danger'>"."<strong>". "you cannot browse this page directory"."</strong>"."</div>";
HomeRedirerct($theMsg,'home',6);

}

}//end if the do=update
//===========================================================================end update

//===========================================================================start delete
//do == delete
elseif ($do=="Delete") {
	$ComID= isset($_GET['ComID'])&&is_numeric($_GET['ComID'])?intval($_GET['ComID']):0;
	$count=checkItem('Com_ID','comment',$ComID);
	if($count==1){

$sql="DELETE FROM comment  WHERE `Com_ID`=:ComID";
$stmt=$con->prepare($sql);
$stmt->bindparam(":ComID",$ComID);
$stmt->execute();
$count=$stmt->rowcount();

$theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() ." your data is Deleted"."</strong>"."</div>";


HomeRedirerct($theMsg,'back',6);
	}//end of if $count==1
else {


$theMsg= "<div class='alert  alert-danger'>"."<strong>". "you cannot browse this page directory"."</strong>"."</div>";
HomeRedirerct($theMsg,'home',6);

}
}//end if the do=delet
//===========================================================================end delete

//===========================================================================start approve
//do ==approve
elseif ($do=="Approve") {
	 $ComID=isset($_GET['ComID'])&&is_numeric($_GET['ComID'])?intval($_GET['ComID']):0;
$count=checkItem('Com_ID','comment',$ComID);
if ($count==1) {
	$sql="UPDATE comment SET `Status` =? WHERE `Com_ID`=?";
	$stmt=$con->prepare($sql);
	$stmt->execute(array(1,$ComID));
	$theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() .'  your data is Approved'."<strong>"."</div>";

HomeRedirerct($theMsg,6);
}
else{

	$theMsg="<div class='alert  alert-danger'>"."<strong>"."this id not found"."<strong>"."</div>";
	HomeRedirerct($theMsg,'home',6);
}
}//end if the do=approve
//===========================================================================end approve


}//end if session 
else{
header('location:index.php');
exit();
include $template."footer.inc";
}//end else session
ob_end_flush();
?>
 
