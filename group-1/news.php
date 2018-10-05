
			<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
				<marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
				<?=$pdo->query("select GROUP_CONCAT('&nbsp;&nbsp;&nbsp;',`text`) from ad WHERE sh=1 GROUP BY sh")->fetchColumn();?>
				</marquee>
				<div style="height:32px; display:block;"></div>
				<!--正中央-->
				<span class="t botli">更多最新消息區</span>
				<?php
				$all=countRows("news",['sh'=>1]);
				$div=5;
				$page=ceil($all/$div);
				$now=(!empty($_GET['p']))?$_GET['p']:1;
				$start=($now-1)*$div;
				$news=getAllData("news",3," WHERE sh=1 LIMIT $start,$div");
				?>
          <ol  style="line-height:26px;" start=<?=($start+1);?>>
          <?php
          
          foreach($news as $n){
            echo "<li class='sswww'>";
            echo mb_substr($n['text'],0,30,"utf8");
            echo "<span class='all' style='display:none;'>".$n['text']."</span>";
            echo "</li>";
          }
          ?>
					</ol>				
				<div style="text-align:center;">
				<?php
					echo (($now-1)>0)?"<a class='bl' style='font-size:30px;' href='?do=news&p=".($now-1)."'>&lt;&nbsp;</a>":"";
					for($i=1;$i<=$page;$i++){
						$font=($i==$now)?"28px":"22px";
						echo "<a href='?do=news&p=".$i."' style='font-size:".$font."'> ".$i." </a>";
					}
					echo (($now+1)<=$page)?"<a class='bl' style='font-size:30px;' href='?do=news&p=".($now+1)."'>&nbsp;&gt;</a>":"";
				?>
					
					
				</div>
			</div>
			<div id="alt" style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;"></div>
			<script>
				$(".sswww").hover(
					function () {
						$("#alt").html("<pre>" + $(this).children(".all").html() + "</pre>").css({ "top": $(this).offset().top - 50 })
						$("#alt").show()
					}
				)
				$(".sswww").mouseout(
					function () {
						$("#alt").hide()
					}
				)
			</script>