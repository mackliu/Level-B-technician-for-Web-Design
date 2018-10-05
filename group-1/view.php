<?php
include_once "base.php";

$do=(!empty($_GET['do']))?$_GET['do']:"";
switch($do){
  case "title":
?>
<p class="cent">新增標題區圖片</p>
<hr>
<form action="api.php?do=addData" method="post" enctype="multipart/form-data">
<table style="width:65%;margin:auto">
  <tr>
    <td>標題區圖片：</td>
    <td><input type="file" name="file"></td>
  </tr>
  <tr>
    <td>標題區替代文字：</td>
    <td><input type="text" name="text" value=""></td>
  </tr>
  <tr>
    <td class="cent" colspan="2">
    <input type="hidden" name="table" value="title">
      <input type="submit" value="新增">
      <input type="reset" value="重置">
    </td>
  </tr>
</table>
</form>
<?
  break;
  case "upTitle":
  ?>
  <p class="cent">更新標題區圖片</p>
  <hr>
  <form action="api.php?do=addData" method="post" enctype="multipart/form-data">
  <table style="width:65%;margin:auto">
    <tr>
      <td>標題區圖片：</td>
      <td><input type="file" name="file"></td>
    </tr>
    <tr>
      <td>標題區替代文字：</td>
      <td><input type="text" name="text" value=""></td>
    </tr>
    <tr>
      <td class="cent" colspan="2">
      <input type="hidden" name="seq" value="<?=$_GET['seq'];?>">
      <input type="hidden" name="table" value="title">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
      </td>
    </tr>
  </table>
  </form>
  <?
  break;
  case "ad":
  ?>
  <p class="cent">新增動態文字廣告</p>
  <hr>
  <form action="api.php?do=addData" method="post" enctype="multipart/form-data">
  <table style="width:65%;margin:auto">
    <tr>
      <td>動態文字廣告：</td>
      <td><input type="text" name="text" value=""></td>
    </tr>
    <tr>
      <td class="cent" colspan="2">
      <input type="hidden" name="table" value="ad">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
      </td>
    </tr>
  </table>
  </form>
  <?
  break;
  case "mvim":
  ?>
  <p class="cent">新增動畫圖片</p>
  <hr>
  <form action="api.php?do=addData" method="post" enctype="multipart/form-data">
  <table style="width:65%;margin:auto">
    <tr>
      <td>動畫圖片：</td>
      <td><input type="file" name="file"></td>
    </tr>
    <tr>
      <td class="cent" colspan="2">
      <input type="hidden" name="seq" value="<?=$_GET['seq'];?>">
      <input type="hidden" name="table" value="mvim">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
      </td>
    </tr>
  </table>
  </form>
  <?
  break;
  case "upMvim":
  ?>
  <p class="cent">更換動畫圖片</p>
  <hr>
  <form action="api.php?do=upFile" method="post" enctype="multipart/form-data">
  <table style="width:65%;margin:auto">
    <tr>
      <td>動畫圖片：</td>
      <td><input type="file" name="file"></td>
    </tr>
    <tr>
      <td class="cent" colspan="2">
      <input type="hidden" name="table" value="mvim">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
      </td>
    </tr>
  </table>
  </form>
  <?
  break;
  case "image":
  ?>
  <p class="cent">新增校園映象圖片</p>
  <hr>
  <form action="api.php?do=addData" method="post" enctype="multipart/form-data">
  <table style="width:65%;margin:auto">
    <tr>
      <td>校園映像圖片：</td>
      <td><input type="file" name="file"></td>
    </tr>
    <tr>
      <td class="cent" colspan="2">
        <input type="hidden" name="table" value="image">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
      </td>
    </tr>
  </table>
  </form>
  <?
  break;
  case "upImage":
  ?>
  <p class="cent">更換校園映象圖片</p>
  <hr>
  <form action="api.php?do=upFile" method="post" enctype="multipart/form-data">
  <table style="width:65%;margin:auto">
    <tr>
      <td>校園映像圖片：</td>
      <td><input type="file" name="file"></td>
    </tr>
    <tr>
      <td class="cent" colspan="2">
      <input type="hidden" name="seq" value="<?=$_GET['seq'];?>">
        <input type="hidden" name="table" value="image">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
      </td>
    </tr>
  </table>
  </form>
  <?
  break;
  case "news":
  ?>
  <p class="cent">新增最新消息資料</p>
  <hr>
  <form action="api.php?do=addData" method="post" enctype="multipart/form-data">
  <table style="width:65%;margin:auto">
    <tr>
      <td >最新消息資料：</td>
      <td><textarea name="text" style="width:200px;height:80px"></textarea></td>
    </tr>
    <tr>
      <td class="cent" colspan="2">
      <input type="hidden" name="table" value="news">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
      </td>
    </tr>
  </table>
  </form>
  <?
  break;
  case "admin":
  ?>
<p class="cent">新增管理者帳號</p>
<hr>
<form action="api.php?do=addData" method="post" enctype="multipart/form-data">
<table style="width:65%;margin:auto">
  <tr>
    <td>帳號：</td>
    <td><input type="text" name="acc"></td>
  </tr>
  <tr>
    <td>密碼：</td>
    <td><input type="password" name="pw" value=""></td>
  </tr>
  <tr>
    <td>確認密碼：</td>
    <td><input type="password" name="pw2" value=""></td>
  </tr>
  <tr>
    <td class="cent" colspan="2">
    <input type="hidden" name="table" value="admin">
      <input type="submit" value="新增">
      <input type="reset" value="重置">
    </td>
  </tr>
</table>
</form>
<?
  break;
  case "menu":
  ?>
<p class="cent">新增主選單</p>
<hr>
<form action="api.php?do=addData" method="post" enctype="multipart/form-data">
<table style="width:65%;margin:auto">
  <tr>
    <td>主選單名稱：</td>
    <td><input type="text" name="text"></td>
  </tr>
  <tr>
    <td>主選單連結網址：</td>
    <td><input type="text" name="href" value=""></td>
  </tr>
  <tr>
    <td class="cent" colspan="2">
    <input type="hidden" name="table" value="menu">
      <input type="submit" value="新增">
      <input type="reset" value="重置">
    </td>
  </tr>
</table>
</form>
<?
  break;
  case "subMenu":
  ?>
<p class="cent">編輯次選單</p>
<hr>
<form action="api.php?do=editSub" method="post" enctype="multipart/form-data">
<table style="width:65%;margin:auto">
  <tr>
    <td>次選單名稱</td>
    <td>次選單連結網址</td>
    <td>刪除</td>
  </tr>
  <?php
  $row=getAlldata("menu",3," WHERE parent='".$_GET['seq']."'");
  foreach($row as $k => $r){
  ?>
  <tr>
      <td><input type="text" name="text[]" value="<?=$r['text'];?>"></td>
      <td><input type="text" name="href[]" value="<?=$r['href'];?>"></td>
      <td>
        <input type="checkbox" name="del<?=$r['seq'];?>" value="<?=$r['seq'];?>">
        <input type="hidden" name="seq[]" id="" value="<?=$r['seq'];?>">
      </td>
  </tr>
  <?php
  }
  ?>
  <tr id="ins">
    <td class="cent" colspan="3">
    <input type="hidden" name="parent" value="<?=$_GET['seq'];?>">
    <input type="hidden" name="table" value="menu">
      <input type="submit" value="修改確定">
      <input type="reset" value="重置">
      <input type="button" value="更多次選單" onclick="moreOpt()">
    </td>
  </tr>
</table>
</form>
<script>
function moreOpt(){
  let opt=`  <tr>
      <td><input type="text" name="text2[]" value=""></td>
      <td><input type="text" name="href2[]" value=""></td>
      </tr>`;
  $("#ins").before(opt);
}
</script>
<?
  break;
}
?>