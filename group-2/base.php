<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=bquiz02";
$pdo=new PDO($dsn,"root","");
session_start();
$type=[1=>"健康新知", 2=>"菸害防治", 3=>"癌症防治", 4=>"慢性病防治"];

if(empty($_SESSION['total'])){
  $chk=getData("total",['date'=>date("Y-m-d")])->fetch();
  if($chk>0){
    countData("total","total","+1",['date'=>date("Y-m-d")]);
    $total=getData("total",['date'=>date("Y-m-d")])->fetch();
    $_SESSION['total']=$total['total'];
  }else{
    newData("total",['date'=>date("Y-m-d"),'total'=>1]);
    $_SESSION['total']=1;
  }
}
 
function countRows($table,$data){
  global $pdo;
  if(is_array($data)){
    foreach($data as $k => $d){
      $str[]=sprintf("%s='%s'",$k,$d);
    }
    $sql="select count(seq) from $table where ".implode(" && ",$str);
    return $pdo->query($sql)->fetchColumn();
  }else{
    return $pdo->query("select count(seq) FROM $table ")->fetchColumn();
  }
}
function getData($table,$data){
  global $pdo;
  if(is_array($data)){
    foreach($data as $k => $d){
      $str[]=sprintf("%s='%s'",$k,$d);
    }
    $sql="select * from $table where ".implode(" && ",$str);
    return $pdo->query($sql);
  }else{
    return $pdo->query("select * FROM $table ".$data);
  }  
}
function newData($table,$data){
  global $pdo;
  $sql="insert into $table (`".implode("`,`",array_keys($data))."`) values('".implode("','",$data)."')";
  $pdo->exec($sql);
}
function updateData($table,$seq,$data){
  global $pdo;
  foreach($data as $k => $d){
    $str[]=sprintf("%s='%s'",$k,$d);
  }
  $sql="update $table set ".implode(",",$str)." where seq=$seq";
  $pdo->exec($sql);
}
function delData($table,$data){
  global $pdo;
  foreach($data as $k => $d){
    $str[]=sprintf("%s='%s'",$k,$d);
  }
  $sql="delete from $table where ".implode(" && ",$str);
  $pdo->exec($sql);
}
function countData($table,$data,$type,$def){
  global $pdo;
  $sql="update $table set $data=$data$type where ".key($def)."='".current($def)."'";
  echo $sql;
  $pdo->exec($sql);
}
?>
