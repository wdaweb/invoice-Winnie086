<?php
include_once "base.php";

$codeBase['AB','AC','AD','AE','AF','AG',];

echo "資料產生中...";
echo date("Y-m-d H:i:s");


for($i=0;$i<10000;$i++){
  
  $code=$codeBase[rand(0,5)];
  
  // echo str_pad($number,8,'0',STR_PAD_LEFT)."<br>";
  $number=sprintf("%08d",rand(0,99999999));
  $payment=rand(1,20000);
  echo "<br>";

  $start=strtotime("2020-01-01");
  $end=strtotime("2020-12-31");
  $date=date("Y-m-d", rand($start,$end));
  // echo $date."<br>";
  $period=ceil(explode("-",$date[1])/2);
  
  $hope=[
    'code'=>$code,
    'number'=>$number,
    'payment'=>$payment,
    'date'=>$date,
    'period'=>$period
    ]
    
    
 $sql="insert into invoice (`".implode("`,`"),array_keys($hope))
 values(`".implode("','",$hope)."`)";


}


echo "資料產生中...";
echo date("Y-m-d H:i:s");


?>