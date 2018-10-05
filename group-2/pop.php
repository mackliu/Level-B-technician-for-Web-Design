<style>
.popbox{
  background:rgba(51,51,51,0.8);
 color:#FFF;
 height:400px;
 width:300px;
 position:fixed;
 display:none;
 z-index:9999;
 overflow:auto;
 padding:5px;

}
</style>
<fieldset class="fbox cent" style="width:90%">
  <legend>目前位置：首頁 > 人氣文章區</legend>
  <table class="tsb">
    <tr class="ct">
      <td>標題</td>
      <td>內容</td>
      <td></td>
    </tr>
    <?php
      $all=countRows("news",['sh'=>1]);
      $div=5;
      $page=ceil($all/$div);
      $now=(!empty($_GET['p']))?$_GET['p']:1;
      $start=($now-1)*$div;
      $news=getData("news"," where sh=1 order by good desc LIMIT $start,$div");
      foreach($news as $k => $n){    
    ?>
    <tr>
      <td width="30%" class="clo" id="t<?=$n['seq'];?>"><?=$n['title'];?></td>
      <td width="50%">
        <div><?=mb_substr($n['text'],0,20,"utf8");?>...</div>
        <div id="al<?=$n['seq'];?>" class="popbox" >
          <span style="font-size:24px;font-weight:bolder;color:skyblue">
          <?=$type[$n['type']];?>
          </span>
          <pre id="ssaa"><?=$n['text'];?></pre>
        </div>
      </td>
      <td>
      <span id="vie<?=$n['seq'];?>"><?=$n['good'];?></span>個人說
      <img src="./icon/02B03.jpg" style="width:25px;vertical-align:middle">
      <?php
        if(!empty($_SESSION['mem'])){
          $chk=countRows("good",['acc'=>$_SESSION['mem'],'news'=>$n['seq']]);
          if($chk>0){
            echo "<a id='good".$n['seq']."' onclick='good(".$n['seq'].",2,&#39;".$_SESSION['mem']."&#39;)'>收回讚</a>";
          }else{
            echo "<a id='good".$n['seq']."' onclick='good(".$n['seq'].",1,&#39;".$_SESSION['mem']."&#39;)'>讚</a>";
          }
          
        }
        ?>
      </td>
    </tr> 
    <?php
    }
    ?>
    <tr>
      <td colspan="3">
      <?
          echo (($now-1)>0)?"<a href='?do=news&p=".($now-1)."' style='font-size:26px'>< </a>":"";
          for($i=1;$i<=$page;$i++){
            $font=($i==$now)?"26px":"20px";
            echo "<a href='?do=news&p=".$i."' style='font-size:".$font."'> ".$i." </a>";
          }
          echo (($now+1)<=$page)?"<a href='?do=news&p=".($now+1)."' style='font-size:26px'> ></a>":"";
        ?>
      </td>  
    </tr> 
  </table>
</fieldset>
<script>
$(".clo").hover(
  function(){
    $(".popbox").hide();
    $("#"+$(this).attr("id").replace("t","al")).show();
  }
)
</script>