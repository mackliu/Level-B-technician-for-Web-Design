// JavaScript Document
function lof(x)
{
	location.href=x
}
function del(table,seq){
  $.post("api.php?do=del",{table,seq},function(){
    location.reload()
  })
}
function sw(table,obj){
  let sw=$(obj).attr("sw").split("-");
  $.post("api.php?do=sw",{table,sw},function(){
    location.reload()
  })
}