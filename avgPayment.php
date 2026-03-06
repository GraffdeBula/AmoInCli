<?php
include('Settings.php');
include('db2.php');
#include('AmoMethods2.php');
#include('/var/www/html/AltTest/amo/AmoRequests2.php');

echo('Start Count');
#получаем данные для расчёта
$Sql="SELECT * FROM TBL6P1CURPAYSPLAN WHERE ContCode>?" ;
$Param=[0];
$PlanList=db2::getInstance()->FetchAll($Sql,$Param);

#обход таблицы
foreach($PlanList as $Cont){
    $RestSum=$Cont->FRCONTSUM-$Cont->DISCOUNTSUM-$Cont->PAYEDSUM;
    if ($RestSum<0){
        $RestSum=0;
    }
    $RestNum=$Cont->TOTALPAYSNUM+1-$Cont->PAYEDNUM;
    if ($RestNum<=0){
        $AvgSum=0;
    }else{
        $AvgSum=$RestSum/$RestNum;
    }
    
    #Сохранение платежа
    $Sql="UPDATE TBL6P1CURPAYSPLAN SET AvgPaySum=? WHERE ContCode=?";
    $Params=[$AvgSum,$Cont->CONTCODE];
    db2::getInstance()->Query($Sql,$Params);
    echo($Cont->CONTCODE."-DONE->");    
}

echo('DONE');