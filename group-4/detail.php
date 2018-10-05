<?
include_once "base.php";
$row=getData("item",['seq'=>$_POST['seq']])->fetch();
?>
<p class="fb ct">
  <?=$row['name'];?>
</p>
<table class="all">
  <tr class="pp">
    <td class="ct" rowspan="5">
    <img src="./image/<?=$row['file'];?>" style="width:95%;max-height:300px;">
    </td>
    <td>分類:<?=$typename[$type[$row['type']]].">".$typename[$row['type']];?></td>
  </tr>
  <tr class="pp">
    <td>編號:<?=$row['no'];?></td>
  </tr>
  <tr class="pp">
    <td>價格:<?=$row['price'];?></td>
  </tr>
  <tr class="pp">
    <td>詳細說明:<?=$row['intro'];?></td>
  </tr>
  <tr class="pp">
    <td>庫存量:<?=$row['stock'];?></td>
  </tr>
  <tr class="tt ct">
    <td colspan="2">
      購買數量:
      <input type="text" name="qt" id="qt" value="1" style="width:20px">
      <img src="./icon/0402.jpg" style="cursor:pointer" onclick="buy()">
    </td>
  </tr>
</table>
<script>
function buy(){
  let qt=$("#qt").val();
  lof('?do=buycart&item=<?=$row['seq'];?>&qt='+qt+'');
}
</script>