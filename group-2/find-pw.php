<fieldset class="fbox cent" style="width:300px">
  <table class="tsb">
    <tr>
      <td>請輸入信箱以查詢密碼</td>
    </tr>
    <tr>
      <td><input type="text" name="email" id="email" style="width:95%"></td>
    </tr>
    <tr>
      <td id="ans"></td>
    </tr>
    <tr>
      <td><button onclick="findPw()">尋找</button></td>
    </tr>    
  </table>
</fieldset>
<script>
function findPw(){
  let email=$("#email").val();
  $.post("api.php?do=findPw",{email},function(back){
    $("#ans").html(back);
  })
}
</script>