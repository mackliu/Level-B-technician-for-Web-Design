<?php
if(!empty($_GET['item'])){
  $_SESSION['item'][$_GET['item']]=$_GET['qt'];
}
if(empty($_SESSION['mem'])){
  header("location:index.php?do=login");
  exit();
}
if(empty($_SESSION['item'])){
  echo "<p class='ct fb'>空的購物車</p>";
  exit();
}

?>
<p class="ct fb"><?=$_SESSION['mem'];?>的購物車</p>
<table class="all">
  <tr class="tt ct">
    <td>編號</td>
    <td>商品名稱</td>
    <td>數量</td>
    <td>庫存量</td>
    <td>單價</td>
    <td>小計</td>
    <td>刪除</td>
  </tr>
<?php
$it=array_keys($_SESSION['item']);
$cart=$_SESSION['item'];
$def=implode(',',$it);
$row=getData("item"," where seq in(".$def.")");
foreach($row as $k => $r){
  $seq=$r['seq'];
?>
  <tr class="pp ct">
    <td><?=$r['no'];?></td>
    <td style="text-align:left"><?=$r['name'];?></td>
    <td><input type='text' name='qt' id='qt' value="<?=$cart[$seq];?>" style="width:20px;"></td>
    <td><?=$r['stock'];?></td>
    <td><?=$r['price'];?></td>
    <td><?=$r['price']*$cart[$seq];?></td>
    <td>
      <img src="./icon/0415.jpg" alt="">
    </td>
  </tr>
  <?php
}
  ?>
</table>
<div class="ct">
  <img src="./icon/0411.jpg" onclick="lof('index.php')" style="cursor:pointer">
  <img src="./icon/0412.jpg" onclick="lof('?do=checkout')" style="cursor:pointer">
</div>