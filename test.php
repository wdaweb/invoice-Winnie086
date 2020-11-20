<?php
include_once "base.php";

// 取得單一資料自訂函式
function find($table,$id){
  global $pdo;
  $sql="select *from $table where";
  if(!is_array($id)){

    $sql=$sql."id='$id'";

    }else{

      foreach($id as $key=>$value){
        $tmp[]=sprintf("`%s`='%s'",$key,$value);
        // $tmp[]="`".$key."`='".$value."'";
      }
      $sql=$sql.implode(' && ',$tmp); 

    }
    
    $row=$pdo->query($sql)->fetch();
    return $row;
}


// function all($table,...$arg){
//   global $pdo;
//   // gettype($arg);
//   // echo gettype($arg);

//   $sql="select * from $table";
  

//   if(is_array($arg[0])){
    
//     // 製作會在where後面的句子字串(陣列格式)
//     foreach($arg[0] as $key=>$value){
//       $tmp[]=sprintf("`%s`='%s'",$key,$value);
//       // $tmp[]="`".$key."`='".$value."'";
//     }

//     $sql=$sql."where".implode(' && ',$tmp);
  
//   }else{

//     if(!isset()){}
//     // 製作非陣列的語句接在$sql後面
//     $sql=$sql.$arg[0];
    
//   }
  
//   if(isset($arg[1])){

//     $sql=$sql.$arg[1];
  
//   }

//   echo $sql."<br>";
//   return $pdo->query($sql)->fetchAll();

// }


// echo "<hr>";
// print_r(all('invoice'));
// echo "<hr>";
// print_r(all('invoice'),['code'=>'ET','number'=>'12597846'
// ]);


function del($table,$id){
  global $pdo;
  $sql="delete from $table where";

  if(is_array($id)){

    foreach($id as $key=>$value){
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }
    $sql=$sql.implode(' && ',$tmp);
    
  }else{
    
    $sql=$sql."id='$id'";

    }
    
    // echo $sql;
    $row=$pdo->exec($sql);
    return $row;
}

$def=['code'=>'AC'];
echo del('invoice', $def);

?>