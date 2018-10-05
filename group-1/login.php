
			<?php
				if(!empty($_POST['acc'])){
					if($_POST['acc']=='admin' && $_POST['pw']=='1234'){
						$_SESSION['admin']='admin';
						header("location:admin.php");
					}else{
						echo "<script>alert('帳號或密碼錯誤')</script>";
					}
				}
			?>
			
			<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
				<marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
				<?=$pdo->query("select GROUP_CONCAT('&nbsp;&nbsp;&nbsp;',`text`) from ad WHERE sh=1 GROUP BY sh")->fetchColumn();?>
				</marquee>
				<div style="height:32px; display:block;"></div>
				<!--正中央-->
				<form method="post" action="index.php?do=login" >
					<p class="t botli">管理員登入區</p>
					<p class="cent">帳號 ： <input name="acc" autofocus="" type="text"></p>
					<p class="cent">密碼 ： <input name="pw" type="password"></p>
					<p class="cent"><input value="送出" type="submit"><input type="reset" value="清除"></p>
				</form>
			</div>