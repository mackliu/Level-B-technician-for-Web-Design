<fieldset class="fbox cent" style="width:400px">
  <legend>會員登入</legend>
  <table class="tsb">
    <tr>
      <td class="clo">帳號</td>
      <td><input type="text" name="acc" id="acc"></td>
    </tr>
    <tr>
      <td class="clo">密碼</td>
      <td><input type="passowrd" id="pw" name="pw"></td>
    </tr>
    <tr>
      <td >
        <input type="button" value="登入" onclick="login()">
        <input type="button" value="清除" onclick="javascript:$('#acc,#pw').val('');"></td>
      <td class="r">
        <a onclick="lof('index.php?do=findPw')">忘記密碼</a>
        |
        <a onclick="lof('index.php?do=reg')">尚未註冊</a>
      </td>
    </tr>
  </table>
</fieldset>
<script>
function login(){
  let acc=$("#acc").val();
  let pw=$("#pw").val();
  $.post("api.php?do=chkAcc",{acc},function(back){
    if(back==1){
      $.post("api.php?do=chkPw",{acc,pw},function(back){
        if(back==1){
          switch(acc){
            case "admin":
              lof("admin.php");
            break;
            default:
              lof('index.php');
            break;
          }
        }else{
          alert("密碼錯誤");
        }
      })
    }else{
      alert("查無帳號");
      $('#acc,#pw').val('');
     }
  })
}
</script>