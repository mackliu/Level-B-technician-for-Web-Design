<?
$redo=(!empty($_GET['redo']))?$_GET['redo']:"";
switch($redo){
  case "orderDetail":
  if(!empty($_GET['seq'])){
    $user=getData("ord",['seq'=>$_GET['seq']])->fetch();
  }

?>
<p class="fb ct" >訂單編號<span style="color:red"><?=$user['no'];?></span>的詳細資料</p>

  <table class="all">
  <tr>
    <td class="tt ct">登入帳號</td>
    <td class="pp" colspan="4">
      <?=$user['acc'];?>
    </td>
  </tr>
  <tr>
    <td class="tt ct">姓名</td>
    <td class="pp" colspan="4">
      <?=$user['name'];?>
    </td>
  </tr>
  <tr>
    <td class="tt ct">電子信箱</td>
    <td class="pp" colspan="4">
     <?=$user['email'];?>
    </td>
  </tr>
  <tr>
    <td class="tt ct">聯絡地址</td>
    <td class="pp" colspan="4">
      <?=$user['addr'];?>
    </td>
  </tr>
  <tr>
    <td class="tt ct">聯絡電話</td>
    <td class="pp" colspan="4">
      <?=$user['tel'];?>
    </td>
  </tr>
  <tr class="tt ct">
    <td>編號</td>
    <td>商品名稱</td>
    <td>數量</td>
    <td>單價</td>
    <td>小計</td>
  </tr>
  <?php
$cart=unserialize($user['item']);
$it=array_keys($cart);
$def=implode(',',$it);
$row=getData("item"," where seq in(".$def.")");
foreach($row as $k => $r){
  $seq=$r['seq'];
?>
  <tr class="pp ct">
    <td>
      <?=$r['name'];?>
    </td>
    <td>
      <?=$r['no'];?>
    </td>
    <td>
      <?=$cart[$seq];?>
    </td>
    <td>
      <?=$r['price'];?>
    </td>
    <td>
      <?=$r['price']*$cart[$seq];?>
    </td>
  </tr>
  <?php
}
  ?>
  <tr class="tt ct">
    <td colspan="5">總價:
      <?=$user['total'];?>
    </td>
  </tr>
  </table>
  <div class="ct">
  <input type="button" value="返回" onclick="lof('?do=order')">
  </div>

<?
  break;
  default:
?>
<p class="fb ct">
訂單管理
</p>
<table class="all">
  <tr class="tt ct">
    <td>訂單編號</td>
    <td>金額</td>
    <td>會員帳號</td>
    <td>姓名</td>
    <td>下單日期</td>
    <td>操作</td>
  </tr>
  <?
  $row=getData("ord","")->fetchAll();
  foreach($row as $k => $r){
  ?>
  <tr class="pp ct">
    <td style="cursor:pointer" onclick="lof('admin.php?do=order&redo=orderDetail&seq=<?=$r['seq'];?>')"><?=$r['no'];?></td>
    <td><?=$r['total'];?></td>
    <td><?=$r['acc'];?></td>
    <td><?=$r['name'];?></td>
    <td><?=date("Y/m/d",strtotime($r['date']));?></td>
    <td>
        <button onclick="del('ord',<?=$r['seq'];?>)">刪除</button>
    </td>
  </tr>
  <?
  }
  ?>
</table>
<?
  break;
}


?>