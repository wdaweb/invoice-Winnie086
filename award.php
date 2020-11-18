<?php
include_once "base.php";

$inv_id=$_GET['id'];

// echo "select * from invoice where id='$inv_id'";
$invoice=$pdo->query("select * from invoice where id='$inv_id'")->fetch();
// fetch()一筆資料、fetchAll()多筆資料

// echo "<pre>";
// print_r($invoice);
// echo "</pre>";
$number=$invoice['number'];

// 找出獎號
// 1. 確認期數:目前發票的日期作分析
// 2. 得到期數資料後:對應該期開獎獎號

$date=$invoice['date'];

// explode('-',$date)取得日期資料的陣列，陣列第二個元素就是月份
// 月份可推算期數，有期數及年份就可找到該期開獎號碼
// $array=explode('-',$date);
// $month=$array[1];
// $period=ceil(explode($month/2);

$year=explode('-',$date)[0];
$period=ceil(explode('-',$date)[1]/2);
// echo "select * from award_numbers where year='$year' && period='$period'";
$awards=$pdo->query("select * from award_numbers where year='$year' && period='$period'")->fetchAll();

// echo "<pre>";
// print_r($award);
// echo "</pre>";

foreach($awards as $award){
    switch($award['type']){        
        case 1:

        //  echo "特別獎=".$award['number']."<br>";
            if($award['number']==$number){
            echo "<br>中了特別獎，號碼:".$number;
            }
        break;

        case 2:
            // echo "特獎=".$award['number']."<br>";
            if($award['number']==$number){
                echo "<br>中特獎了，號碼:".$number;
            }
        break;

        case 3:
            // echo "頭獎=".$award['number']."<br>";
            for($i=5;$i>=0;$i--){
                $target=mb_substr($award['number'],$i,(8-$i),'utf8');
                $mynumber=mb_substr($number,$i,(8-$i),'utf8');
                
                if($target==$mynumber){
                    echo "<br>號碼:".$number;
                    echo "<br>中了".{$awardStr['i']}."獎";
                }else{
                    break;
                    // continue
                }
            }
            break;
        
        case 4:
            if($award['number']==mb_substr($number,5,3,'utf8')){
                echo "<br>號碼:".$number;
                echo "<br>中了增開六獎";
            }
        break;


    }
}



?>