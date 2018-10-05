<?php
  if(!empty($_GET['seq'])){
    $subject=getData("que",['seq'=>$_GET['seq']])->fetch();
    $option=getData("que",['parent'=>$_GET['seq']]);
  }
?>
<style>
td{
  line-height:30px;
}
  </style>
<fieldset class="cent fbox" style="width:80%">
  <legend>目前位置：首頁 > 問卷調查 > <?=$subject['text'];?></legend>
  <form action="api.php?do=vote" method="post">
    <table class="tsb">
      <tr>
        <td style="font-weight:bolder"><?=$subject['text'];?></td>
      </tr>
      <?php
      foreach($option as $k => $o){
      ?>
      <tr>
        <td>
          <input type="radio" name="vote" value="<?=$o['seq'];?>">
          <?=$o['text'];?>
        </td>
      </tr>
      <?php
      }
      ?>
      <tr class="ct">
        <td>
          <input type="submit" value="我要投票">
          <input type="hidden" name="parent" value="<?=$subject['seq'];?>">
      </td>
      </tr>
    </table>
  </form>
</fieldset>