<? include_once "base.php";
if(empty($_SESSION['admin'])){
  header("location:index.php?do=login&redo=admin");
}else{
  $ad=getData("admin",['acc'=>$_SESSION['admin']])->fetch();
  $pr=unserialize($ad['pr']);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0057)?do=admin -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <title>┌精品電子商務網站」</title>
  <link href="./css/css.css" rel="stylesheet" type="text/css">
  <script src="./js/jquery-1.9.1.min.js"></script>
  <script src="./js/js.js"></script>
</head>

<body>
  <iframe name="back" style="display:none;"></iframe>
  <div id="main">
    <div id="top">
      <a href="index.php">
        <img src="./icon/0416.jpg">
      </a>
      <img src="./icon/0417.jpg">
    </div>
    <div id="left" class="ct">
      <div style='min-height:400px;'>
        <a href='?do=admin'>管理權限設置
        <?=(in_array(1,$pr))?"<a href='?do=th'>商品分類與管理</a>":"";?>
        <?=(in_array(2,$pr))?"<a href='?do=order'>訂單管理</a>":"";?>
        <?=(in_array(3,$pr))?"<a href='?do=mem'>會員管理</a>":"";?>
        <?=(in_array(4,$pr))?"<a href='?do=bot'>頁尾版權管理</a>":"";?>
        <?=(in_array(5,$pr))?"<a href='?do=news'>最新消息管理</a>":"";?>
        <a href="?do=logout" style="color:#f00;">登出</a>
      </div>
    </div>
    <div id="right">
    <?php
      $do=(!empty($_GET['do']))?$_GET['do']:"";
      switch($do){

        case "th":
         include "ad-th.php";
        break;
        case "order":
          include "ad-order.php";
        break;
        case "mem":
          include "ad-mem.php";
        break;
        case "bot":
          include "ad-bot.php";
        break;
        case "logout":
          unset($_SESSION['admin']);
          header("location:index.php");
        break;
        case "addItem":
          include "add-item.php";
        break;
        case "editItem":
          include "edit-item.php";
        break;
        default:
          include "ad-admin.php";
        break;
      }
      ?>      
    </div>
    <div id="bottom" style="line-height:70px; color:#FFF; background:url(./icon/bot.png);" class="ct">
      <?=getData("bot","")->fetchColumn();?> </div>
  </div>

</body>

</html>