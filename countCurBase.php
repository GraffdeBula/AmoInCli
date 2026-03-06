<?php
include('Settings.php');
include('db2.php');
#include('AmoMethods2.php');
#include('/var/www/html/AltTest/amo/AmoRequests2.php');

echo('Start Transfer');
#получаем список договоров за февраль
$Sql="INSERT into TBL6P1CURPAYSPLAN (CONTCODE,FROFFICE,FRCONTSUM) "
    . "SELECT tblp1front.contcode,froffice,frcontsum FROM tblp1anketa INNER JOIN tblp1front ON tblp1Anketa.contcode=tblp1front.contcode WHERE (Status between ? AND ?) AND frContDate<=?";
$Param=[15,90,'28.02.2026'];
db2::getInstance()->Query($Sql,$Param);

echo('DONE');