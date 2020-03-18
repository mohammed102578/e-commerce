 <?php
//GENRAL FUNCTION


function getAllform($select,$table,$where=null,$and=null,$columnodered,$ordered="DESC"){
global $con;
$sql="SELECT $select FROM $table $where $and ORDER BY $columnodered $ordered";
$stmt=$con->prepare($sql);
$stmt->execute();
$row=$stmt->fetchAll();
return $row;

}

//get latest categories function v1.0
//function to get latest item to add in to database[getlastcategories]

function getcategories(){
global $con;
 $sql="SELECT * FROM `categories` ORDER BY `ID` ASC ";
$stmt=$con->prepare($sql);
$stmt->execute();
$row=$stmt->fetchAll();
return $row;
}




//this function defind title page v1.0

function title()
{
global $pageTitle;


if (isset($pageTitle)) {
	echo $pageTitle;
}else{

echo "default";

}
}

//Home redirect function[accept tow parmeter]v2.0 
//$theMsg=echo the erorr mesage;
//$url=url the location is page
//$second=  echo seconds befor redirect;
function HomeRedirerct($theMsg,$url=null,$second=3){

//the start if $url
if ($url===null) {
	

	$url='dashbord.php';
	$link="home page";
	
}//the end if $url
else{//the start else $url
//the start if $_SERVER['HTTP_REFERER']
	if (isset($_SERVER['HTTP_REFERER'])&&$_SERVER['HTTP_REFERER']!=="") {
		$url=$_SERVER['HTTP_REFERER'];
		$link="previouse page";
	
	}//the end if $_SERVER['HTTP_REFERER']

else{//the start else $_SERVER['HTTP_REFERER']



	$url='dashbord.php';
	$link="home page";

}//the end else $_SERVER['HTTP_REFERER']


}//the end else $url
echo $theMsg;
echo "<div class='alert alert-info'> You Will Be To Redirect  ".$link." After ".$second." seconds </div>";
header("refresh:$second;url=$url");
exit();
}
//***check Items function v1.0
//function to check item in data base(function accpet parameters)
//$select=to item select Example:[user-name,passwoord,full-name]
//$form=the table to select Example:[Employee,Users,]
//$value=the value is selected Example:[mohammed,m,mm,mo,non]
function checkItem($select,$table,$value){

global $con ;
$sql="SELECT $select FROM $table WHERE $select= ?";
$statement=$con->prepare($sql);
$statement->execute(array($value));
$count=$statement->rowcount();
return $count;
}

//count number of item v1.0
//function to count of number of items row
//$item=the item to count
//$table=the table to choose from

function CountItem($Item,$table){

global $con;
 $sql="SELECT count($Item) FROM $table";
 $stmt=$con->prepare($sql);
 $stmt->execute();
 $row1=$stmt->fetchColumn();
 return $row1;
}
//get latest records function v1.0
//function to get latest item to add in to database[users,item, comment]
//$select =column to choose
//table=table to choose
//$order=column acoording to orederd him
function getLatest($select,$table,$order,$limit=5){
global $con;
 $sql="SELECT $select FROM $table ORDER BY $order ASC LIMIT $limit";
$stmt=$con->prepare($sql);
$stmt->execute();
$row=$stmt->fetchAll();
return $row;
}
 
function checkitemid($ItemID){
 	global $con;
$sql="SELECT `Item-ID` FROM `item` WHERE `Item-ID`= ?";
$statement1=$con->prepare($sql);
$statement1->execute(array($ItemID));
$count1=$statement->rowcount();
return $count1;
 }

?>

