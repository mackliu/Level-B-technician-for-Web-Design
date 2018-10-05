<?php

$do=(!empty($_GET['do']))?$_GET['do']:"title";
switch($do){
  case "title":
?>
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">網站標題管理</p>
  <form method="post"  action="api.php?do=editData">
    <table width="100%">
        <tr class="yel">
          <td width="45%">網站標題</td>
          <td width="23%">替代文字</td>
          <td width="7%">顯示</td>
          <td width="7%">刪除</td>
          <td></td>
        </tr>
     <?php
     $row=getAllData("title",1,"");
     foreach($row as $k => $r){
     ?>
        <tr class='cent'>
          <td width="45%">
            <img src="./image/<?=$r['file'];?>" style="width:300px;height:30px;">
          </td>
          <td width="23%">
            <input type="text" name="text[]" id="" value="<?=$r['text'];?>">
          </td>
          <td width="7%">
            <input type="radio" name="sh" id="" value="<?=$r['seq'];?>" <?=($r['sh']==1)?"checked":"";?>>
          </td>
          <td width="7%">
            <input type="checkbox" name="del<?=$r['seq'];?>" id="" value="<?=$r['seq'];?>">
          </td>
          <td><input type="button" onclick="op('#cover','#cvr','view.php?do=upTitle&seq=<?=$r['seq'];?>')"
              value="更新圖片">
              <input type="hidden" name="seq[]"  value="<?=$r['seq'];?>">
            </td>
        </tr>
     <?php
      }
     ?>
    </table>
    <table style="margin-top:40px; width:70%;">
        <tr>
          <td width="200px"><input type="button" onclick="op('#cover','#cvr','view.php?do=title')"
              value="新增網站標題圖片"></td>
          <td class="cent">
            <input type="hidden" name="table" value="title">
            <input type="submit" value="修改確定">
            <input type="reset" value="重置">
          </td>
        </tr>
    </table>
  </form>
</div>
<?
  break;
  case "ad":
  ?>
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">動態文字廣告管理</p>
  <form method="post"  action="api.php?do=editData">
    <table width="100%">
        <tr class="yel">
          <td width="80%">動態文字廣告</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
        </tr>
        <?php
     $row=getAllData("ad",1,"");
     foreach($row as $k => $r){
     ?>
        <tr class="cent">
          <td width="80%">
          <input type="text" name="text[]" id="" value="<?=$r['text'];?>" style="width:95%">
          </td>
          <td width="10%">
          <input type="checkbox" name="sh<?=$r['seq'];?>" id="" value="<?=$r['seq'];?>" <?=($r['sh']==1)?"checked":"";?>>
          </td>
          <td width="10%">
          <input type="checkbox" name="del<?=$r['seq'];?>" id="" value="<?=$r['seq'];?>">
          <input type="hidden" name="seq[]"  value="<?=$r['seq'];?>">
          </td>
        </tr>
     <?php
      }
     ?>        
    </table>
    <table style="margin-top:40px; width:70%;">
    <tr>
          <td width="200px"><input type="button" onclick="op('#cover','#cvr','view.php?do=ad')"
              value="新增動態文字廣告"></td>
          <td class="cent">
            <input type="hidden" name="table" value="ad">
            <input type="submit" value="修改確定">
            <input type="reset" value="重置">
          </td>
        </tr>
    </table>
  </form>
</div>
  <?
  break;
  case "mvim":
  ?>
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">動畫圖片輪播管理</p>
  <form method="post"  action="api.php?do=editData">
    <table width="100%">
        <tr class="yel">
          <td width="70%">動畫圖片</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
          <td></td>
        </tr>
        <?php
     $row=getAllData("mvim",1,"");
     foreach($row as $k => $r){
     ?>
        <tr class="cent">
          <td width="70%">
          <embed src="./image/<?=$r['file'];?>" style="width:120px;height:80px">  
          </td>
          <td width="10%">
          <input type="checkbox" name="sh<?=$r['seq'];?>" id="" value="<?=$r['seq'];?>" <?=($r['sh']==1)?"checked":"";?>>
          </td>
          <td width="10%">
          <input type="checkbox" name="del<?=$r['seq'];?>" id="" value="<?=$r['seq'];?>">
          </td>
          <td><input type="button" onclick="op('#cover','#cvr','view.php?do=upMvim&seq=<?$r['seq'];?>')"  value="更換動畫">
          <input type="hidden" name="seq[]"  value="<?=$r['seq'];?>">
        </td>
        </tr>
     <?php
      }
     ?>        
    </table>
    <table style="margin-top:40px; width:70%;">
        <tr>
          <td width="200px"><input type="button" onclick="op('#cover','#cvr','view.php?do=mvim')"
              value="新增動畫圖片"></td>
          <td class="cent">
            <input type="hidden" name="table" value="mvim">
            <input type="submit" value="修改確定">
            <input type="reset" value="重置">
          </td>
        </tr>
    </table>
  </form>
</div>
  <?
  break;
  case "image":
  ?>
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">校園映像資料管理</p>
  <form method="post"  action="api.php?do=editData">
    <table width="100%">
        <tr class="yel">
          <td width="70%">校園映像資料圖片</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
          <td></td>
        </tr>
        <?php
        				$all=countAllRows("image");
                $div=3;
                $page=ceil($all/$div);
                $now=(!empty($_GET['p']))?$_GET['p']:1;
                $start=($now-1)*$div;
     $row=getAllData("image",3," LIMIT $start,$div");
     foreach($row as $k => $r){
     ?>
        <tr class="cent">
          <td width="70%">
          <img src="./image/<?=$r['file'];?>" style="width:100px;height:63px">
          </td>
          <td width="10%">
          <input type="checkbox" name="sh<?=$r['seq'];?>" id="" value="<?=$r['seq'];?>" <?=($r['sh']==1)?"checked":"";?>>
          </td>
          <td width="10%">
          <input type="checkbox" name="del<?=$r['seq'];?>" id="" value="<?=$r['seq'];?>">
          </td>
          <td><input type="button" onclick="op('#cover','#cvr','view.php?do=upImage&seq=<?=$r['seq'];?>')" value="更換圖片">
          <input type="hidden" name="seq[]"  value="<?=$r['seq'];?>">
        </td>
        </tr>
     <?php
      }
     ?>
     <tr class='cent'>
      <td>
        <?php
					echo (($now-1)>0)?"<a class='bl' style='font-size:28px;' href='?do=image&p=".($now-1)."'>&lt;&nbsp;</a>":"";
					for($i=1;$i<=$page;$i++){
						$font=($i==$now)?"28px":"22px";
						echo "<a class='bl' href='?do=image&p=".$i."' style='font-size:".$font."'> ".$i." </a>";
					}
					echo (($now+1)<=$page)?"<a class='bl' style='font-size:30px;' href='?do=image&p=".($now+1)."'>&nbsp;&gt;</a>":"";
        ?>
      </td>
     </tr>             
    </table>
    <table style="margin-top:40px; width:70%;">
        <tr>
          <td width="200px"><input type="button" onclick="op('#cover','#cvr','view.php?do=image')"
              value="新增校園映像圖片"></td>
          <td class="cent">
            <input type="hidden" name="table" value="image">
            <input type="submit" value="修改確定">
            <input type="reset" value="重置">
          </td>
        </tr>
    </table>
  </form>
</div>
  <?
  break;
  case "total":
  ?>
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">進站總人數管理</p>
  <form method="post"  action="api.php?do=total">
    <table width="50%" style="margin:auto;">
        <tr class="yel">
          <td width="45%">進站總人數：</td>
          <td width="23%"><input type="text" name="total"  value="<?=$pdo->query("select total from total")->fetchColumn();?>"></td>
        </tr>
    </table>
    <table style="margin:40px auto 0 auto; width:50%;">
        <tr>
          <td class="cent">
            <input type="hidden" name="table" value="total">
            <input type="submit" value="修改確定">
            <input type="reset" value="重置">
          </td>
        </tr>
    </table>
  </form>
</div>
  <?
  break;
  case "bottom":
  ?>
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">頁尾版權資料管理</p>
  <form method="post"  action="api.php?do=bottom">
    <table width="50%" style="margin:auto;">
        <tr class="yel">
          <td width="45%">頁尾版權資料：</td>
          <td width="23%"><input type="text" name="bottom"  value="<?=$pdo->query("select bottom from bottom")->fetchColumn();?>"></td>
        </tr>
    </table>
    <table style="margin:40px auto 0 auto; width:50%;">
        <tr>
          <td class="cent">
            <input type="hidden" name="table" value="bottom">
            <input type="submit" value="修改確定">
            <input type="reset" value="重置">
          </td>
        </tr>
    </table>
  </form>
</div>
  <?
  break;
  case "news":
  ?>
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">最新消息資料管理</p>
  <form method="post"  action="api.php?do=editData">
    <table width="100%">
        <tr class="yel">
          <td width="80%">最新消息資料內容</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
        </tr>
        <?php
        				$all=countAllRows("news");
                $div=4;
                $page=ceil($all/$div);
                $now=(!empty($_GET['p']))?$_GET['p']:1;
                $start=($now-1)*$div;
     $row=getAllData("news",3," LIMIT $start,$div");
     foreach($row as $k => $r){
     ?>
        <tr class="cent">
          <td width="80%">
            <textarea name="text[]" style="width:95%;height:70px;"><?=$r['text'];?></textarea>
          </td>
          <td width="10%">
          <input type="checkbox" name="sh<?=$r['seq'];?>" id="" value="<?=$r['seq'];?>" <?=($r['sh']==1)?"checked":"";?>>
          </td>
          <td width="10%">
          <input type="checkbox" name="del<?=$r['seq'];?>" id="" value="<?=$r['seq'];?>">
          <input type="hidden" name="seq[]"  value="<?=$r['seq'];?>">
          </td>
        </tr>
     <?php
      }
     ?>
     <tr class='cent'>
      <td>
        <?php
					echo (($now-1)>0)?"<a class='bl' style='font-size:28px;' href='?do=news&p=".($now-1)."'>&lt;&nbsp;</a>":"";
					for($i=1;$i<=$page;$i++){
						$font=($i==$now)?"28px":"22px";
						echo "<a class='bl' href='?do=news&p=".$i."' style='font-size:".$font."'> ".$i." </a>";
					}
					echo (($now+1)<=$page)?"<a class='bl' style='font-size:30px;' href='?do=news&p=".($now+1)."'>&nbsp;&gt;</a>":"";
        ?>
      </td>
     </tr>
    </table>
    <table style="margin-top:40px; width:70%;">
    <tr>
          <td width="200px"><input type="button" onclick="op('#cover','#cvr','view.php?do=news')"
              value="新增最新消息資料"></td>
          <td class="cent">
            <input type="hidden" name="table" value="news">
            <input type="submit" value="修改確定">
            <input type="reset" value="重置">
          </td>
        </tr>
    </table>
  </form>
</div>
  <?
  break;
  case "admin":
  ?>
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">管理者帳號管理</p>
  <form method="post"  action="api.php?do=editData">
    <table width="100%">
        <tr class="yel">
          <td width="45%">帳號</td>
          <td width="45%">密碼</td>
          <td width="10%">刪除</td>
        </tr>
        <?php
     $row=getAllData("admin",1,"");
     foreach($row as $k => $r){
     ?>
        <tr class="cent">
          <td width="45%">
            <input type="text" name="acc[]"  value="<?=$r['acc'];?>">
          </td>
          <td width="45%">
            <input type="password" name="pw[]" id="" value="<?=$r['pw'];?>">
          </td>
          <td width="10%">
          <input type="checkbox" name="del<?=$r['seq'];?>" id="" value="<?=$r['seq'];?>">
          <input type="hidden" name="seq[]"  value="<?=$r['seq'];?>">
          </td>
        </tr>
     <?php
      }
     ?>        
    </table>
    <table style="margin-top:40px; width:70%;">
    <tr>
          <td width="200px"><input type="button" onclick="op('#cover','#cvr','view.php?do=admin')"
              value="新增管理者帳號"></td>
          <td class="cent">
            <input type="hidden" name="table" value="admin">
            <input type="submit" value="修改確定">
            <input type="reset" value="重置">
          </td>
        </tr>
    </table>
  </form>
</div>
  <?
  break;
  case "menu":
  ?>
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">選單管理</p>
  <form method="post"  action="api.php?do=editData">
    <table width="100%">
        <tr class="yel">
          <td width="30%">主選單名稱</td>
          <td width="30%">選單連結網址</td>
          <td width="10%">次選單數</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
          <td></td>
        </tr>
        <?php
     $row=getAllData("menu",3," WHERE parent=0");
     foreach($row as $k => $r){
     ?>
        <tr class="cent">
          <td width="30%">
            <input type="text" name="text[]" value="<?=$r['text'];?>">
          </td>
          <td width="30%">
            <input type="text" name="href[]" value="<?=$r['href'];?>">
          </td>
          <td width="10%">
            <?=$pdo->query("select count(seq) from menu where parent='".$r['seq']."'")->fetchColumn();?>
          </td>
          <td width="10%">
          <input type="checkbox" name="sh<?=$r['seq'];?>" id="" value="<?=$r['seq'];?>" <?=($r['sh']==1)?"checked":"";?>>
          </td>
          <td width="10%">
          <input type="checkbox" name="del<?=$r['seq'];?>" id="" value="<?=$r['seq'];?>">
          <input type="hidden" name="seq[]"  value="<?=$r['seq'];?>">
          </td>
          <td><input type="button" onclick="op('#cover','#cvr','view.php?do=subMenu&seq=<?=$r['seq'];?>')" value="編輯次選單"></td>
        </tr>
     <?php
      }
     ?>        
    </table>
    <table style="margin-top:40px; width:70%;">
        <tr>
          <td width="200px"><input type="button" onclick="op('#cover','#cvr','view.php?do=menu')"
              value="新增主選單"></td>
          <td class="cent">
            <input type="hidden" name="table" value="menu">
            <input type="submit" value="修改確定">
            <input type="reset" value="重置">
          </td>
        </tr>
    </table>
  </form>
</div>
  <?
  break;
  
}
?>

