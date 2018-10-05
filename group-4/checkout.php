<p class="ct fb">填寫資料</p>
<?php
$user=getData("mem",['acc'=>$_SESSION['mem']])->fetch();
?>
<table class="all">
  <tr>
    <td class="tt ct">登入帳號</td>
    <td class="pp" colspan="4"><?=$user['acc'];?></td>
  </tr>
  <tr>
    <td class="tt ct">姓名</td>
    <td class="pp" colspan="4">
      <input type='text' name="name"  id="name" value="<?=$user['name'];?>">
    </td>
  </tr>
  <tr>
    <td class="tt ct">電子信箱</td>
    <td class="pp" colspan="4">
      <input type='text' name="email"  id="email" value="<?=$user['email'];?>">
    </td>
  </tr>
  <tr>
    <td class="tt ct">聯絡地址</td>
    <td class="pp" colspan="4">
      <input type='text' name="addr"  id="addr" value="<?=$user['addr'];?>">
    </td>
  </tr>
  <tr>
    <td class="tt ct">聯絡電話</td>
    <td class="pp" colspan="4">
      <input type='text' name="tel" id="tel" value="<?=$user['tel'];?>"></td>
  </tr>
  <tr class="tt ct">
    <td>編號</td>
    <td>商品名稱</td>
    <td>數量</td>
    <td>單價</td>
    <td>小計</td>
  </tr>
  <?php
$it=array_keys($_SESSION['item']);
$cart=$_SESSION['item'];
$def=implode(',',$it);
$row=getData("item"," where seq in(".$def.")");
$sum=0;
foreach($row as $k => $r){
  $seq=$r['seq'];
  $sum=$sum+$r['price']*$cart[$seq];
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
      <?=$sum;?>
    </td>
  </tr>
</table>
<div class="ct">
  <button onclick="checkout()">確定送出</button>
  <button onclick="lof('index.php?do=buycart')">返回修改訂單</button>
</div>
<script>
function checkout(){
  let name=$("#name").val()
  let email=$("#email").val()
  let addr=$("#addr").val()
  let tel=$("#tel").val()
  $.post("api.php?do=checkout",{name,email,addr,tel,"acc":"<?=$_SESSION['mem'];?>","total":<?=$sum;?>},function(){
    alert("訂購成功\n感謝您的選購")
    lof("index.php")
  })
}
</script>