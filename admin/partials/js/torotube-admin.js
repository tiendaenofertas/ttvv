jQuery(document).ready(function($){


    jQuery(document).ready(function ($) {
        $('.custom_media_item_upload').on("click", function() {
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(this);
            wp.media.editor.send.attachment = function(props, attachment) {
                $(button).next().val(attachment.id);
                $(button).prev().find('img').attr('src', attachment.url);
                $(button).prev().find('img').show();
                $(button).prev().show();
                $(button).next().next().show();
                wp.media.editor.send.attachment = send_attachment_bkp;
            }
            wp.media.editor.open(button);
            return false;       
        });
        $('.custom_media_item_delete').on("click", function() {
            var button = $(this);
            $(button).hide();
            $(button).prev().prev().prev().find('img').attr('src', '');
            $(button).prev().prev().prev().hide();
            $(button).prev().val('');
            return false;       
        });
    });

    /* ORDER HOME SECTION */
    $('.tt-order').arrangeable();
   
    
    /* SAVE HOME PANEL */
    $(document).on('click', '#save-home-panel', ()=>{
        
        let textseo             = $('#home-seo-text').val(),
            titleseo            = $('#home-seo-title').val(),
            titlelatest         = $('#home-latest-title').val(),
            numberlatest        = $('#home-latest-number').val(),
            urllatest           = $('#home-latest-url').val(),
            enablelatestads     = $('input:radio[name=home-latest-ads-enable]:checked').val(),
            latestadsmobile     = $('#home-latest-ads-mobile').val(),
            latestadsdesktop    = $('#home-latest-ads-desktop').val(),
            titlecategories     = $('#home-categories-title').val(),
            numbercategories    = $('#home-categories-number').val(),
            urlcategories       = $('#home-categories-url').val(),
            enablecategoriesads = $('input:radio[name=home-categories-ads-enable]:checked').val();
        

        console.log(latestadsmobile);
        var arrayOrder = [];
        $('.tt-order').each(function() {
            var item = $(this).attr('id');
            arrayOrder.push(item);
        });

        console.log(arrayOrder);

        $.ajax({
            url 	: torotube_Admin.url,
            method 	: 'POST',
            dataType: 'json',
            data 	: {
                action             : 'action_save_home_panel',
                textseo            : textseo,
                titleseo           : titleseo,
                titlelatest        : titlelatest,
                urllatest          : urllatest,
                numberlatest       : numberlatest,
                enablelatestads    : enablelatestads,
                latestadsmobile    : latestadsmobile,
                latestadsdesktop   : latestadsdesktop,
                titlecategories    : titlecategories,
                urlcategories      : urlcategories,
                numbercategories   : numbercategories,
                enablecategoriesads: enablecategoriesads,
                order              : arrayOrder,
            }, 
            beforeSend: function(){
                console.info('loading');
            },
            success: function( data ) {
                console.log(data);
            },
            error: function(){
                console.warn('error');
            }
        });

    })
  
})