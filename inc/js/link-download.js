jQuery(function($) { 
// get link thuong
var max_link1      = 10; // so luong input
var bang1         = $(".bang-link1"); 
var them1      = $(".them-link1"); 
var x = 1; 
$(them1).click(function(e){ 
    e.preventDefault();
    if(x < max_link1){ 
        x++; 
        $(bang1).append('<div style="display:flex;margin-top:10px"><input id="post-input" placeholder="Nhập link" type="text" name="download_link1[]"/><input id="post-input" placeholder="Nhập tên" type="text" name="download_link11[]"/><a href="#" class="remove-download1 post-download-del">X</a></div>'); 
    }
});
$(bang1).on("click",".remove-download1", function(e){
    e.preventDefault(); 
    $(this).parent('div').remove(); x--;
})
// get link nhay giay
var max_link2      = 10; // so luong input
var bang2         = $(".bang-link2"); 
var them2      = $(".them-link2"); 
var x = 1; 
$(them2).click(function(e){ 
    e.preventDefault();
    if(x < max_link2){ 
        x++; 
        $(bang2).append('<div style="display:flex;margin-top:10px"><input id="post-input" placeholder="Nhập link" type="text" name="download_link2[]"/><input id="post-input" placeholder="Nhập tên" type="text" name="download_link21[]"/><a href="#" class="remove-download2 post-download-del">X</a></div>');
    }
});
$(bang2).on("click",".remove-download2", function(e){
    e.preventDefault(); 
    $(this).parent('div').remove(); x--;
})
});