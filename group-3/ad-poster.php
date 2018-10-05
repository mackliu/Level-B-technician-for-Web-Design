<div class="bb ma w100" style="background:#eee;border:3px solid #aaa;padding:5px;">
  <div class="bb ct ma w100 br1" style="line-height:30px;color:white;background:#666">
    預告片清單
  </div>
  <table class="bb ct ma w100" style="background:#bbb;margin:3px auto;">
    <tr>
      <td width="25%">預告片海報</td>
      <td width="25%">預告片片名</td>
      <td width="25%">預告片排序</td>
      <td>操作</td>
    </tr>
  </table>
  <form action="api.php?do=editPoster" method="post">
    <div class="bb ma w100 ct" style="height:220px;overflow:auto">
    <?php
    $row=getData("poster"," order by rank")->fetchAll();
    foreach($row as $k => $r){
    ?>
    <table class="bb ma w100" style="background:#fff;margin:5px auto;">
      <tr>
        <td><img src='./poster/<?=$r['poster'];?>' style='width:80px;height:100px'></td>
        <td><input type='text' name='name[]' value='<?=$r['name'];?>'></td>
        <td>
          <input type="button" value="往上" onclick="sw('poster',this)" sw=<?=($k>0)?$r['seq']."-".$row[$k-1]['seq']:$r['seq']."-".$r['seq'];?>><br>
          <input type="button" value="往下" onclick="sw('poster',this)" sw=<?=($k<(count($row)-1))?$r['seq']."-".$row[$k+1]['seq']:$r['seq']."-".$r['seq'];?>>
        </td>
        <td>
          <input type="checkbox" name="sh<?=$r['seq'];?>" value="<?=$r['seq'];?>" <?=($r['sh']==1)?"checked":"";?>>顯示
          <input type="checkbox" name="del<?=$r['seq'];?>" value="<?=$r['seq'];?>">刪除
          <select name="ani[]" >
            <option value="1" <?=($r['ani']==1)?"selected":"";?>>淡入淡出</option>
            <option value="2" <?=($r['ani']==2)?"selected":"";?>>滑入滑出</option>
            <option value="3" <?=($r['ani']==3)?"selected":"";?>>縮放</option>
          </select>
          <input type="hidden" name="seq[]" value="<?=$r['seq'];?>">
        </td>
      </tr>
    </table>
    <?php
    }
    ?>
    </div>
    <div class="ct">
      <input type="submit" value="編輯確定">
      <input type="reset" value="重置">
    </div>
  </form>
</div>
<hr>
<div class="bb ma w100" style="background:#eee;border:3px solid #aaa;padding:5px;">
  <div class="bb ct ma w100 br1" style="line-height:30px;color:white;background:#666">
    新增預告片海報
  </div>
  <form action="api.php?do=addPoster" method="post" enctype="multipart/form-data">
    <table class="bb ma w100" style="margin-top:5px;background:#aaa;padding:5px">
      <tr>
        <td width="15%">預告片海報：</td>
        <td width="35%"><input type="file" name="poster"></td>
        <td width="15%">預告片片名：</td>
        <td width="35%"><input type="text" name="name"></td>
      </tr>
      <tr class="ct">
        <td colspan="4"><input type="submit" value="新增"><input type="reset" value="重罝"></td>
      </tr>
    </table>
  </form>
</div>