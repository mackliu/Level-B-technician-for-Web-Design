<?php
include_once "base.php";
unset($data);
sort($_POST['seat']);
foreach($_POST as $k => $d){
  switch($k){
    case "seat":
      $data['seat']=serialize($d);
    break;
    default:
      $data[$k]=$d;
    break;
  }
}
$max=$pdo->query("select count(seq)+1 from ord where no like '".date("Ymd")."%'")->fetchColumn();
$data['no']=date("Ymd").sprintf("%04d",$max);
newData("ord",$data);
?>

<table class="bb ma br1" style="width:500px;background:#eee;padding:20px;margin-top:20px;">
      <tr>
        <td colspan="2">
          感謝您的訂購，您的訂單編號是：<?=$data['no'];?>
        </td>
      </tr>
      <tr>
        <td>電影名稱：</td>
        <td><?=$data['movie'];?></td>
      </tr>
      <tr>
        <td>日期：</td>
        <td><?=$data['date'];?></td>
      </tr>
      <tr>
        <td>場次時間：</td>
        <td><?=$data['session'];?></td>
      </tr>
      <tr>
        <td colspan="2">座位<br>
          <?
          $seat=unserialize($data['seat']);
          foreach($seat as $s){
            echo (floor($s/5)+1)."排".(($s%5)+1)."號<br>";
          }
          echo "共".$data['qt']."張電影票";
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <button onclick="lof('index.php')">確定</button>
        </td>
      </tr>
    </table>