<?php
include('Settings.php');
include('db2.php');
include('AmoMethods2.php');
include('/var/www/html/AltTest/amo/AmoRequests2.php');

#подключаем амо
$Amo=new AmoMethods2();

#получаем список договоров за февраль
$Sql="SELECT tblp4anketa.contcode,akLeadId FROM tblp4anketa INNER JOIN tblp4front ON tblp4anketa.contcode=tblp4front.contcode WHERE frContDate BETWEEN ? AND ?";
$Param=['01.01.2026','28.02.2026'];
$ContList=db2::getInstance()->FetchAll($Sql,$Param);
foreach($ContList as $Cont){
    $LeadId=$Cont->AKLEADID;
    $Lead=$Amo->getLeadId($LeadId);
    
    $Fields=$Lead['custom_fields_values'];
    $Source='-';
    $Code='-';
    foreach($Fields as $Field){
        if($Field['field_id']==1680596){
            $Source=$Field['values'][0]['value'];
        }
        if($Field['field_id']==1678544){
            $Code=$Field['values'][0]['value'];
        }
    }    
    
    $Sql="UPDATE tblP4Anketa SET akLeadSource=?, akLeadPromoCode=? WHERE ContCode=?";
    $Params=[$Source,$Code,$Cont->CONTCODE];
    db2::getInstance()->Query($Sql,$Params);
    echo($Cont->CONTCODE.' - DONE; ');
}

/*
$Lead=(new AmoMethods2())->getLeadId(42301336);

$Fields=$Lead['custom_fields_values'];
$AmoResult=[42301336,'',''];
foreach($Fields as $Field){
    if($Field['field_id']==1680596){
        $AmoResult[1]=$Field['values'][0]['value'];
    }
    if($Field['field_id']==1678544){
        $AmoResult[2]=$Field['values'][0]['value'];
    }
}

foreach($AmoResult as $Param){
    echo($Param);
    echo("=====");
}
 * 
 */