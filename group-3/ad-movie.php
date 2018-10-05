<div class="bb ma w100" style="background:#eee;border:3px solid #aaa;padding:5px;">
<button onclick="lof('?do=addMovie')">新增院線片</button>
<hr>


    <div class="bb ma w100 ct" style="height:400px;overflow:auto">
    <?php
    $row=getData("movie"," order by rank")->fetchAll();
    foreach($row as $k => $r){
    ?>
    <table class="bb ma w100" style="background:#fff;margin:5px auto;">
      <tr>
        <td rowspan="3" width="15%"><img src='./poster/<?=$r['poster'];?>' style='width:100px;height:120px'></td>
        <td width="10%" rowspan="3">
        分級:<img src='./icon/03C0<?=$r['level'];?>.png' style='width:25px;vertical-align:middle'>
        </td>
        <td  width="25%">
          片名:<?=$r['name'];?>
        </td>
        <td width="25%">
          片長:<?=$r['length'];?>
        </td>
        <td width="25%">
          上映時間:<?=date("Y/m/d",strtotime($r['ondate']));?>
        </td>
      </tr>
      <tr class="r">
        <td colspan="3">
         
        <input type="button" value="<?=($r['sh']==1)?"顯示":"隐藏";?>" onclick="showMovie(this,<?=$r['seq'];?>)" >
        <input type="button" value="往上" onclick="sw('movie',this)" sw=<?=($k>0)?$r['seq']."-".$row[$k-1]['seq']:$r['seq']."-".$r['seq'];?>>
          <input type="button" value="往下" onclick="sw('movie',this)" sw=<?=($k<(count($row)-1))?$r['seq']."-".$row[$k+1]['seq']:$r['seq']."-".$r['seq'];?>>
          <button onclick="lof('?do=editMovie&seq=<?=$r['seq'];?>')">編輯電影</button>
          <button onclick="del('movie',<?=$r['seq'];?>)">刪除電影</button>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          劇情介紹:<?=$r['intro'];?>
        </td>
      </tr>
    </table>
    <?php
    }
    ?>
    </div>
</div>
<script>
  function showMovie(obj,seq){
    switch($(obj).val()){
      case "顯示":
        $.post("api.php?do=showMovie",{"sh":0,seq},function(){
          $(obj).val("隐藏");
        })
      break;
      case "隐藏":
      $.post("api.php?do=showMovie",{"sh":1,seq},function(){
          $(obj).val("顯示");
        })
      break;
    }
  }
</script>
