<?
if(!empty($_GET['type'])){
  $tt=$_GET['type'];
  if($type[$tt]==0){
    $nav=$typename[$tt];
    $def=" && type IN(".implode(",",$menu[$tt]).")";
  }else{
    $nav=$typename[$type[$tt]]." > ".$typename[$tt];
    $def=" && type='".$tt."'";
  }
}else{
  $nav="全部商品";
  $def="";
}
?>
<p class="fb"><?=$nav;?></p>

<table class="all">
<?
$row=getData("item"," where sh=1".$def)->fetchAll();
foreach($row as $k => $r){
?>
  <tr class="ct">
    <td rowspan="4" width="40%" class="pp">
      <a href="javascript:$('#right').load('detail.php',{'seq':<?=$r['seq'];?>})">
      <img src="./image/<?=$r['file'];?>" style="width:85%;max-height:200px;">
      </a>
    </td>
    <td class="tt">
      <?=$r['name'];?>
    </td>
  </tr>
  <tr class="pp">
    <td>價錢:<?=$r['price'];?>
    <img src="./icon/0402.jpg" style="cursor:pointer;float:right;right:10px;" onclick="lof('?do=buycart&item=<?=$r['seq'];?>&qt=1')">
    </td>
  </tr>
  <tr class="pp"><td>規格:<?=$r['spec'];?></td></tr>
  <tr class="pp"><td>簡介:<?=mb_substr($r['intro'],0,20,"utf8");?>...</td></tr>
  <?
  }
  ?>
</table>