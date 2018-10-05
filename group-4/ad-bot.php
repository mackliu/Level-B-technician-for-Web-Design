<p class="fb ct">編輯頁尾版權區</p>
<form action="api.php?do=bot" method="post" >
  <table class="all">
    <tr>
      <td class="tt ct">頁尾宣告內容</td>
      <td class="pp"><input type="text" name="bot" value="<?=getData("bot","")->fetchColumn();?>"></td>
    </tr>
  </table>
  <div class="ct">
  <input type="submit" value="編輯">
  <input type="reset" value="重置">
  </div>
</form>