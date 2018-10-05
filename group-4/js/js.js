// JavaScript Document
function lof(x)
{
	location.href=x
}
function del(table,seq){
  $.post("api.php?do=del",{table,seq},function(){
    location.reload();
  })
}