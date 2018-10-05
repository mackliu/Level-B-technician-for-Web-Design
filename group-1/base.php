<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=bquiz01";
$pdo=new PDO($dsn,"root","");

session_start();

if(empty($_SESSION['total'])){
  countData('total',1,"total","");
  $_SESSION['total']=$pdo->query("select total from total")->fetchColumn();
}

function countRows($table,$data){
  global $pdo;
  $sql="select count(seq) from $table WHERE ".key($data)."='".current($data)."'";
  //echo $sql;
  return $pdo->query($sql)->fetchColumn();
}
function countAllRows($table){
  global $pdo;
  return $pdo->query("select count(seq) from $table ")->fetchColumn();
}
function getData($table,$data){
  global $pdo;
  return $pdo->query("select * from $table WHERE ".key($data)."='".current($data)."'")->fetch();
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
  echo $sql;
  echo "<br>";
  $pdo->exec($sql);
}
function delData($table,$data){
  global $pdo;
  $pdo->exec("delete from $table where ".key($data)."='".current($data)."'");
}
function getAllData($table,$type,$data){
  global $pdo;
  switch($type){
    case 1:
    return $pdo->query("select * from $table ")->fetchAll();
    break;
    case 2:
    return $pdo->query("select * from $table WHERE ".key($data)."='".current($data)."'")->fetchAll();
    break;
    case 3:
    return $pdo->query("select * from $table ".$data)->fetchAll();
    break;
  }  
}
function countData($table,$type,$data,$def){
  global $pdo;
  switch($type){
    case 1:
    $pdo->exec("update $table set $data=$data+1");
    break;
    case 2:
    $pdo->exec("update $table set $data=$data+1 where ".key($data)."='".current($data)."'");
    break;
  }
}



?>