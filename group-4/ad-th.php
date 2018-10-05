<p class="ct fb">商品分類</p>
<div class="ct">新增大類
<input type="text" name="big" id="big"><button onclick="addType('big')">新增</button>
</div>
<div class="ct">新增中類
<select name="sb" id="sb" >
<?
foreach($menu as $k => $m){
  echo "<option value='$k'>$typename[$k]</option>";
}
?>
</select>
<input type="text" name="mid" id="mid">
<button onclick="addType('mid')">新增</button>
</div>
<table class="all">
<?
  foreach($menu as $k => $m){
    ?>
    <tr class="tt"><td id="t<?=$k;?>" width="60%"><?=$typename[$k];?></td>
      <td class="ct">
        <button onclick="editType(<?=$k;?>)">修改</button>
        <button onclick="del('type',<?=$k;?>)">刪除</button>
      </td>
    </tr>
    <?
  if(!empty($m)){
    foreach($m as $t){
      ?>
        <tr class="pp ct"><td id="t<?=$t;?>"><?=$typename[$t];?></td>
          <td>
            <button onclick="editType(<?=$t;?>)">修改</button>
            <button onclick="del('type',<?=$t;?>)">刪除</button>
          </td>
        </tr>
      <?
    }
  }
  }
?>
</table>

<p class="ct fb">商品管理</p>
<div class="ct"><button onclick="lof('?do=addItem')">新增商品</button></div>
<div class="ct">
  <select name="type" id="type">
    <option value="0">全部商品</option>
  </select>
</div>
<table class="all">
  <tr class="tt ct">
    <td>編號</td>
    <td>商品名稱</td>
    <td>庫存量</td>
    <td>狀態</td>
    <td>操作</td>
  </tr>
  <?
$all=getData("item","")->fetchAll();
foreach($all as $k => $r){
  ?>
  <tr class="pp ct">
    <td><?=$r['no'];?></td>
    <td width="40%" style="text-align:left"><?=$r['name'];?></td>
    <td><?=$r['stock'];?></td>
    <td id="sh<?=$r['seq'];?>"><?=($r['sh']==1)?"販售中":"已下架";?></td>
    <td>
    <button onclick="lof('?do=editItem&seq=<?=$r['seq'];?>')">修改</button>
    <button onclick="del('item',<?=$r['seq'];?>)">刪除</button><br>
    <button onclick="onSale(1,<?=$r['seq'];?>)">上架</button>
    <button onclick="onSale(0,<?=$r['seq'];?>)">下架</button>
    </td>
  </tr>

  <?
}
?>  
</table>
<script>
function onSale(show,seq){
  $.post("api.php?do=onSale",{show,seq},function(){
    switch(show){
      case 1:
        $('#sh'+seq).html("販售中");
      break;
      case 0:
      $('#sh'+seq).html("已下架");
      break;
    }
  })
}

function addType(type){
  let big,sb,mid;
  switch(type){
    case "big":
    big=$("#big").val()
      $.post("api.php?do=addType",{type,big},function(){
        location.reload();
      })
    break;
    case "mid":
      mid=$("#mid").val()
      big=$("#sb").val()
      $.post("api.php?do=addType",{type,mid,big},function(){
        location.reload();
      })
    break;
  }
}
function editType(seq){
  let cc=prompt("請輸入要修改的分類名稱",$("#t"+seq).html());
  if(cc!=null){
    $.post("api.php?do=editType",{seq,"name":cc},function(){
      $("#t"+seq).html(cc);
    })
  }
}
</script>

