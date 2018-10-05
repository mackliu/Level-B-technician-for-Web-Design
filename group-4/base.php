<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=bquiz04";
$pdo=new PDO($dsn,"root","");
session_start();


$type=array();
$typename=array();
$typecount=array();
$menu=array();
function makeType(){
  global $pdo,$type,$typename,$typecount,$menu;
  $row=getData("type","")->fetchAll();
  foreach($row as $k => $r){
    $type[$r['seq']]=$r['parent'];
    $typename[$r['seq']]=$r['name'];
    $typecount[$r['seq']]=$r['count'];
  }
  foreach($row as $k => $r){
    if($r['parent']!=0){
      $menu[$r['parent']][]=$r['seq'];
    }else{
      $menu[$r['seq']]=null;
    }
  }
}
function countType(){
  global $pdo,$type,$menu;
  foreach($type as $k => $t){
    if($t!=0){
      $data['count']=countRows("item",['type'=>$k]);
      updateData("type",$k,$data);
    }
  }
  foreach($type as $k => $t){
    if($t==0){
      $data['count']=$pdo->query("select sum(count) from type where parent='".$k."'")->fetchColumn();
      updateData("type",$k,$data);
    }
  }
}

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
  //echo $sql;
  $pdo->exec($sql);
}
function updateData($table,$seq,$data){
  global $pdo;
  foreach($data as $k => $d){
    $str[]=sprintf("%s='%s'",$k,$d);
  }
  $sql="update $table set ".implode(",",$str)." where seq=$seq";
 // echo $sql;
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
  if(is_array($def)){
    $pdo->exec("update $table set $data=$data$type where ".key($def)."='".current($def)."'");
  }else{
    $pdo->exec("update $table set $data=$data$type ".$def);
  }
}
makeType();
countType();
?>