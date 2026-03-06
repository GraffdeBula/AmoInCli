<?php
include('Settings.php');
include('db2.php');
#include('AmoMethods2.php');
#include('/var/www/html/AltTest/amo/AmoRequests2.php');

echo('Start Transfer');
#получаем список из календарей
$Sql="SELECT contcode,COUNT(PayNum) AS PayNum,MAX(paydate) AS LastDate FROM TBLP1PAYCALEND "
        ."WHERE ContCode>? AND ContCode IN (SELECT contcode FROM tbl6p1curpaysplan) GROUP BY contcode";        
$Param=[0];
$CalendList=db2::getInstance()->FetchAll($Sql,$Param);

foreach($CalendList as $Cont){
    $Sql="UPDATE TBL6P1CURPAYSPLAN SET LastPayDate=?, TotalPaysNum=? WHERE ContCode=?";
    $Params=[$Cont->LASTDATE,$Cont->PAYNUM,$Cont->CONTCODE];
    db2::getInstance()->Query($Sql,$Params);
    echo($Cont->CONTCODE."-DONE->");
    
}

echo('DONE');