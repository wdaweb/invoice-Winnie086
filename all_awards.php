<?php
include_once "base.php";

$period_str=[
  1=>'1,2月',
  2=>'3,4月',
  3=>'5,6月',
  4=>'7,8月',
  5=>'9,10月',
  6=>'11,12月'
];


echo "你要對的發票是".$_GET['year']."年";
echo $period_str[$_GET['period']]."的發票";

// 撈出該期發票
$sql="select * from invoice where period='{$_GET['period']}' && left(date,4)='{$_GET['year']}' Order by date desc";
// echo $sql;
$invoice=$pdo->query($sql)->fetchAll();
// echo count($invoice);

// echo "<pre>";
// print_r($invoice);
// echo "</pre>";


// 撈出對獎號碼
$sql="select * from award_numbers where year='{$_GET['year']}' && period='{$_GET['period']}'";
$award_numbers=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// print_r($award_numbers);
// echo "</pre>";


// 開始對獎
$all_res=-1;

foreach($invoice as $inv){

  // 對獎程式
  $number=$inv['number'];
  $date=$inv['date'];
  $year=explode('-',$date)[0];
  $period=ceil(explode('-',$date)[1]/2);
  

      foreach($award_numbers as $award){
    
         switch($award['type']){        
         case 1:
            if($award['number']==$number){
            echo "<br>中了特別獎，號碼:".$number;
            $all_res=1;
            }
        break;

        case 2:
            if($award['number']==$number){
                echo "<br>中特獎了，號碼:".$number;
                $all_res=1;
            }
        break;

        case 3:
            $res=-1;
            for($i=5;$i>=0;$i--){
                $target=mb_substr($award['number'],$i,(8-$i),'utf8');
                $mynumber=mb_substr($number,$i,(8-$i),'utf8');
                
                if($target==$mynumber){
                  
                    $res=$i;
                }else{
                    break;
                    // continue
                }
            }

            if($res!=-1){
                echo "<br>號碼:".$number;
                echo "<br>中了{$awardStr[$res]}"."獎";
                $all_res=1;
            }
            break;
        
        case 4:
            if($award['number']==mb_substr($number,5,3,'utf8')){
                echo "<br>號碼:".$number;
                echo "<br>中了增開六獎";
            $all_res=1;
            }
        break;

    }
}


if($all_res==-1){
  echo "下次會中獎!";
}

}

?>