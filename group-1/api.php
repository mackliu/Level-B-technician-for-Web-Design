<?php
include_once "base.php";

switch($_GET['do']){
  case "total":
    $table=$_POST['table'];
    $pdo->exec("update $table set total = '".$_POST['total']."'");
    $_SESSION['total']=$_POST['total'];
    header("location:admin.php?do=".$table);
  break;
  case "bottom":
    $table=$_POST['table'];
    $pdo->exec("update $table set bottom = '".$_POST['bottom']."'");
    header("location:admin.php?do=".$table);
  break;
  case "addData":
  unset($data);
  if(!empty($_FILES['file']['tmp_name'])){
    $data['file']=$_FILES['file']['name'];
    copy($_FILES['file']['tmp_name'],"./image/".$data['file']);
    unlink($_FILES['file']['tmp_name']);
  }
  foreach($_POST as $k => $d){
    switch($k){
      case "table":
      $table=$d;
      break;
      case "pw2":
      break;
      default:
      $data[$k]=$d;
      break;
    }
  }
  newData($table,$data);
  header("location:admin.php?do=".$table);
  break;
  case "editData":
  unset($data);
  $table=$_POST['table'];
  foreach($_POST['seq'] as $k => $seq){
    if(!empty($_POST['del'.$seq])){
      delData($table,['seq'=>$seq]);
    }else{
      switch($table){
        case "title":
        $data['sh']=($_POST['sh']==$seq)?1:0;
        $data["text"]=$_POST['text'][$k];
        break;
        case "admin":
        $data['acc']=$_POST['acc'][$k];
        $data['pw']=$_POST['pw'][$k];
        break;
        case "menu":
        $data['text']=$_POST['text'][$k];
        $data['href']=$_POST['href'][$k];
        break;
        default:
        $data['sh']=(!empty($_POST['sh'.$seq]))?1:0;
        $data['text']=$_POST['text'][$k];
        break;
      }
    }
    updateData($table,$seq,$data);
  }
  header("location:admin.php?do=".$table);
  break;
  case "upFile":
  unset($data);
  $table=$_POST['table'];
  $seq=$_POST['seq'];
  if(!empty($_FILES['file']['tmp_name'])){
    $data['file']=$_FILES['file']['name'];
    copy($_FILES['file']['tmp_name'],"./image/".$data['file']);
    unlink($_FILES['file']['tmp_name']);
    updateData($table,$seq,$data);
  }
  header("location:admin.php?do=".$table);
  break;
  case "editSub":
    
    $table=$_POST['table'];
    
    if(!empty($_POST['seq'])){
      unset($data);
      foreach($_POST['seq'] as $k => $seq){
        if(!empty($_POST['del'.$seq])){
          delData($table,['seq'=>$seq]);
        }else{
          $data['text']=$_POST['text'][$k];
          $data['href']=$_POST['href'][$k];
        }
        updateData($talbe,$seq,$data);
      }
    }
    if(!empty($_POST['text2'])){
      unset($data);
      $data['parent']=$_POST['parent'];
      foreach($_POST['text2'] as $k => $d){
        $data['text']=$d;
        $data['href']=$_POST['href2'][$k];
        newData($table,$data);
      }
    }
    header("location:admin.php?do=".$table);
  break;
  default:
    echo "無此項目";
  break;
}
?>