<style>
tr:nth-child(odd){
background:#aaa;
}
tr:nth-child(even){
background:#777;
}
tr:nth-child(5),td:nth-child(2){
  background:#ccc;
}
td select{
  width:100%;
}
td{
  border:1px solid #555;
}
td:nth-child(1){
  width:110px;
}
</style>
<div id="mm" style="background:#999">
<div id="order">
  <div class="bb ct br1" style="line-height:30px;color:white;background:#bbb">
    線上訂票
  </div>
  <form>
    <table class="bb ma ct br1" style="width:500px;background:#eee;padding:20px;margin-top:20px;">
      <tr>
        <td>電影：</td>
        <td>
          <select name="movie" id="movie" onchange="selmovie()">
          <?php
          if(!empty($_GET['seq'])){
            $selmovie=$_GET['seq'];
          }
          $today=date("Y-m-d");
          $ondate=date("-2 days",strtotime($today));
          $movie=getData("movie"," where sh=1 && ondate >= '".$ondate."' && ondate <='".$today."'")->fetchAll();
          foreach($movie as $k => $m){
            $sel=(!empty($selmovie) && $selmovie==$m['seq'])?"selected":"";
            echo "<option value='".$m['seq']."' $sel>".$m['name']."</option>";
          }
          ?>
        </select>
        </td>
      </tr>
      <tr>
        <td>日期：</td>
        <td><select name="date" id="date" onchange="seldate()"></select></td>
      </tr>
      <tr>
        <td>場次：</td>
        <td><select name="session" id="session" onchange="selsession()"></select></td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="button" value="確定" onclick="gobook()"><input type="reset" value="重置">
        </td>
      </tr>
    </table>
  </form>
</div>
<div id="booking" style="display:none">booking</div>
<div id="checkout" style="display:none">checkout</div>

</div>
<script>
  let seat=new Array();
  let qt=0;
  let movie,date,session;
function selmovie(){
  movie=$("#movie").val();
  $("#date").load("api.php?do=selmovie",{movie},function(){
    seldate();
  })
  
}
function seldate(){
  movie=$("#movie option:selected").text();
  date=$("#date").val();
  $("#session").load("api.php?do=seldate",{movie,date},function(){
    selsession();
  })
}
function selsession(){
  session=$("#session").val();
}
selmovie();
function gobook(){
  $("#booking").load("booking.php",{movie,date,session},function(){
   $("#order").toggle();
   $("#booking").toggle();
  })
}
function booking(obj){
  switch($(obj).prop("checked")){
    case true:
      qt++;
      if(qt>4){
        alert("最多只能訂購四張票");
        $(obj).prop("checked",false);
        qt--;
      }else{
        seat.push($(obj).val());
        $("#qt").html(qt);
      }
    break;
    case false:
      qt--;
      seat.splice(seat.indexOf($(obj).val()),1)
      $("#qt").html(qt);
    break;
  }
}
function checkout(){
  $("#checkout").load("checkout.php",{seat,qt,movie,date,session},function(){
    $("#booking").toggle();
    $("#checkout").toggle();
  })
}
</script>