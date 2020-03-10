 <?php 
function getAllform($select,$table,$where=null,$and=null,$columnodered,$ordered='DESC'){
global $con;
$sql="SELECT $select FROM $table $where $and ORDER BY $columnodered $ordered";
$stmt=$con->prepare($sql);
$stmt->execute();
$row=$stmt->fetchAll();
return $row;

}


//***check Items function v1.0
//function to check item in data base(function accpet parameters)
//$select=to item select Example:[user-name,passwoord,full-name]
//$form=the table to select Example:[Employee,Users,]
//$value=the value is selected Example:[mohammed,m,mm,mo,non]
function checkuser($user){

global $con ;
$sql="SELECT `username`,`regStatus`  FROM users WHERE `username`= ? AND `regStatus` = 0 ";
$stmt=$con->prepare($sql);
$stmt->execute(array($user));
$count=$stmt->rowcount();
return $count;
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
//===================================================================================================================================================================================================================================================================================================================
//Home redirect function[accept tow parmeter]v2.0 
//$theMsg=echo the erorr mesage;
//$url=url the location is page
//$second=  echo seconds befor redirect;
function HomeRedirerct($theMsg,$url=null,$second=3){

//the start if $url
if ($url===null) {
	

	$url='index.php';
	$link="home page";
	
}//the end if $url
else{//the start else $url
//the start if $_SERVER['HTTP_REFERER']
	if (isset($_SERVER['HTTP_REFERER'])&&$_SERVER['HTTP_REFERER']!=="") {
		$url=$_SERVER['HTTP_REFERER'];
		$link="previouse page";
	
	}//the end if $_SERVER['HTTP_REFERER']

else{//the start else $_SERVER['HTTP_REFERER']



	$url='index.php';
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
$sql="SELECT `$select` FROM $table WHERE `$select`= ?";
$statement=$con->prepare($sql);
$statement->execute(array($value));
$count=$statement->rowcount();
return $count;
}

?>