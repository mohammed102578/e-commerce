<?php
include"connect.php";
$template="include/template/";//template Diroctory
$lang="include/language/";//language Diroctory
$func="include/function/";//function Diroctory


//include file
include $func."function.php";
include $lang . "english.php"; 
include $template . "header.inc";


//include navbar in All file Expect file found him $nonavr
if (!isset($nonavbar)) {
	include $template."Navbar.php";
}
?>