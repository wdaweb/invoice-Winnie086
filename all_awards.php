<?php
include_once "base.php";
$period_str=[
    1=>'1-2月',
    2=>'3-4月',
    3=>'5-6月',
    4=>'7-8月',
    5=>'9-10月',
    6=>'11-12月'
];

$sql="select * from invoice where period='{$_GET['period']}' && left(date,4)='{$_GET['year']}' Order by date desc";
$invoice=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$sql="select * from award_numbers where year='{$_GET['year']}' && period='{$_GET['period']}'";
$award_numbers=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>


<table class="table table-striped text-center">
  <thead>
    <tr>
      <th colspan="4">此為<?=$_GET['year'];?>年、<?=$period_str[$_GET['period']];?>的發票</th>
    </tr>
  </thead>

  <tbody>
        <tr>
        <th scope="row">中的號碼</th>
        <td>獎等</td>
        <td>獎金</td>
        </tr>

<!-- 開始對獎 -->
<?php
$all_res=-1;
foreach($invoice as $inv){
    
    //對獎程式
    $number=$inv['number'];
    $date=$inv['date'];
    $year=explode('-',$date)[0];
    $period=ceil(explode('-',$date)[1]/2);
    
    foreach($award_numbers as $award){
        switch($award['type']){
            case 1:
                //特別號=我的發票號碼
                if($award['number']==$number){
                    echo "<tr>";
                    echo "<th scope='row'>".$number."</th>";
                    echo "<td>特別獎</td>";
                    echo "<td>1000萬</td>";
                    echo "</tr>";
                    $all_res=1;
                }
            break;

            case 2:    
                if($award['number']==$number){
                    echo "<tr>";
                    echo "<th scope='row'>".$number."</th>";
                    echo "<td>特獎</td>";
                    echo "<td>200萬</td>";
                    echo "</tr>";
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
                        //continue
                    }
                }
                //判斷最後中的獎項
                if($res!=-1){
                    echo "<tr>";
                    echo "<th scope='row'>".$number."</th>";
                    echo "<td>".$awardStr[$res]."獎</td>";

                   if($res==5){
                       echo "<td>200</td>";
                   }else if($res==4){
                       echo "<td>1000</td>";
                    }else if($res==3){
                        echo "<td>4000</td>";
                    }else if($res==2){
                        echo "<td>1萬</td>";
                    }else if($res==1){
                        echo "<td>4萬</td>";
                    }else if($res==0){
                        echo "<td>20萬</td>";
                   }

                    echo "</tr>";
                    $all_res=1;
                }
            break;

            case 4:
                if($award['number']==mb_substr($number,5,3,'utf8')){
                    echo "<tr>";
                    echo "<th scope='row'>".$number."</th>";
                    echo "<td>增開六獎</td>";
                    echo "<td>200</td>";
                    echo "</tr>";
                    $all_res=1;
                }
            break;
        }
    }
    

}
    if($all_res==-1){
        echo "<tr>";
        echo "<th colspan='3'>下次會中獎!!</th>";
        echo "</tr>";
    }




    
    ?>
</tbody>
</table>



<button class="btn btn-dark mx-auto">
        <a href="?do=award_numbers" class="text-light">上一頁</a>
</button>


