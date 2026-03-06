<?php
include('Settings.php');
include('db2.php');
#include('AmoMethods2.php');
#include('/var/www/html/AltTest/amo/AmoRequests2.php');

echo('Start Count');
#получаем данные для расчёта
$Sql="SELECT * FROM TBL6P1CURPAYSPLAN WHERE ContCode>? AND LastPayDate>=?" ;
$Param=[0,'01.11.2026'];
$PlanList=db2::getInstance()->FetchAll($Sql,$Param);

#обход таблицы
$i=0;
foreach($PlanList as $Cont){
    $i++;   
    
    #Сохранение платежа
    $Sql="UPDATE TBL6P1CURPAYSPLAN SET Pay11=? WHERE ContCode=?";
    $Params=[$Cont->AVGPAYSUM,$Cont->CONTCODE];
    db2::getInstance()->Query($Sql,$Params);
    echo($Cont->CONTCODE."-DONE->");    
}

echo('в базе '.$i.' договоров');