<p class="ct fb">新增商品</p>
<form action="api.php?do=addItem" method="post" enctype="multipart/form-data">
  <table class="all">
    <tr>
      <td class="tt ct">所屬大類</td>
      <td class="pp">
        <select name="big" id="big" onchange="selType('big')">
        <?
          foreach($menu as $k => $d){
            echo "<option value='$k'>$typename[$k]</option>";
          }
        ?>
        </select>
      </td>
    </tr>
    <tr>
      <td class="tt ct">所屬中類</td>
      <td class="pp">
        <select name="mid" id="mid" onchange="selType('mid')">
        </select>
      </td>
    </tr>
    <tr>
      <td class="tt ct">商品編號</td>
      <td class="pp" id="no">完成分類後自動分配</td>
    </tr>
    <tr>
      <td class="tt ct">商品名稱</td>
      <td class="pp"><input type="text" name="name"></td>
    </tr>
    <tr>
      <td class="tt ct">商品價格</td>
      <td class="pp"><input type="text" name="price"></td>
    </tr>
    <tr>
      <td class="tt ct">規格</td>
      <td class="pp"><input type="text" name="spec"></td>
    </tr>
    <tr>
      <td class="tt ct">庫存量</td>
      <td class="pp"><input type="text" name="stock"></td>
    </tr>
    <tr>
      <td class="tt ct">商品圖片</td>
      <td class="pp"><input type="file" name="file"></td>
    </tr>
    <tr>
      <td class="tt ct">商品介紹</td>
      <td class="pp"><textarea name="intro" style="width:400px;height:80px;"></textarea></td>
    </tr>
  </table>
  <div class="ct">
    <input type="submit" value="新增">|
    <input type="reset" value="重置">|
    <input type="button" value="返回" onclick="lof('?do=th')">
  </div>
</form>
<script>
  function selType(type){
    let big,mid;
    switch(type){
      case "big":
        big=$("#big").val();
        $("#mid").load("api.php?do=selType",{type,big},function(){
          selType('mid');
        })
      break;
      case "mid":
        big=$("#big").val();
        mid=$("#mid").val();
        $.post("api.php?do=selType",{type,mid,big},function(back){
          console.log(back)
          $("#no").html(back+"<input type='hidden' name='no' value='"+back+"'>");
        })
      break;
    }
  }
  selType('big');
</script>