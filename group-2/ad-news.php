<fieldset class="cent fbox" style="width:90%">
  <legend>最新文章管理</legend>
  <form action="api.php?do=adNews" method="post">
    <table class="tsb">
      <tr class="ct">
        <td>編號</td>
        <td>標題</td>
        <td>顯示</td>
        <td>刪除</td>
      </tr>
      <?php
      $all=countRows("news","");
      $div=3;
      $page=ceil($all/$div);
      $now=(!empty($_GET['p']))?$_GET['p']:1;
      $start=($now-1)*$div;
      $news=getData("news"," LIMIT $start,$div");
      foreach($news as $k => $n){
      ?>
      <tr class="ct">
        <td class="clo"><?=($k+1);?></td>
        <td width="80%"><?=$n['title'];?></td>
        <td><input type="checkbox" name="sh<?=$n['seq'];?>" value="<?=$n['seq'];?>" <?=($n['sh']==1)?"checked":"";?>></td>
        <td>
          <input type="checkbox" name="del<?=$n['seq'];?>" value="<?=$n['seq'];?>">
          <input type="hidden" name="seq[]" value="<?=$n['seq'];?>">
        </td>
      </tr>
      <?php
      }
      ?>
      <tr class="ct">
        <td colspan="4">
        <?
          echo (($now-1)>0)?"<a href='?do=news&p=".($now-1)."' style='font-size:26px'>< </a>":"";
          for($i=1;$i<=$page;$i++){
            $font=($i==$now)?"26px":"20px";
            echo "<a href='?do=news&p=".$i."' style='font-size:".$font."'> ".$i." </a>";
          }
          echo (($now+1)<=$page)?"<a href='?do=news&p=".($now+1)."' style='font-size:26px'> ></a>":"";
        ?>
        </td>
      </tr>
      <tr class="ct">
        <td colspan="4"><input type="submit" value="確定修改"></td>
      </tr>    
    </table>
  </form>
 
</fieldset>