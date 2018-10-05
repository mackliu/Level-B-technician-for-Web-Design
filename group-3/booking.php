<?php
include_once "base.php";
 $seat=array_fill(0,20,0);
 $tmp=array();
 unset($data);
 foreach($_POST as $k =>$d){
    $data[$k]=$d;
 }
 $chk=$pdo->query("select seat from ord where movie='".$data['movie']."' && date='".$data['date']."' && session='".$data['session']."'")->fetchAll();
 foreach($chk as $c){
   $tmp=array_merge($tmp,unserialize($c['seat']));
 }
 foreach($tmp as $t){
   $seat[$t]=1;
 }
?>
<style>
.sheet{
  width:540px;
  height:370px;
  background:url("./icon/03D04.png") no-repeat center;
  padding:18px 112.5px 0 112.5px;
}
.frame{
  width:63px;
  height:86px;
  position:relative;
}
.b0{
  background:url("./icon/03D02.png") no-repeat center;
}
.b1{
  background:url("./icon/03D03.png") no-repeat center;
}
.chk{
  position:absolute;
  right:5px;
  bottom:5px;
}
</style>
<div class="bb ma sheet">
<?php
  foreach($seat as $k => $s){
    echo "<div class='bb ct di frame b".$s."'>";
    echo (floor($k/5)+1)."排".(($k%5)+1)."號";
    echo ($s==0)?"<input type='checkbox' class='chk' value='$k' onchange='booking(this)'>":"";
    echo "</div>";
  }
?>
</div>
<div class="bb ma" style="width:400px;line-height:26px;">
  <div>您選擇的電影是：<?=$data['movie'];?></div>
  <div>您選擇的時刻是：<?=$data['date'];?> <?=$data['session'];?></div>
  <div>您己經勾選<span id="qt"></span>張票，最多可以購買四張票</div>
  <div class="ct">
    <button onclick="javascript:$('#order').toggle();$('#booking').toggle()">上一步</button>
    <button onclick="checkout()">訂購</button>
  </div>
</div>