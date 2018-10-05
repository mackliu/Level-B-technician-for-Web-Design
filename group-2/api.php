<?php
include_once "base.php";

switch($_GET['do']){
  case "chkAcc":
    echo countRows("mem",['acc'=>$_POST['acc']]);
  break;
  case "chkPw":
    $chk=countRows("mem",['acc'=>$_POST['acc'],'pw'=>$_POST['pw']]);
    if($chk>0){
      echo $chk;
      $_SESSION['mem']=$_POST['acc'];
    }
  break;
  case "findPw":
    $chk=countRows("mem",['email'=>$_POST['email']]);
    if($chk>0){
      $mem=getData("mem",['email'=>$_POST['email']])->fetch();
      echo "您的密碼為：".$mem['pw'];
    }else{
      echo "查無此資料";
    }
  break;
  case "reg":
    unset($data);
    foreach($_POST as $k => $d){
        $data[$k]=$d;
    }
    newData("mem",$data);

  case "adMem":
    foreach ($_POST['del'] as $k => $d) {
      delData("mem",['seq'=>$d]);
    }
    header("location:admin.php?do=mem");
  break;
  case "adNews":
    foreach($_POST['seq'] as $k => $seq){
      if(!empty($_POST['del'.$seq])){
        delData('news',['seq'=>$seq]);
      }else{
        $show=(!empty($_POST['sh'.$seq]))?1:0;
        updateData("news",$seq,['sh'=>$show]);
      }
    }
    header("location:admin.php?do=news");
  break;
  case "adQue":
    if(!empty($_POST['subject'])){
      newData("que",['text'=>$_POST['subject']]);
    }
    $parent=$pdo->query("select max(seq) from que")->fetchColumn();
    if(!empty($_POST['option'])){
      foreach($_POST['option'] as $k => $d){
        newData("que",['text'=>$d,'parent'=>$parent]);
      }
    }
    header("location:admin.php?do=que");
  break;
  case "vote":
    countData("que","count","+1",['seq'=>$_POST['vote']]);
    countData("que","count","+1",['seq'=>$_POST['parent']]);
    header("location:index.php?do=que");
  break;
  case "getList":
    $type=$_POST['type'];
    $list=getData('news',['sh'=>1,'type'=>$type]);
    foreach($list as $l){
      echo "<a onclick='showPost(".$l['seq'].")' style='display:block'>".$l['title']."</a>";
    }
  break;
  case "showPost":
    $seq=$_POST['seq'];
    $post=getData("news",['seq'=>$seq])->fetch();
    echo json_encode(['title'=>$post['title'],'text'=>$post['text']]);

  break;
  case "good":
    switch($_POST['type']){
      case 1:
        newData("good",['acc'=>$_POST['user'],'news'=>$_POST['id']]);
        countData("news","good","+1",['seq'=>$_POST['id']]);
      break;
      case 2:
        delData("good",['acc'=>$_POST['user'],'news'=>$_POST['id']]);
        countData("news","good","-1",['seq'=>$_POST['id']]);
      break;
    }
  break;
  default:
    echo "無此項目";
  break;  
}
?>