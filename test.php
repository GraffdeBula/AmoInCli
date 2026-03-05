<?php
echo("hello world");
include('Settings.php');
include('db2.php');

$Sql="SELECT * FROM tblp1anketa WHERE ClCode=?";
$Result=db2::getInstance()->FetchAll($Sql,[10002]);
var_dump($Result);