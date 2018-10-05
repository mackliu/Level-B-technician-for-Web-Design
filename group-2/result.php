<?php
  if(!empty($_GET['seq'])){
    $subject=getData("que",['seq'=>$_GET['seq']])->fetch();
    $all=($subject['count']==0)?1:$subject['count'];
    $option=getData("que",['parent'=>$_GET['seq']]);
  }
?>
<style>
td{
  line-height:25px;
  padding:5px 0;
}
.line{
  display:inline-block;
  height:25px;
  background:grey;
}
  </style>
<fieldset class="cent fbox" style="width:80%">
  <legend>目前位置：首頁 > 問卷調查 > <?=$subject['text'];?></legend>
    <table class="tsb">
      <tr>
        <td colspan="2" style="font-weight:bolder"><?=$subject['text'];?></td>
      </tr>
      <?php
      foreach($option as $k => $o){
      ?>
      <tr>
        <td width="50%">
          <?=($k+1).".".$o['text'];?>
        </td>
        <td>
          <div class='line' style="width:<?=round(($o['count']/$all)*100);?>%">
          </div>
          <?=$o['count'];?>票(<?=round(($o['count']/$all)*100);?>%)
        </td>
      </tr>
      <?php
      }
      ?>
      <tr class="ct">
        <td colspan="2">
          <input type="button" onclick="lof('index.php?do=que')" value="返回">
      </td>
      </tr>
    </table>
</fieldset>