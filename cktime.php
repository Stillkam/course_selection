<?php

function cktime($SID,$CID){
    $conn = new mysqli('localhost','root' , '941126xiangjie', 'courses');
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    $sql="select Ctime from course where course.CID='{$CID}'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $week1=week2(substr($row['Ctime'],0,3));
    $slot1=slot2(substr($row['Ctime'],4,2));
    $sql="select CID from sc where sc.SID={$SID}";
    $result = $conn->query($sql); 
    while($row = $result->fetch_assoc()){
        $sql1="select Ctime from course where course.CID='{$row['CID']}'";
         $result1 = $conn->query($sql1);
         $row = $result1->fetch_assoc();
            $week=week2(substr($row['Ctime'],0,3));
            $slot=slot2(substr($row['Ctime'],4,2));
            $dur=slot3(substr($row['Ctime'],6))-$slot+1;
        if($week==$week1&$slot<=$slot1&$slot1<=($slot+$dur))
            return 0;
    }
   return 1;
}
function week2($w){
    switch($w){
    case '一': return 1;
    case '二': return 2;
    case '三': return 3;
    case '四': return 4;
    case '五': return 5;
    case '六': return 6;
    case '日': return 7;
    default:break;
    }
}
function slot2($s){
    $c=substr($s,1);
    switch($c){
        case '-':return (substr($s,0,1)-'0');
        default: return (substr($s,0,2)-'0');
    }
}
function slot3($s){
    $c=substr($s,0,1);
    switch($c){
        case '-': return (substr($s,1)-'0');
        default: return (substr($s,0)-'0');
    }
}