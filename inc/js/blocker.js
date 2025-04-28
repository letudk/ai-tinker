jQuery(document).ready(function($){
if ($("#googleads").height() > 1) {
  console.log("Cảm ơn bạn đã không sử dụng blocker!");
  $("#box-blocker").html("");
  $("#box-blocker").css("display", "none");
} 
else {
  $("#setblocker").html("<div class='box-blocker' id='box-blocker'><div class='card-blocker'><div class='icon-blocker'><i class='fa-solid fa-spider-black-widow'></i><span>"+ titblocker +"</span></div>"+ conblocker +"<div class='tat-blocker'>"+ offblocker +"</div></div></div>");
}

 $( "#nut-blocker" ).click(function() {
 $("#box-blocker").css("display", "none");
});
});