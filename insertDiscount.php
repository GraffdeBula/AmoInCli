<?php
include('Settings.php');
include('db2.php');
#include('AmoMethods2.php');
#include('/var/www/html/AltTest/amo/AmoRequests2.php');

echo('Start Transfer');
#получаем список из календарей
$Sql="SELECT contcode,sum(discountsum) as DiscountSum FROM tblp1Discounts "
        ."WHERE ContCode>? AND ContCode IN (SELECT contcode FROM tbl6p1curpaysplan) GROUP BY contcode";        
$Param=[0];
$DiscountList=db2::getInstance()->FetchAll($Sql,$Param);

foreach($DiscountList as $Cont){
    $Sql="UPDATE TBL6P1CURPAYSPLAN SET DiscountSum=? WHERE ContCode=?";
    $Params=[$Cont->DISCOUNTSUM,$Cont->CONTCODE];
    db2::getInstance()->Query($Sql,$Params);
    echo($Cont->CONTCODE."-DONE->");
    
}

echo('DONE');