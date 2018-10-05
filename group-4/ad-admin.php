<?
$redo=(!empty($_GET['redo']))?$_GET['redo']:"";
switch($redo){
  case "addAdmin":
?>
<p class="fb ct">新增管理帳號</p>
<form action="api.php?do=addAdmin" method="post">
  <table class="all">
    <tr>
      <td class="tt ct">帳號</td>
      <td class="pp"><input type="text" name="acc" id="acc"></td>
    </tr>
    <tr>
      <td class="tt ct">密碼</td>
      <td class="pp"><input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
      <td class="tt ct">權限</td>
      <td class="pp">
      <input type="checkbox" name="pr[]" value="1">商品分類與管理<br>
      <input type="checkbox" name="pr[]" value="2">訂單管理<br>
      <input type="checkbox" name="pr[]" value="3">會員管理<br>
      <input type="checkbox" name="pr[]" value="4">頁尾版權區管理<br>
      <input type="checkbox" name="pr[]" value="5">最新消息管理<br>
      </td>
    </tr>
  </table>
  <div class="ct">
    
    <input type="submit" value="新增">|<input type="reset" value="重置">
  </div>
</form>

<?
  break;
  case "editAdmin":
  if(!empty($_GET['seq'])){
    $row=getData("admin",['seq'=>$_GET['seq']])->fetch();
    $pr=unserialize($row['pr']);
  }

?>
<p class="fb ct">修改管理員權限</p>
<form action="api.php?do=editAdmin" method="post">
  <table class="all">
    <tr>
      <td class="tt ct">帳號</td>
      <td class="pp"><input type="text" name="acc" value="<?=$row['acc'];?>"></td>
    </tr>
    <tr>
      <td class="tt ct">密碼</td>
      <td class="pp"><input type="password" name="pw" value="<?=$row['pw'];?>"></td>
    </tr>
    <tr>
      <td class="tt ct">權限</td>
      <td class="pp">
      <input type="checkbox" name="pr[]" value="1" <?=(in_array(1,$pr))?"checked":"";?>>商品分類與管理<br>
      <input type="checkbox" name="pr[]" value="2" <?=(in_array(2,$pr))?"checked":"";?>>訂單管理<br>
      <input type="checkbox" name="pr[]" value="3" <?=(in_array(3,$pr))?"checked":"";?>>會員管理<br>
      <input type="checkbox" name="pr[]" value="4" <?=(in_array(4,$pr))?"checked":"";?>>頁尾版權區管理<br>
      <input type="checkbox" name="pr[]" value="5" <?=(in_array(5,$pr))?"checked":"";?>>最新消息管理<br>
      </td>
    </tr>
  </table>

  <div class="ct">
  <input type="hidden"  name="seq" value="<?=$row['seq'];?>">
  <input type="submit" value="修改">|<input type="reset" value="重置"></div>
</form>
<?
  break;
  default:
?>
<p class="fb ct">
<button onclick="lof('admin.php?do=admin&redo=addAdmin')">新增管理員</button>
</p>
<table class="all">
  <tr class="tt ct">
    <td>帳號</td>
    <td>密碼</td>
    <td>管理</td>
  </tr>
  <?
  $row=getData("admin","")->fetchAll();
  foreach($row as $k => $r){

  ?>
  <tr class="pp ct">
    <td><?=$r['acc'];?></td>
    <td><?=str_repeat("*",strlen($r['pw']));?></td>
    <td>
    <?
      if($r['acc']=='admin'){
        echo "此帳號為最高權限";
      }else{
        ?>
        <button onclick="lof('?redo=editAdmin&seq=<?=$r['seq'];?>')">修改</button><button onclick="del('admin',<?=$r['seq'];?>)">刪除</button>
        <?
      }
    ?>
    </td>
  </tr>
  <?
  }
  ?>
</table>
<p class="ct">
  <button onclick="lof('index.php')">返回</button>
</p>
<?
  break;

}


?>