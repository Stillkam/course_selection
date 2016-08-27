<?php
function getstable($SID){
    $Tcredit=0;
    $table=array(
        array(
            array('Cname'=>'','Tname'=>'','Croom'=>'','Dur'=>'')
        )
    );
    $conn = new mysqli('localhost','root' , '941126xiangjie', 'courses');
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $sql="select CID from sc where sc.SID={$SID}";
    $result = $conn->query($sql); 
    while($row = $result->fetch_assoc()){
        $sql1="select Cname,Tname,Croom,Ctime,Credit from course where course.CID='{$row['CID']}'";
         $result1 = $conn->query($sql1);
        while($row = $result1->fetch_assoc()){
            $week=week(substr($row['Ctime'],0,3));
            $slot=slot(substr($row['Ctime'],4,2));
            $dur=slot1(substr($row['Ctime'],6))-$slot+1;
            $table[$slot][$week]['Cname']=$row['Cname'];
            $table[$slot][$week]['Tname']=$row['Tname'];
            $table[$slot][$week]['Croom']=$row['Croom'];
            $table[$slot][$week]['Dur']=$dur;
            $Tcredit+=$row['Credit'];
        }
    }
    for ($i=1; $i<=14; $i++){
    echo '<tr><td>'.$i.'</td>';
    for ($j=1; $j<=7; $j++){
        if(empty($table[$i][$j]))
            echo '<td></td>';
        else{
        switch($table[$i][$j]['Dur']){
            case 1:echo '<td rowspan="1" style="background-color:LightGray">'.$table[$i][$j]['Cname'].'<br>'.$table[$i][$j]['Tname'].'&nbsp'.$table[$i][$j]['Croom'].'</td>';break;
            case 2:echo '<td rowspan="2" style="background-color:LightGray">'.$table[$i][$j]['Cname'].'<br>'.$table[$i][$j]['Tname'].'&nbsp'.$table[$i][$j]['Croom'].'</td>';break;
            case 3:echo '<td rowspan="3" style="background-color:LightGray">'.$table[$i][$j]['Cname'].'<br>'.$table[$i][$j]['Tname'].'&nbsp'.$table[$i][$j]['Croom'].'</td>';break;
            case 4:echo '<td rowspan="4" style="background-color:LightGray">'.$table[$i][$j]['Cname'].'<br>'.$table[$i][$j]['Tname'].'&nbsp'.$table[$i][$j]['Croom'].'</td>';break;
            default:break;
        }
        }
    }
    echo '</tr>';
    }   
    return $Tcredit;
}
function week($w){
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
function slot($s){
    $c=substr($s,1);
    switch($c){
        case '-':return (substr($s,0,1)-'0');
        default: return (substr($s,0,2)-'0');
    }
}
function slot1($s){
    $c=substr($s,0,1);
    switch($c){
        case '-': return (substr($s,1)-'0');
        default: return (substr($s,0)-'0');
    }
}