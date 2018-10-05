<fieldset class="cent fbox" style="width:80%">
  <legend>目前位置：首頁 > 問卷調查</legend>
  <table class="tsb">
    <tr class="ct">
      <td>編號</td>
      <td width="60%">問卷題目</td>
      <td>投票總數</td>
      <td>結果</td>
      <td>狀態</td>
    </tr>
    <?php
    $que=getData("que",['parent'=>0]);
    foreach($que as $k => $q){
    ?>
    <tr class="ct">
      <td><?=($k+1);?></td>
      <td class="l"><?=$q['text'];?></td>
      <td><?=$q['count'];?></td>
      <td><a onclick="lof('?do=result&seq=<?=$q['seq'];?>')">結果</a></td>
      <td>
      <?php
      if(empty($_SESSION['mem'])){
        echo "請先登入";
      }else{
        echo "<a onclick='lof(&#39;?do=vote&seq=".$q['seq']."&#39;)'>參與投票</a>";
      }
      ?>
      </td>
    </tr>    
    <?php
    }
    ?>
  </table>
</fieldset>