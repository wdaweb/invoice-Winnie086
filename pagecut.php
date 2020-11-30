<?php
    //資料庫連結
    include_once "base.php";
 

    $year=date("Y");
    $period=ceil(date("m")/2);
    $sql = "SELECT * FROM `invoice` WHERE `period`='$period' ORDER BY `date` desc";
    
    // $data_nums = mysql_num_rows($result); //統計在該年中各期的總筆數
    // $data_nums=$pdo->query()->fetch();
    $data_nums=$pdo->query("select count(`invoice`.`id`) from `invoice` where year(`date`)='$year' && `period`='$period'")->fetch();
    // print_r($data_nums[0]);

    $per = 50; //每頁顯示項目數量
    $pages = ceil($data_nums[0]/$per); //無條件進入法，算總共需要幾頁
    if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
        $page=1; //剛開始進來，則在此設定起始頁數
    } else {
        $page = intval($_GET["page"]); //確認頁數只能夠是數值資料，顯示現在在第幾頁
    }
    $start = ($page-1)*$per; //每一頁開始的資料序號，資料庫中的排法跟陣列一樣，索引值從第0筆開始
    $result=$pdo->query($sql.' LIMIT '.$start.','.$per)->fetchAll();//LIMIT函式:$start顯示每頁開始的索引值、$per代表每頁要顯示幾筆資料
    // print_r($result);
    // $result = mysql_query($sql.' LIMIT '.$start.', '.$per,$conn) or die("Error");
?>

<table>
<tr>
        <td>發票號碼</td>
        <td>消費日期</td>
        <td>消費金額</td>
        <td>操作</td>
</tr>
<?php
//輸出資料內容

foreach($result as $row){
    
    $code=$row['code']."-".$row['number'];
    $date=$row['date'];
    $payment=$row['payment'];
    ?>
    
    <tr class="text-align:center;">
        <td><?php echo $code; ?></td>
        <td><?php echo $date;?></td>
        <td><?php echo $payment;?></td>
    </tr>

<?php 
    }
?>
</table>

<br />

<?php
    //分頁頁碼
    echo '共 '.$data_nums[0].' 筆-現在在第 '.$page.' 頁-共 '.$pages.' 頁';
    echo "<br /><a href=?page=1>首頁</a> ";
    echo "第 ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
        if ( $page-3 < $i && $i < $page+3 ) {
            echo "<a href=?page=".$i.">".$i."</a> ";
        }
    } 
    echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";
?>