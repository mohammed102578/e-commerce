<?php

$DB ='mysql:host=localhost;dbname=shop';
$user='root';
$pass='';
$option=array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8'); 
try{
$con= new PDO($DB,$user,$pass,$option);
$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
echo"";
}
catch(PDOException $e){
echo "connect to data base is failed".$e->getMessage();

}

?>