<div>目前位置：首頁 > 分類網誌 > <span id="nav"></span></div>
<fieldset class="fbox" style="width:120px;display:inline-block;vertical-align:top;line-height:25px">
  <legend>網誌分類</legend>
  <?php
  foreach($type as $k => $t){
    echo "<a onclick='selType(&#39;".$k."&#39;)' style='display:block'>".$t."</a>";
  }
  ?>
</fieldset>
<fieldset class="fbox" style="width:500px;display:inline-block;">
  <legend id="listhead">文章列表</legend>
  <div id="listpost">

  </div>
</fieldset>
<script>
let type=<?=json_encode($type);?>;
function selType(x){
  $("#listhead").html("文章列表");
  $("#nav").html(type[x]);
  $.post("api.php?do=getList",{"type":x},function(back){
    $("#listpost").html(back);
  })
}
selType(1);
function showPost(x){
  $.post("api.php?do=showPost",{"seq":x},function(back){
    let post=JSON.parse(back);
    $("#listhead").html(post.title);
    $("#listpost").html("<pre>"+post.text+"<pre>");
  })

}
</script>