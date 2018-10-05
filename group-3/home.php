<style>
#poster{
  width:210px;
  height:260px;
  overflow:hidden;
  position:relative;
}
.po{
  width:210px;
  height:260px;
  padding:10px;
  position:absolute;
}
.po img{
  width:100%;
}
#button{
  width:100%;
  height:120px;
  margin-top:10px;
  position:relative;
  display:flex;
  align-items:center;
}
.la{
  border-top:25px solid transparent;
  border-left:25px solid transparent;
  border-right:25px solid black;
  border-bottom:25px solid transparent;
}
#nav{
  width:320px;
  height:120px;
  position:relative;
  overflow:hidden;
}
#icon{
  display:inline-flex;
  height:110px;
  position:relative;
}
.icon{
  width:80px;
  height:110px;
  display:inline-block;
  position:relative;
  padding:10px;
  font-size:12px;
}
.icon img{
  width:100%;
}
.icon:hover{
  border:1px solid white;
}
.ra{
  border-top:25px solid transparent;
  border-left:25px solid black;
  border-right:25px solid transparent;
  border-bottom:25px solid transparent;
}
</style>

<div id="mm">
<div class="half" style="vertical-align:top;">
  <h1>預告片介紹</h1>
  <div class="rb tab" style="width:95%;">
  <div id="poster" class="bb ma">
<?php
  $all=countRows("poster",['sh'=>1]);
  $po=getData("poster"," where sh=1 order by rank")->fetchAll();
  foreach($po as $k =>$p){
    echo "<div class='bb ct po' ani='".$p['ani']."' id='p".$p['seq']."'>";
    echo "<img src='./poster/".$p['poster']."'>";
    echo $p['name'];
    echo "</div>";
  }
?>
  </div>
  <div id="button" class="bb ma">
    <div class="bb la" onclick="moveBtn(1)"></div>
    <div id="nav" class="bb">
      <div id="icon" class="bb">
      <?php
  
  foreach($po as $k =>$p){
    echo "<div class='bb ct icon' id='i".$p['seq']."'>";
    echo "<img src='./poster/".$p['poster']."'>";
    echo $p['name'];
    echo "</div>";
  }
?>        
      </div>
    </div>
    <div class="bb ra" onclick="moveBtn(2)"></div>
  </div>
</div>
</div>
<script>
let num=<?=$all;?>;
let start=1;
$(".po").hide()
$(".po").eq(0).show();

function autoSlide(){
  myAni($(".po").eq(start));
  if(start<num-1){
    start++
  }else{
    start=0;
  }
}
let auto=setInterval(function(){autoSlide()},4000);
function myAni(obj){
  let now=$(".po:visible")
  switch($(obj).attr('ani')){
    case "1":
      $(now).fadeOut(3000);
      $(obj).fadeIn(3000);
    break;
    case "2":
      $(obj).css({left:210,top:0})
      $(obj).show();
      $(now).animate({left:-210,top:0},function(){
        $(now).hide();
        $(now).css({left:0,top:0});
      })
      $(obj).animate({left:0,top:0});
    break; 
    case "3":
      $(obj).css({width:0,height:0,left:105,top:130,padding:0});
      $(now).animate({width:0,height:0,left:105,top:130,padding:0},function(){
        $(now).hide();
        $(now).css({width:210,height:260,left:0,top:0,padding:10});
        $(obj).show();
        $(obj).animate({width:210,height:260,left:0,top:0,padding:10})
      })
    break;
  }
}
let p=0;
function moveBtn(x){
  switch(x){
    case 1:
      if((p-1>=0)){
        p--;
        $("#icon").animate({right:p*80});
      }
    break;
    case 2:
    if((p+1<=num-4)){
        p++;
        $("#icon").animate({right:p*80});
      }
    break;
  }
}
$('.icon').click(function(){
  let id=$(this).attr("id").replace("i","p");
  myAni($("#"+id));
  start=$(this).index()+1;
})
$("#icon").hover(
  function(){
    clearInterval(auto);
  },
  function(){
    auto=setInterval(function(){autoSlide()},4000);
  }
)
</script>
<!--------------->      
<div class="half">
  <h1>院線片清單</h1>
  <div class="rb tab" style="width:95%;">
  <?php
  $today=date("Y-m-d");
  $ondate=date("-2 days",strtotime($today));
  $all=countRows("movie"," where sh=1 && ondate >= '".$ondate."' && ondate <='".$today."'");
  $div=4;
  $page=ceil($all/$div);
  $now=(!empty($_GET['p']))?$_GET['p']:1;
  $start=($now-1)*$div;
  $movie=getData("movie"," where sh=1 && ondate >= '".$ondate."' && ondate <='".$today."' order by rank limit $start,$div")->fetchAll();
  foreach($movie as $k => $m){

  ?>
    <table class="bb di" style="width:48%;margin:0.5%;padding:10px 2px;font-size:12px;border:1px solid #999;border-radius:10px">
        <tr>
          <td rowspan="3">
            <img src="./poster/<?=$m['poster'];?>" style="width:60px;height:90px;border:2px solid white">
          </td>
          <td style="font-size:15px"><?=$m['name'];?></td>
        </tr>
        <tr>
          <td>分級:
            <img src="./icon/03C0<?=$m['level'];?>.png" style="width:20px;vertical-align:middle">
            <?=$level[$m['level']];?>
          </td>
        </tr>
        <tr>
          <td>上映日期:<?=$m['ondate'];?></td>
        </tr>
        <tr>
          <td colspan="2" class="ct">
            <button onclick="lof('?do=intro&seq=<?=$m['seq'];?>')">劇情簡介</button>
            <button onclick="lof('?do=order&seq=<?=$m['seq'];?>')">線上訂票</button>
          </td>
        </tr>
    </table>
<?php
}
?>

    <div class="ct a">
    <?php
    echo (($now-1)>0)?"<a href='?p=".($now-1)."' style='font-size:20px'>< </a>":"";
    for($i=1;$i<=$page;$i++){
      $font=($i==$now)?"24px":"20px";
      echo "<a href='?p=$i' style='font-size:$font'> $i </a>";
    }
    echo (($now+1)<=$page)?"<a href='?p=".($now+1)."' style='font-size:20px'> ></a>":"";
    ?>
    </div>
  </div>
</div>
</div>