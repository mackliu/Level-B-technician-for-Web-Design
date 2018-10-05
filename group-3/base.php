<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=bquiz03";
$pdo=new PDO($dsn,"root","");
session_start();

$level=[ 1=>"普遍級", 2=>"輔導級", 3=>"保護級", 4=>"限制級" ];
$sess=[ 1=>"14:00~16:00", 2=>"16:00~18:00", 3=>"18:00~20:00", 4=>"20:00~22:00", 5=>"22:00~24:00", ];
function countRows($table,$data){
  global $pdo;
  if(is_array($data)){
    foreach($data as $k => $d){
      $str[]=sprintf("%s='%s'",$k,$d);
    }
    return $pdo->query("select count(seq) from $table where ".implode(" && ",$str))->fetchColumn();
  }else{
    return $pdo->query("select count(seq) from $table ".$data)->fetchColumn();
  }
}
function getData($table,$data){
  global $pdo;
  if(is_array($data)){
    foreach($data as $k => $d){
      $str[]=sprintf("%s='%s'",$k,$d);
    }
    return $pdo->query("select * from $table where ".implode(" && ",$str));
  }else{
    return $pdo->query("select * from $table ".$data);
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
  echo $sql;
  $pdo->exec($sql);
}
function delData($table,$data){
  global $pdo;
  foreach($data as $k => $d){
    $str[]=sprintf("%s='%s'",$k,$d);
  }
  $pdo->exec("delete from $table where ".implode(" && ",$str));
}
function countData($table,$data,$type,$def){
  global $pdo;
  $pdo->exec("update $table set $data=$data$type where ".key($def)."='".current($def)."'");
}

?>