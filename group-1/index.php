<? include_once "base.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0040)http://127.0.0.1/test/exercise/collage/? -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>卓越科技大學校園資訊系統</title>
	<link href="./css/css.css" rel="stylesheet" type="text/css">
	<script src="./js/jquery-1.9.1.min.js"></script>
	<script src="./js/js.js"></script>
</head>

<body>
	<div id="cover" style="display:none; ">
		<div id="coverr">
			<a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;" onclick="cl(&#39;#cover&#39;)">X</a>
			<div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;"></div>
		</div>
	</div>
	<iframe style="display:none;" name="back" id="back"></iframe>
	<div id="main">
		<a title="<?=$pdo->query("select text from title where sh=1")->fetchColumn();?>" href="index.php">
			<div class="ti" style="background:url(&#39;./image/<?=$pdo->query("select file from title where sh=1")->fetchColumn();?>&#39;); background-size:cover;"></div>
			<!--標題-->
		</a>
		<div id="ms">
			<div id="lf" style="float:left;">
				<div id="menuput" class="dbor">
					<!--主選單放此-->
					<span class="t botli">主選單區</span>
					<?php
					$row=getAllData("menu",1,"");
					$menu=array();
					$mtext=array();
					$mhref=array();
					foreach($row as $k => $r){
						$mtext[$r['seq']]=$r['text'];
						$mhref[$r['seq']]=$r['href'];
					}
					foreach($row as $k => $r){
						if($r['parent']!=0){
							$menu[$r['parent']][]=$r['seq'];
						}else{
							$menu[$r['seq']]=null;
						}
					}
					foreach($menu as $k =>$m){
						echo "<div class='mainmu'>";
						echo "<a href='".$mhref[$k]."'>".$mtext[$k]."</a>";
						if(!empty($m)){
							 echo "<div class='mw' style='display:none;'>";
							foreach($m as $s){
								echo "<div class='mainmu2'><a href='".$mhref[$s]."'>".$mtext[$s]."</a></div>";
							}
							echo "</div>";
						}
						echo "</div>";
					}
					?>
				</div>
				<div class="dbor" style="margin:3px; width:95%; height:20%; line-height:100px;">
					<span class="t">進站總人數 :<?=$_SESSION['total'];?></span>
				</div>
			</div>
			<? 
				$do=(!empty($_GET['do']))?$_GET['do']:"home";
				switch($do){
					case "home":
						include "home.php";
					break;
					case "login":
						include "login.php";
					break;
					case "news":
						include "news.php";
					break;
					case "logout":
					unset($_SESSION['admin']);
					header("location:index.php");
					break;
				}
				?>
			
			<div id="alt" style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;"></div>
			<script>
				$(".sswww").hover(
					function () {
						$("#alt").html("" + $(this).children(".all").html() + "").css({ "top": $(this).offset().top - 50 })
						$("#alt").show()
					}
				)
				$(".sswww").mouseout(
					function () {
						$("#alt").hide()
					}
				)
			</script>
			<div class="di di ad" style="height:540px; width:23%; padding:0px; margin-left:22px; float:left; ">
				<!--右邊-->
				<?php
					if(empty($_SESSION['admin'])){
					?>
						<button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;" onclick="lof(&#39;?do=login&#39;)">管理登入</button>
					<?
					}else{
					?>
						<button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;" onclick="lo(&#39;admin.php&#39;)">返回管理</button>
					<?
					}
				?>
				
				<div style="width:89%; height:480px;" class="dbor">
					<span class="t botli">校園映象區</span>
					<div class="cent" onclick="pp(1)"><img src="./icon/up.jpg" ></div>
					<?
						$img=getAllData("image",3," WHERE sh=1");
						foreach($img as $k => $i){
							echo "<div class='cent im' id='ssaa".$k."' >";
							echo "<img src='./image/".$i['file']."' style='width:150px;height:103px;border:2px solid orange;margin:2px auto;'>";
							echo "</div>";
						}

						?>
			
					
					<div class="cent" onclick="pp(2)"><img src="./icon/dn.jpg" ></div>
					<script>
						var nowpage = 0, num = <?=countRows('image',['sh'=>1]);?>;
						function pp(x) {
							var s, t;
							if (x == 1 && nowpage - 1 >= 0) { nowpage--; }
							if (x == 2 && (nowpage + 1) <= num - 3) { nowpage++; }
							$(".im").hide()
							for (s = 0; s <= 2; s++) {
								t = s * 1 + nowpage * 1;
								$("#ssaa" + t).show()
							}
						}
						pp(1)
					</script>
				</div>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div style="width:1024px; left:0px; position:relative; background:#FC3; margin-top:4px; height:123px; display:block;">
			<span class="t" style="line-height:123px;"><?=$pdo->query("select bottom from bottom")->fetchColumn();?></span>
		</div>
	</div>

</body>

</html>