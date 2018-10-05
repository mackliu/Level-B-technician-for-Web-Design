<? include_once "base.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0039) -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <title>健康促進網</title>
  <link href="./css/css.css" rel="stylesheet" type="text/css">
  <script src="./js/jquery-1.9.1.min.js"></script>
  <script src="./js/js.js"></script>
</head>

<body>
  <div id="alerr" style="background:rgba(51,51,51,0.8); color:#FFF; min-height:100px; width:300px; position:fixed; display:none; z-index:9999; overflow:auto;">
    <pre id="ssaa"></pre>
  </div>
  <iframe name="back" style="display:none;"></iframe>
  <div id="all">
    <div id="title">
      <?=date("m 月 d 日 l");?> | 今日瀏覽: <?=$_SESSION['total'];?> | 累積瀏覽: <?=$pdo->query("select sum(total) from total")->fetchColumn();?>
    <a href="index.php" style="display:block;float:right;right:10px">回首頁</a>
    </div>
    <div id="title2">
      <a title="健康促進網-回首頁" href="index.php">
        <img src="./icon/02B01.jpg" alt="健康促進網-回首頁" style="width:100%">
        </a>
    </div>
    <div id="mm">
      <div class="hal" id="lef">
        <a class="blo" href="?do=mem">帳號管理</a>
        <a class="blo" href="?do=po">分類網誌</a>
        <a class="blo" href="?do=news">最新文章管理</a>
        <a class="blo" href="?do=know">講座管理</a>
        <a class="blo" href="?do=que">問卷管理</a>
      </div>
      <div class="hal" id="main">
        <div>
          <span style="width:78%; display:inline-block;">
          <marquee>請民眾踴躍投稿電子報，讓電子報成為大家相互交流、分享的園地！詳見最新文章</marquee>
          </span>
          <span style="width:20%; display:inline-block;">
          <?php
            if(empty($_SESSION['mem'])){
              echo "<a href='?do=login'>會員登入</a>";
            }else{
              switch($_SESSION['mem']){
                case "admin":
                  echo "歡迎，".$_SESSION['mem'];
                  echo "<br>";
                  echo "<button onclick='lof(&#39;admin.php&#39;)'>管理</button>";
                  echo "<button onclick='lof(&#39;index.php?do=logout&#39;)'>登出</button>";
                break;
                default:
                  echo "歡迎，".$_SESSION['mem'];
                  echo "<button onclick='lof(&#39;index.php?do=logout&#39;)'>登出</button>";
                break;
              }
            }
          ?>
          </span>
          <div class="content">
            <?php
            $do=(!empty($_GET['do']))?$_GET['do']:"";
            switch($do){
              case "mem":
                include "ad-mem.php";
              break;
              case "news":
                include "ad-news.php";
              break;
              case "que":
                include "ad-que.php";
              break;
              case "logout":
                unset($_SESSION['mem']);
                header("location:index.php");
              break;
              default:
                echo "<p class='bword ct'>請選擇管理項目</p>";
              break;
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <div id="bottom">
      本網站建議使用：IE9.0以上版本，1024 x 768 pixels 以上觀賞瀏覽 ， Copyright © 2018健康促進網社群平台 All Right Reserved
      <br>服務信箱：health@test.labor.gov.tw<img src="./icon/02B02.jpg" width="45">
    </div>
  </div>

</body>

</html>