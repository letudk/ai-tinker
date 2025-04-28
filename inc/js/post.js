// đến bình luận
// jQuery(document).ready(function (){
// jQuery("#nutms").click(function (){
// jQuery('html, body').animate({
// scrollTop: jQuery("#respond").offset().top
// }, 600);
// });
// });

jQuery(function($) { 
    var toggleReadMore = function() {
      $('#read-more').click(function(e) {
          $(this).prev().animate({'height': $(this).prev()[0].scrollHeight + 'px'}, 400);
          $(this).hide();
          $(this).next('#read-less').show();
      });
      $('#read-less').click(function(e) {
          $(this).prev().prev().animate({height: '90px'}, 400);
          $(this).hide();
          $(this).prev('#read-more').show();
      });

    };
    toggleReadMore();
});
// Slide icon coment
jQuery(function($) { 
$("#openicon").click(function () {
    $("#openicon").click(taomenuicon());
}); 
$("#one1").click(function () {
    $("#one1").click(formatText('c:'));
}); 
$("#one2").click(function () {
    $("#one2").click(formatText('b:')); 
}); 
$("#one3").click(function () {
    $("#one3").click(formatText('t:')); 
}); 
$("#one4").click(function () {
    $("#one4").click(formatText('n:')); 
});
$("#one5").click(function () {
    $("#one5").click(formatText('y:')); 
});
$("#one6").click(function () {
    $("#one6").click(formatText('o:')); 
});
$("#one7").click(function () {
    $("#one7").click(formatText('k:')); 
});
$("#one8").click(function () {
    $("#one8").click(formatText('w:')); 
});
$("#one9").click(function () {
    $("#one9").click(formatText('s:')); 
});
$("#one10").click(function () {
    $("#one10").click(formatText('h:')); 
});
$("#one11").click(function () {
    $("#one11").click(formatText('d:')); 
});
$("#one12").click(function () {
    $("#one12").click(formatText('f:')); 
});
});
function formatText(tag) {
   var Field = document.getElementById('comment');
   var val = Field.value;
   var selected_txt = val.substring(Field.selectionStart, Field.selectionEnd);
   var before_txt = val.substring(0, Field.selectionStart);
   var after_txt = val.substring(Field.selectionEnd, val.length);
   Field.value += '[' + tag + ']';
}
