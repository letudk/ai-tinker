jQuery(function($) { 
    $('.smartkid-loadmore').click(function(){
        var button = $(this),
            data = {
            'action': 'loadmore',
            'query': smartkid_loadmore_params.posts, 
            'page' : smartkid_loadmore_params.current_page
        };
        $.ajax({ 
            url : smartkid_loadmore_params.ajaxurl, 
            data : data,
            type : 'POST',
            beforeSend : function (xhr) {
				button.text('');
                button.html(loadbut); 
            },
            success : function( data ){
                if(data) { 
                    button.html(nuttaibut).prev().after(data); 
                    smartkid_loadmore_params.current_page++;
 
                    if ( smartkid_loadmore_params.current_page == smartkid_loadmore_params.max_page ) 
                        button.remove(); 
                } else {
                    button.remove(); 
                }
            }
        });
    });
    console.log('smartkid_loadmore_params:', smartkid_loadmore_params);
console.log('Query:', smartkid_loadmore_params.posts);

});