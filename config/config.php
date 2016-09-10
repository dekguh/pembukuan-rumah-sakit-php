<?php
error_reporting(E_ALL^E_NOTICE);
$root = "root";
$pass = "";
$serv = "localhost";
$data = "pembukuanrumah";

$con = mysql_connect($serv,$root,$pass);
$db = mysql_select_db($data);

if(!$con){
	die("tidak konek ke server");
}
if(!$db){
	die("tidak ke ke db");
}
?>