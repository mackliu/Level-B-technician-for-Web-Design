<?
include_once "base.php";
switch($_GET['do']){
  case "addAdmin":
  unset($data);
    foreach($_POST as $k => $d){
      switch($k){
        case "pr":
          $data[$k]=serialize($d);
        break;
        default:
          $data[$k]=$d;
        break;
      }
    }
    newData("admin",$data);
    header("location:admin.php?do=admin");
  break;
  case "editAdmin":
  unset($data);
    foreach($_POST as $k => $d){
      switch($k){
        case "pr":
          $data[$k]=serialize($d);
        break;
        case "seq":
          $seq=$d;
        break;
        default:
          $data[$k]=$d;
        break;
      }
    }
    updateData("admin",$seq,$data);
    header("location:admin.php?do=admin");
  break;
  case "editMem":
  unset($data);
    foreach($_POST as $k => $d){
      switch($k){
        case "seq":
          $seq=$d;
        break;
        default:
          $data[$k]=$d;
        break;
      }
    }
    updateData("mem",$seq,$data);
    header("location:admin.php?do=mem");
  break;
  case "bot":
    $pdo->query("update bot set bot='".$_POST['bot']."'");
    header("location:admin.php?do=bot");
  break;
  case "chkAcc":

      echo $chk=countRows("mem",['acc'=>$_POST['acc']]);
  break;
  case "chkPw":
  unset($data);
  foreach($_POST as $k => $d)
  {
    switch($k){
      case "table":
        $table=$d;
      break;
      default:
        $data[$k]=$d;
      break;
    }
  }
    $chk=countRows($table,$data);
    if($chk>0){
      echo $chk;
      $_SESSION[$table]=$data['acc'];
    }

  break;
  case "chkAns":
    if($_SESSION['ans']==$_POST['ans']){
      echo 1;
    }
  break;
  case "reg":
  unset($data);
    foreach($_POST as $k => $d){
      $data[$k]=$d;
    }
    newData("mem",$data);
  break;
  case "checkout":
  unset($data);
    foreach($_POST as $k => $d){
      $data[$k]=$d;
    }
    $data['no']=date("Ymd").sprintf(100000,999999);
    $data['item']=serialize($_SESSION['item']);
    newData("ord",$data);
     unset($_SESSION['item']);
  break;
  case "addType":
    switch($_POST['type']){
      case "big":
        newData("type",['name'=>$_POST['big']]);
      break;
      case "mid":
      newData("type",['name'=>$_POST['mid'],'parent'=>$_POST['big']]);
      break;
    }
  break;
  case "onSale":
    updateData("item",$_POST['seq'],['sh'=>$_POST['show']]);
  break;
  case "editType":
    updateData("type",$_POST['seq'],['name'=>$_POST['name']]);
  break;
  case "selType":
    switch($_POST['type']){
      case "big":
        foreach($menu[$_POST['big']] as $m){
          echo "<option value='$m'>$typename[$m]</option>";
        }
      break;
      case "mid":
      $no=sprintf("%02d",$_POST['big']).sprintf("%02d",$_POST['mid']).rand(10,99);
      echo $no;

      break;
    }
  break;
  case "addItem":
  unset($data);
  if(!empty($_FILES['file']['tmp_name'])){
    $data['file']=$_FILES['file']['name'];
    copy($_FILES['file']['tmp_name'],"./image/".$data['file']);
    unlink($_FILES['file']['tmp_name']);
  }else{
    $data['file']="";
  }
    foreach($_POST as $k => $d){
      switch($k){
        case "big":
        break;
        case "mid":
          $data['type']=$d;
        break;
        default:
          $data[$k]=$d;
        break;
      }
    }
    newData("item",$data);
    header("location:admin.php?do=th");
  break;
  case "del":
    delData($_POST['table'],['seq'=>$_POST['seq']]);
  break;
  case "editItem":
  unset($data);
  if(!empty($_FILES['file']['tmp_name'])){
    $data['file']=$_FILES['file']['name'];
    copy($_FILES['file']['tmp_name'],"./image/".$data['file']);
    unlink($_FILES['file']['tmp_name']);
  }
    foreach($_POST as $k => $d){
      switch($k){
        case "big":
        break;
        case "seq":
          $seq=$d;
        break;
        case "mid":
          $data['type']=$d;
        break;
        default:
          $data[$k]=$d;
        break;
      }
    }
    updateData("item",$seq,$data);
    header("location:admin.php?do=th");
  break;
}

?>