<div class="bb ma " style="width:70%;background:#eee;border:3px solid #aaa;padding:5px;">
  <div class="bb ct ma w100 br1" style="line-height:30px;color:white;background:#666">
    修改電影資料
  </div>
<?php
if(!empty($_GET['seq'])){
  $movie=getData("movie",['seq'=>$_GET['seq']])->fetch();
}
?>
  <form action="api.php?do=editMovie" method="post" enctype="multipart/form-data">
    <table class="bb ma w100" >
      <tr>
        <td width="100px" style="vertical-align:top">影片資料</td>
        <td>
          <table class="bb ma w100" style="background:#bbb;padding:5px 0 5px 10px">
            <tr>
              <td width="100px">片　　名：</td>
              <td>
                <input type="text" name="name" style="width:95%" value="<?=$movie['name'];?>">
              </td>
            </tr>
            <tr>
              <td>分　　級：</td>
              <td>
                <select name="level" >
                  <option value="1" <?=($movie['level']==1)?"selected":"";?>>普遍級</option>
                  <option value="2" <?=($movie['level']==2)?"selected":"";?>>輔導級</option>
                  <option value="3" <?=($movie['level']==3)?"selected":"";?>>保護級</option>
                  <option value="4" <?=($movie['level']==4)?"selected":"";?>>限制級</option>
                </select>(請選擇分級)
              </td>
            </tr>
            <tr>
              <td>片　　長：</td>
              <td>
                <input type="text" name="length" style="width:95%" value="<?=$movie['length'];?>">
              </td>
            </tr>
            <tr>
              <td>上映日期：</td>
              <td>
                <input type="date" name="ondate" style="width:95%" value="<?=$movie['ondate'];?>">
              </td>
            </tr>
            <tr>
              <td>發 行 商：</td>
              <td>
                <input type="text" name="publish" style="width:95%" value="<?=$movie['publish'];?>">
              </td>
            </tr>
            <tr>
              <td>導　　演：</td>
              <td>
                <input type="text" name="director" style="width:95%" value="<?=$movie['director'];?>">
              </td>
            </tr>
            <tr>
              <td>預告影片：</td>
              <td>
                <input type="file" name="trailer" value="">
                <div style="color:red;font-size:12px">檔案請使用英文檔名</div>
              </td>
            </tr>
            <tr>
              <td>電影海報：</td>
              <td>
                <input type="file" name="poster" value="">
                <div style="color:red;font-size:12px">檔案請使用英文檔名</div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="vertical-align:top">劇情簡介</td>
        <td><textarea name="intro" style="width:95%;height:50px;"><?=$movie['intro'];?></textarea></td>
      </tr>
    </table>
    <hr>
    <div class="ct">
      <input type="hidden" name="seq" value="<?=$movie['seq'];?>">
      <input type="submit" value="修改">
      <input type="reset" value="重置">
    </div>    
  </form>
</div>
