<div class="bb ma " style="width:70%;background:#eee;border:3px solid #aaa;padding:5px;">
  <div class="bb ct ma w100 br1" style="line-height:30px;color:white;background:#666">
    新增院線片
  </div>

  <form action="api.php?do=addMovie" method="post" enctype="multipart/form-data">
    <table class="bb ma w100" >
      <tr>
        <td width="100px" style="vertical-align:top">影片資料</td>
        <td>
          <table class="bb ma w100" style="background:#bbb;padding:5px 0 5px 10px">
            <tr>
              <td width="100px">片　　名：</td>
              <td>
                <input type="text" name="name" style="width:95%">
              </td>
            </tr>
            <tr>
              <td>分　　級：</td>
              <td>
                <select name="level" >
                  <option value="1">普遍級</option>
                  <option value="2">輔導級</option>
                  <option value="3">保護級</option>
                  <option value="4">限制級</option>
                </select>(請選擇分級)
              </td>
            </tr>
            <tr>
              <td>片　　長：</td>
              <td>
                <input type="text" name="length" style="width:95%">
              </td>
            </tr>
            <tr>
              <td>上映日期：</td>
              <td>
                <input type="date" name="ondate" style="width:95%">
              </td>
            </tr>
            <tr>
              <td>發 行 商：</td>
              <td>
                <input type="text" name="publish" style="width:95%">
              </td>
            </tr>
            <tr>
              <td>導　　演：</td>
              <td>
                <input type="text" name="director" style="width:95%">
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
        <td><textarea name="intro" style="width:95%;height:50px;"></textarea></td>
      </tr>
    </table>
    <hr>
    <div class="ct">
      <input type="submit" value="新增">
      <input type="reset" value="重置">
    </div>    
  </form>
</div>
