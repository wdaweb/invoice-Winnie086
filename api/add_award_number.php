<?php

//撰寫建立各期中獎號碼的程式
//將表單傳送過來的中獎號碼寫入資料庫
include_once "../base.php";

echo "<pre>";
print_r(array_keys($_POST));
echo "</pre>";

$year=$_POST['year'];
$period=$_POST['period'];

// 特別獎
$sql="insert into 
award_numbers
(`year`,`period`,`number`,`type`)
values
('$year','$period','{$_POST['special_prize']}','1')";
$pdo->exec($sql);
// echo $sql."<br>";

// 特獎
$sql="insert into 
award_numbers
(`year`,`period`,`number`,`type`)
values
('$year','$period','{$_POST['grand_prize']})','2')";
$pdo->exec($sql);
// echo $sql."<br>";


// 頭獎
foreach($_POST['first_prize'] as $first){
  
  if(!empty($first)){
    
    $sql="insert into 
    award_numbers
    (`year`,`period`,`number`,`type`)
    values
    ('$year','$period','$first','3')";
    $pdo->exec($sql);
    // echo $sql."<br>";
  }
}

// 六獎
foreach($_POST['addSixPrize_prize'] as $six){
  
  if(!empty($six)){
    
    $sql="insert into 
    award_numbers
    (`year`,`period`,`number`,`type`)
    values
    ('$year','$period','$six','4')";
    $pdo->exec($sql);
    // echo $sql."<br>";
  }
}


echo "新增完成";
header("location:../index.php?do=award_numbers&pd=<?".$year."-".$period);


?>