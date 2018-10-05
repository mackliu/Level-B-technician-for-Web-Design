<?
$redo=(!empty($_GET['redo']))?$_GET['redo']:"";
switch($redo){
  case "editMem":
  if(!empty($_GET['seq'])){
    $row=getData("mem",['seq'=>$_GET['seq']])->fetch();
  }

?>
<p class="fb ct">編輯會員資料</p>
<form action="api.php?do=editMem" method="post">
  <table class="all">
    <tr>
      <td class="tt ct">帳號</td>
      <td class="pp"><?=$row['acc'];?></td>
    </tr>
    <tr>
      <td class="tt ct">密碼</td>
      <td class="pp"><?=$row['pw'];?></td>
    </tr>
    <tr>
      <td class="tt ct">累積交易額</td>
      <td class="pp"><?=$row['total'];?></td>
    </tr>
    <tr>
      <td class="tt ct">姓名</td>
      <td class="pp"><input type="text" name="name" value="<?=$row['name'];?>"></td>
    </tr>
    <tr>
      <td class="tt ct">電子信箱</td>
      <td class="pp"><input type="text" name="email" value="<?=$row['email'];?>"></td>
    </tr>
    <tr>
      <td class="tt ct">地址</td>
      <td class="pp"><input type="text" name="addr" value="<?=$row['addr'];?>"></td>
    </tr>
    <tr>
      <td class="tt ct">電話</td>
      <td class="pp"><input type="text" name="tel" value="<?=$row['tel'];?>"></td>
    </tr>
  </table>

  <div class="ct">
  <input type="hidden"  name="seq" value="<?=$row['seq'];?>">
  <input type="submit" value="修改">|
  <input type="reset" value="重置">|
  <input type="button" value="取消" onclick="lof('?do=mem')">
  </div>
</form>
<?
  break;
  default:
?>
<p class="fb ct">
會員管理
</p>
<table class="all">
  <tr class="tt ct">
    <td>姓名</td>
    <td>會員帳號</td>
    <td>註冊日期</td>
    <td>操作</td>
  </tr>
  <?
  $row=getData("mem","")->fetchAll();
  foreach($row as $k => $r){
  ?>
  <tr class="pp ct">
    <td><?=$r['name'];?></td>
    <td><?=$r['acc'];?></td>
    <td><?=date("Y/m/d",strtotime($r['regdate']));?></td>
    <td>
        <button onclick="lof('?do=mem&redo=editMem&seq=<?=$r['seq'];?>')">修改</button><button onclick="del('mem',<?=$r['seq'];?>)">刪除</button>
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