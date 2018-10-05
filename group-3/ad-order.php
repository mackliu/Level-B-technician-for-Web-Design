<div class="bb ma w100" style="background:#eee;border:3px solid #aaa;padding:5px;">
  <div class="bb ct ma w100 br1" style="line-height:30px;color:white;background:#666">
    訂單清單
  </div>
  <div>
    快速刪除:
    <input type="radio" name="type" value="date" checked>依日期
    <input type="text" name="date" id="date" value="">
    <input type="radio" name="type" value="movie">依電影
    <select name="movie" id="movie">
      <?php
      $movie=$pdo->query("select movie from ord group by movie")->fetchAll();
      foreach($movie as $m){
        echo "<option value='".$m['movie']."'>".$m['movie']."</option>";
      }
      ?>
    </select>
    <button onclick="qDel()">刪除</button>

  </div>
  <table class="bb ct ma w100" style="background:#bbb;margin:3px auto;">
    <tr>
      <td width="14%">訂單編號</td>
      <td width="14%">電影名稱</td>
      <td width="14%">日期</td>
      <td width="14%">場次時間</td>
      <td width="14%">訂購數量</td>
      <td width="14%">訂購位置</td>
      <td>操作</td>
    </tr>
  </table>
    <div class="bb ma w100 ct" style="height:350px;overflow:auto">
    <?php
    $row=getData("ord"," order by no")->fetchAll();
    foreach($row as $k => $r){
    ?>
    <table class="bb ma w100" style="margin:5px auto;">
      <tr>
        <td width="14%"><?=$r['no'];?></td>
        <td width="14%"><?=$r['movie'];?></td>
        <td width="14%"><?=$r['date'];?></td>
        <td width="14%"><?=$r['session'];?></td>
        <td width="14%"><?=$r['qt'];?></td>
        <td><?
          $seat=unserialize($r['seat']);
        foreach($seat as $s){
          echo (floor($s/5)+1)."排".(($s%5)+1)."號<br>";
        }
        ?>
        </td>
        <td>
          <button onclick="del('ord',<?=$r['seq'];?>">刪除</button>
        </td>
      </tr>
    </table>
    <hr>
    <?php
    }
    ?>
    </div>
</div>
<script>
function qDel(){
  let type=$("input[name=type]:checked").val();
  let date,movie,cc;
  switch(type){
    case 'date':
      date=$("#date").val();
      cc=confirm("你確定要刪除全部 "+date+" 的訂單嗎?");
      if(cc==true){
        $.post("api.php?do=qDel",{type,date},function(){
          location.reload();
        })
      }
    break;
    case 'movie':
    movie=$("#movie").val();
      cc=confirm("你確定要刪除全部 "+movie+" 的訂單嗎?");
      if(cc==true){
        $.post("api.php?do=qDel",{type,movie},function(){
          location.reload();
        })
      }
    break;
  }
}
</script>
