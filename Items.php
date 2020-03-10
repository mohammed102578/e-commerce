<?php
ob_start();
session_start();

	
$pageTitle="item detailes";
include 'initialize1.php';

echo "<h1>"."My Detailes Item"."</h1>";




$ItemID= isset($_GET['ItemID'])&&is_numeric($_GET['ItemID'])?intval($_GET['ItemID']):0;
//select data depent to ID
$sql="SELECT item.*,categories.Name AS `cat-Name`,users.username AS `username` FROM item INNER JOIN categories ON categories.ID=item.`Cat-ID` INNER JOIN users ON users.userID=item.`Member-ID`  WHERE `Item-ID` = ? AND `Approve`=1";
$stmt=$con->prepare($sql);
$stmt->execute(array($ItemID)); 
//FETCH DATA
$Item=$stmt->fetch();
$count=$stmt->rowcount();



//the row count
if ($count==1) {
  echo "<h1>".$Item['Name']."</h1>";
  ?>

<div class="container">
  <div class="row">
    <div class="col-md-3">
      <?php
            echo"<img   class='itemimg img img-responsive' src='adminstration/upload/avatar/".$Item['avatar']."' alt='no picture'>";?>

<p style="font-style: italic;"> <?php echo $Item['Description']?></p>
    </div>
    

    <div class="col-md-9 iteminfo">
      <ul class="list-unstyled">
        
       
     
     <li><i class='fa fa-calendar fa-fw'></i><span class="it">Date: </span> <?php echo $Item['Add-Date']?></li>
     <li><i class='fa fa-money fa-fw'></i><span class="it">Price:</span><?php echo "$",$Item['Price']?></li>
     <li><i class='fa fa-building fa-fw'></i><span class="it">Madet in:</span><?php echo $Item['Country-Made']?></li>
     <li><i class='fa fa-tags fa-fw'></i><span class="it">Added By:</span><?php echo $Item['username']?></li>
     <li><i class='fa fa-user fa-fw'></i><span class="it">Category:</span> <a href="item-cat.php?catID=<?php echo $Item['Cat-ID']?>"><?php echo $Item['cat-Name']?></a></li>
     <li><i class='fa fa-tags fa-fw'></i><span class="it">Tag:</span> 
        <?php
         $tag=$Item['tag'];
         $alltag=explode(",",$tag);
         foreach ($alltag as $tags) {
           $taga=str_replace(" ","",$tags);
           $lowetag=strtolower($tags);
           echo "<a href='tag.php?Name=".$lowetag."'>".$taga."</a>"." |";
         }
        ?>
       </li>



 <li><i class='fa fa-eye fa-fw'></i><span class="it">views count:</span> 
        <?php
         $view=$Item['views']+1;
         
           $sql="UPDATE `item` SET `views`=? WHERE `Item-ID`=?";
           $stmt=$con->prepare($sql);
           $stmt->execute(array($view,$ItemID));
           echo $view=$Item['views']+1;
        ?>
       </li>











      </ul>
    

    </div>
  </div>
  <hr>
  <?php if(isset($_SESSION['user'])){?>
  <!-------the start add comment----------->
  <div class="row">
    <div class="col-md-3 offset-md-3">
      <h3>add you comment</h3>
      <form action="<?php $_SERVER['PHP_SELF']."?ItemID=".$Item['Item-ID']?>" method="post">
        <textarea class="form-control" name="comment" required="required"></textarea>
        <input class="btn btn-dark" type="submit" value="Add Comment">
      </form>
 <?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
  $comment=filter_var($_POST['comment'],FILTER_SANITIZE_STRING);
  $usercom=$_SESSION['userID'];
  $itemcom=$Item['Item-ID'];

  if (!empty($comment)) {
    $sql="INSERT INTO `comment`(`Comment`, `Status`, `Comment_date`, `Item_ID`, `User_ID`) VALUES (:com,0,NOW(),:itemid,:userid)";
    $stmt=$con->prepare($sql);
    $stmt->execute(array('com'=>$comment,'itemid'=>$itemcom,'userid'=>$usercom));
if ($stmt) {

  $theMsg= "<div class='alert  alert-success'>"."<strong>".$stmt->rowCount() ." your data is Added"."</strong>"."</div>";
echo $theMsg;

}

  }//the end of the if not empty
else{
$theMsg= "<div class='alert  alert-danger'>"."comment can't "."<strong>"."empty"."</strong>"."</div>";
echo $theMsg;

}




}//the end of request method



 ?>

    </div>

  </div>
<?php }else{ echo "<div class='alert alert-danger'>"."<a href='login.php'>"."<strong>"." Login"."</strong>"."</a>". "  OR". "<a href='register1.php'>"."<strong>"." Register"."</strong>"."</a>"." to Add comment"."</div>";}?>
  <!-------the start add comment----------->
  <hr>
  <?php 

$sql="SELECT comment.*,users.username  AS `username` FROM comment INNER JOIN users ON `userID`=`User_ID` where Status =1 AND `Item_ID`=?";
$stmt=$con->prepare($sql);
$stmt->execute(array($ItemID));
$row=$stmt->fetchall();


 
  
   foreach($row as $rows){
    echo "<div class='container'>";
      echo"<div class='row'>";
       echo"<div class='user-circle'>";
    echo"<div class='col-md-3'>";
    echo "<img class='itemimg img-fluid rounded-circle' src='pic.jpg' alt='no picture'>";
    echo "<h5>".$rows['username']."</h5>"; 

    echo"</div>";
    echo "</div>";

    echo "<div class='col-md-9'>";
    echo "<div class='user-com'>";
      echo "<p class='lead'>".$rows['Comment']."</p>";
     echo "</div>";
    
   echo"</div>";
  echo "</div>";
echo "</div>";
echo "<hr>";
}

}
else {


$theMsg= "<div class='alert  alert-danger'>"."<strong>". "No found this Id OR This Item Is Waiting Approval"."</strong>"."</div>";
HomeRedirerct($theMsg,'home',6);
echo "</div>";
}








ob_end_flush();
include $template."footer.inc"; 
?>