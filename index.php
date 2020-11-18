<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>統一發票紀錄及對獎系統</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<style>
     .number{
            font-size:1.2rem;
            color:red;
            font-weight:bolder;
        }
</style>

  </head>
  <body>

  <h3 class="text-center">統一發票紀錄與對獎</h3>

  <div class="container">
     <div class="col-lg-8 col-md-12 d-flex justify-content-between p-3 mx-auto border">
        <?php
           $month=[
  
           1=>"1,2月",
           2=>"3,4月",
           3=>"5,6月",
           4=>"7,8月",
           5=>"9,10月",
           6=>"11,12月",
                  
          ];

          $m=ceil(date("m")/2);

        ?>

    <div class="text-center"><?=$month[$m];?></div>
    
    <div class="text-center">
      <a href="?do=invoice_list">當期發票</a>
    </div>
    
    <div class="text-center">
      <a href="?do=award_numbers">對獎</a>  
    </div>

    <div class="text-center">
      <a href="?do=add_awards">輸入獎號</a>
    </div>

    <div class="text-center">
      <a href="index.php">回首頁</a>
    </div>

    </div>
 

  <div class="col-lg-8 col-md-12 d-flex flex-column p-3 mx-auto border">
  <?php

      if(isset($_GET['do'])){
      
      $file=$_GET['do'].".php";
      include $file;
      
      }else{
      
      include "main.php";
      
      } 
  ?>
</div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>