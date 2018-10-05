<? include_once "base.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0039) -->
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
      <a href="?">
        <img src="./icon/0416.jpg">
      </a>
      <div style="padding:10px;">
        <a href="?">回首頁</a> |
        <a href="?do=news">最新消息</a> |
        <a href="?do=look">購物流程</a> |
        <a href="?do=buycart">購物車</a> |
        <?
        if(empty($_SESSION['mem'])){
          echo "<a href='?do=login'>會員登入</a> |";
        }else{
          echo "<a href='?do=logout'>登出</a> |";
        }
        ?>
        <?
        if(empty($_SESSION['admin'])){
          echo "<a href='?do=admin'>管理登入</a>";
        }else{
          echo "<a href='?do=admin'>返回管理</a>";
        }
        ?>
        
        
      </div>
      <marquee>情人節特惠活動 &nbsp; 年終特賣會開跑了></marquee>
    </div>
    <div id="left" class="ct">
      <div style="min-height:400px;">
        <div class="ww"><a href="?">全部商品</a></div>
        <?
        foreach($menu as $k => $m){
          echo "<div class='ww'>";
          echo "<a href='?type=".$k."'>".$typename[$k]."</a>";
          if(!empty($m)){
            echo "<div class='s'>";
            foreach($m as $s){
              echo "<div>";
              echo "<a href='?type=".$s."' style='background:skyblue;position:relative;left:20px;'>".$typename[$s]."</a>";
              echo "</div>";
            }
            echo "</div>";
          }
          echo "</div>";
        }

        ?>


      </div>
      <span>
        <div>進站總人數</div>
        <div style="color:#f00; font-size:28px;">
          00005 </div>
      </span>
    </div>
    <div id="right">
      <?php
      $do=(!empty($_GET['do']))?$_GET['do']:"home";
      switch($do){
        case "home":
          include "home.php";
        break;
        case "look":
          echo "<img src='./icon/0401.jpg' style='display:block;margin:20px auto 0 auto'>";
        break;
        case "buycart":
          include "buycart.php";
        break;
        case "login":
          include "login.php";
        break;
        case "news":
          include "news.php";
        break;
        case "reg":
        include "reg.php";
        break;
        case "checkout":
          include "checkout.php";
        break;
        case "admin";
          header("location:admin.php");
        break;
      }
      ?>
    </div>
    <div id="bottom" style="line-height:70px;background:url(./icon/bot.png); color:#FFF;" class="ct">
    <?=getData("bot","")->fetchColumn();?> </div>
  </div>

</body>

</html>