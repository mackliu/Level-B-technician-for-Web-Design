<?php
include_once "base.php";
switch($_GET['do']){
  case "addPoster":
  unset($data);
    if(!empty($_FILES['poster']['tmp_name'])){
      $poster=$_FILES['poster']['name'];
      copy($_FILES['poster']['tmp_name'],"./poster/".$poster);
      unlink($_FILES['poster']['tmp_name']);
      $data['poster']=$poster;
    }else{
      $data['poster']="";
    }
    $data['name']=$_POST['name'];
    $data['rank']=$pdo->query("select max(seq)+1 from poster")->fetchColumn();

    newData("poster",$data);
    header("location:admin.php?do=poster");
  break;
  case "editPoster":
  unset($data);
    foreach($_POST['seq'] as $k => $seq){
      if(!empty($_POST['del'.$seq])){
        delData("poster",['seq'=>$seq]);
      }else{
        $data['name']=$_POST['name'][$k];
        $data['sh']=(!empty($_POST['sh'.$seq]))?1:0;
        $data['ani']=$_POST['ani'][$k];
      }
      updateData("poster",$seq,$data);
    }
    header("location:admin.php?do=poster");
  break;
  case "del":
  unset($data);
    $table=$_POST['table'];
    $data['seq']=$_POST['seq'];
  delData($table,$data);
  break;
  case "qDel":
  unset($data);
    $table="ord";
    switch($_POST['type']){
      case "date":
        $data['date']=$_POST['date'];
      break;
      case "movie":
      $data['movie']=$_POST['movie'];
      break;
    }
    delData($table,$data);
  break;
  case "sw":
    $table=$_POST['table'];
    $row1=getData($table,['seq'=>$_POST['sw'][0]])->fetch();
    $row2=getData($table,['seq'=>$_POST['sw'][1]])->fetch();
    $rank1=$row1['rank'];
    $rank2=$row2['rank'];
    updateData($table,$row1['seq'],['rank'=>$rank2]);
    updateData($table,$row2['seq'],['rank'=>$rank1]);
  break;
  case "addMovie":
     unset($data);
     if(!empty($_FILES['poster']['tmp_name'])){
      $data['poster']=$_FILES['poster']['name'];
      copy($_FILES['poster']['tmp_name'],"./poster/".$data['poster']);
      unlink($_FILES['poster']['tmp_name']);
     }else{
       $data['poster']="";
     }
     if(!empty($_FILES['trailer']['tmp_name'])){
      $data['trailer']=$_FILES['trailer']['name'];
      copy($_FILES['trailer']['tmp_name'],"./movie/".$data['trailer']);
      unlink($_FILES['trailer']['tmp_name']);
     }else{
       $data['trailer']="";
     }
     foreach($_POST as $k =>$d){
       $data[$k]=$d;
     }
     $data['rank']=$pdo->query("select max(seq)+1 from movie")->fetchColumn();
     newData("movie",$data);
     header("location:admin.php?do=movie");
  break;
  case "editMovie":
    unset($data);
    if(!empty($_FILES['poster']['tmp_name'])){
    $data['poster']=$_FILES['poster']['name'];
    copy($_FILES['poster']['tmp_name'],"./poster/".$data['poster']);
    unlink($_FILES['poster']['tmp_name']);
    }
    if(!empty($_FILES['trailer']['tmp_name'])){
    $data['trailer']=$_FILES['trailer']['name'];
    copy($_FILES['trailer']['tmp_name'],"./movie/".$data['trailer']);
    unlink($_FILES['trailer']['tmp_name']);
    }

    foreach($_POST as $k =>$d){
      switch($k){
        case "seq":
          $seq=$d;
        break;
        default:
          $data[$k]=$d;
        break;
      }
    }
    
    updateData("movie",$seq,$data);
   header("location:admin.php?do=movie");
  break;
  case "selmovie":
    $movie=getData("movie",['seq'=>$_POST['movie']])->fetch();
    $today=strtotime(date("Y-m-d"));
    $ondate=strtotime($movie['ondate']);
    for($i=0;$i<3;$i++){
      $date=strtotime("+$i days",$ondate);
      if($date>=$today){
        echo "<option value='".date("Y-m-d",$date)."'>".date("Y-m-d",$date)."</option>";
      }
    }
  break;
  case "seldate":
    $movie=$_POST['movie'];
    $date=$_POST["date"];
    $now=date("H");
    $start=($date==date("Y-m-d") && $now>14)?floor(($now-10)/2):1;
    for($i=$start;$i<=5;$i++){
      $seat=$pdo->query("select sum(qt) from ord where movie='".$movie."' && date='".$date."' && session='".$sess[$i]."'")->fetchColumn();
      echo "<option value='".$sess[$i]."'>".$sess[$i]." 剩餘座位 ".(20-$seat)."</option>";
    }
  break;
  case "showMovie":
  unset($data);
    $seq=$_POST['seq'];
    $data['sh']=$_POST['sh'];
    updateData("movie",$seq,$data);
  break;
}