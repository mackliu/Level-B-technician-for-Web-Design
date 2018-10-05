<fieldset class="cent fbox" style="width:70%">
<legend>新增問卷</legend>
<form action="api.php?do=adQue" method="post">
  <table class="tsb">
    <tr>
      <td class="clo" width="150px">問卷名稱</td>
      <td><input type="text" name="subject" style="width:95%"></td>
    </tr>
    <tr class="clo">
      <td colspan="2">
        <div id="ins">
          選項<input type="text" name="option[]" style="width:400px">
          <input type="button" onclick="moreOpt()" value="更多">
        </div>
  
      </td>
    </tr>
    <tr>
      <td colspan="2">
         <input type="submit" value="新增">|<input type="reset" value="清空">
      </td>
    </tr>
  </table>
</form>
</fieldset>
<script>
function moreOpt(){
  let str=`<div>選項<input type="text" name="option[]" style="width:400px"></div>`
  $("#ins").before(str);
}
</script>