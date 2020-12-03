<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>發票</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/4233378c09.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="invoice.css">


  </head>
  <body>
  <?php
           $month=[
  
           1=>"1-2月",
           2=>"3-4月",
           3=>"5-6月",
           4=>"7-8月",
           5=>"9-10月",
           6=>"11-12月",
                  
          ];

          $m=ceil(date("m")/2);

        ?>
  <h4 class="text-center">發票存摺及對獎</h4>

  <div class="container-fluid d-flex flex-row">

  <div class="nav_bar text-center">
  <ul class="nav flex-column ">
  <li class="nav-item">
    <a class="nav-link disabled" tabindex="-1">現在為<?=$month[$m];?></a>
  </li>

  <li class="nav-item">
    <a class="nav-link active p-2 btn btn-dark" href="index.php">輸入我的發票</a>
  </li>

  <li class="nav-item">
    <a class="nav-link active p-2 btn btn-dark" href="?do=invoice_list">發票存摺</a>
  </li>

  <li class="nav-item">
    <a class="nav-link active p-2 btn btn-dark" href="?do=add_awards">輸入開獎號碼</a>
  </li>

  <li class="nav-item">
    <a class="active p-2 btn btn-dark" href="?do=award_numbers">對獎</a>
  </li>

</ul>
</div>


     <div class="col-lg-8 col-md-12 d-flex justify-content-between p-1 mx-auto border">

         <div class="col-lg-12 col-md-12 d-flex flex-column p-0 mx-auto border">

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


 
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>