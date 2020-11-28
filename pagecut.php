<?php
    //資料庫連結
    include_once "base.php";
    $sql = "SELECT * FROM `invoice` ORDER BY `date` desc";
    $result = $pdo->query($sql)->fetch();


    // $data_nums = mysql_num_rows($result); //統計總筆數
    $data_nums=$pdo->query($sql)->fetchAll();

    $per = 10; //每頁顯示項目數量
    $pages = ceil($data_nums/$per); //無條件進入法
    if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
        $page=1; //則在此設定起始頁數
    } else {
        $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
    }
    $start = ($page-1)*$per; //每一頁開始的資料序號
    $result = mysql_query($sql.' LIMIT '.$start.', '.$per,$conn) or die("Error");
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
while ($row = mysql_fetch_array ($result)){
    
    $code=$row['code'];
    $number=$row['number'];
    $date=$row['date'];
    $payment=$row['payment'];
    ?>
    
    <tr class="text-align:center;">
        <td><?php echo $code; ?></td>
        <td><?php echo $number;?></td>
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
    echo '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
    echo "<br /><a href=?page=1>首頁</a> ";
    echo "第 ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
        if ( $page-3 < $i && $i < $page+3 ) {
            echo "<a href=?page=".$i.">".$i."</a> ";
        }
    } 
    echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";
?>