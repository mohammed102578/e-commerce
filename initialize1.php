<?php
//ini_set('display_errors',"on");
//error_reporting("E_ALL");

$session_user='';
if (isset($_SESSION['user'])) {
	$session_user=$_SESSION['user'];
}

include"connect.php";
$template="include/template/";//template Diroctory
$lang="include/language/";//language Diroctory
$func="include/function/";//function Diroctory


//include file
include $func."function.php";
include $lang . "english.php"; 

include $template . "header.php";

//include navbar in All file Expect file found him $nonavr

//include $template . "Navbar.php";


?>