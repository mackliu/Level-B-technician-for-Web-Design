<fieldset class="fbox cent" style="width:90%">
  <legend>目前位置：首頁 > 最新文章區</legend>
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
      $news=getData("news"," where sh=1 LIMIT $start,$div");
      foreach($news as $k => $n){    
    ?>
    <tr>
      <td width="30%" class="clo" style="cursor:pointer" onclick="javascript:$('#t<?=$n['seq'];?>').toggle();$('#a<?=$n['seq'];?>').toggle();"><?=$n['title'];?></td>
      <td width="50%">
        <div id="t<?=$n['seq'];?>"><?=mb_substr($n['text'],0,20,"utf8");?>...</div>
        <div id="a<?=$n['seq'];?>" style="display:none"><pre><?=$n['text'];?></pre></div>
      </td>
      <td>
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