<?php
$redo=(!empty($_GET['redo']))?$_GET['redo']:"";
switch($redo){
  case "admin":
?>
<p class="fb">管理登入</p>
 <table class="all">
   <tr>
     <td class="tt ct">帳號</td>
     <td class="pp"><input type="text" name="acc" id="acc"></td>
   </tr>
   <tr>
     <td class="tt ct">密碼</td>
     <td class="pp"><input type="password" name="pw" id="pw"></td>
   </tr>
   <tr>
     <td class="tt ct">驗證碼</td>
     <td class="pp">
       <?php
       $a=rand(10,99);
       $b=rand(10,99);
       $_SESSION['ans']=$a+$b;
       echo $a."+".$b."=";
       ?>
       <input type="text" name="ans" id="ans">
    </td>
   </tr>
 </table>
 <div class="ct"><button onclick="login('admin')">確定</button></div>
<?php
  break;
  case "reg":
?>
<p class="fb ct">會員註冊</p>
<table class="all">
  <tr>
    <td class="tt ct">姓名</td>
    <td class="pp"><input type="text" name="name" id="name"></td>
  </tr>
  <tr>
    <td class="tt ct">帳號</td>
    <td class="pp">
      <input type="text" name="acc" id="acc">
      <button onclick="chkAcc()">檢測帳號</button>
  </td>
  </tr>
  <tr>
    <td class="tt ct">密碼</td>
    <td class="pp"><input type="text" name="pw" id="pw"></td>
  </tr>
  <tr>
    <td class="tt ct">電話</td>
    <td class="pp"><input type="text" name="tel" id="tel"></td>
  </tr>
  <tr>
    <td class="tt ct">住址</td>
    <td class="pp"><input type="text" name="addr" id="addr"></td>
  </tr>
  <tr>
    <td class="tt ct">電子信箱</td>
    <td class="pp"><input type="text" name="email" id="email"></td>
  </tr>
</table>
<div class="ct">
  <button onclick="reg()">註冊</button>|
  <button onclick="javascript:$('input[type=text],input[type=password]').val('')">重置</button>
</div>
<?php
  break;
  default:
?>
<p class="fb">第一次購物</p>
<img src="./icon/0413.jpg" style="cursor:pointer" onclick="lof('?do=login&redo=reg')">
<p class="fb">會員登入</p>
 <table class="all">
   <tr>
     <td class="tt ct">帳號</td>
     <td class="pp"><input type="text" name="acc" id="acc"></td>
   </tr>
   <tr>
     <td class="tt ct">密碼</td>
     <td class="pp"><input type="password" name="pw" id="pw"></td>
   </tr>
   <tr>
     <td class="tt ct">驗證碼</td>
     <td class="pp">
       <?php
       $a=rand(10,99);
       $b=rand(10,99);
       $_SESSION['ans']=$a+$b;
       echo $a."+".$b."=";
       ?>
       <input type="text" name="ans" id="ans">
    </td>
   </tr>
 </table>
 <div class="ct"><button onclick="login('mem')">確定</button></div>


<?php
 }
 ?>
 <script>
        
   function chkAcc(){
     let acc=$("#acc").val();
    $.post("api.php?do=chkAcc",{acc},function(back){
      console.log(back)
      if(back==1 || acc=='admin'){
        alert("帳號己存在");
      }else{
        alert("帳號可使用");
      }
     });
   }
  function reg(){
    let acc=$("#acc").val();
    let pw=$("#pw").val();
    let name=$("#name").val();
    let email=$("#email").val();
    let addr=$("#addr").val();
    let tel=$("#tel").val();
    $.post("api.php?do=chkAcc",{acc},function(back){
      if(back==1){
        alert("帳號己存在");
      }else{
        $.post("api.php?do=reg",{acc,pw,name,email,addr,tel},function(){
          alert("註冊成功，歡迎加入");
          lof('?do=login')
        })
      }
    })
  }
 function login(table){
   let acc=$("#acc").val();
   let pw=$("#pw").val();
   let ans=$("#ans").val();
   $.post("api.php?do=chkAns",{ans},function(back){
     if(back==1){
       $.post("api.php?do=chkPw",{table,acc,pw},function(back){
         console.log(back)
          if(back==1){
              switch(table){
                case "admin":
                  lof("admin.php");
                break;
                case "mem":
                  lof("index.php");
                break;
              }
          }else{
            alert("帳號或密碼錯誤");
          }
       })
     }else{
       alert("對不起，您輸入的驗證碼有誤請您重新登入");
     }
   })

 }
 </script>