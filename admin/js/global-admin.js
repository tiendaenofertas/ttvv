jQuery(document).ready(function($){
	function media_upload(button_selector) {
	    var _custom_media = true,
	        _orig_send_attachment = wp.media.editor.send.attachment;
	    $('body').on('click', button_selector, function () {
	      var $this = $(this);
	      $this.parent().parent().parent().find('input[type=submit]').removeAttr('disabled')
	      var button_id = $(this).attr('id');
	      wp.media.editor.send.attachment = function (props, attachment) {
	        if (_custom_media) {
	          $('.' + button_id + '_img').attr('src', attachment.url);
	          $('.' + button_id + '_url').val(attachment.url);
	        } else {
	          return _orig_send_attachment.apply($('#' + button_id), [props, attachment]);
	        }
	      }
	      wp.media.editor.open($('#' + button_id));
	      return false;
	    });
	  }
	  media_upload('.js_custom_upload_media');

	$(document).on('click', '.show-hide-cat', function(event) {
		event.preventDefault();
		var $this = $(this);
		$this.next().toggleClass('hide');
	});


    $('.clean-report').on('click', function(event) {
        event.preventDefault();
        var $this = $(this);
        var id = $(this).data('id');
        $.ajax({
            url     : torotube_Admin.url,
            method  : 'POST',
            dataType: 'json',
            data    : {
                action      : 'action_torotube_clean_report',
                id          : id
            }, 
            success: function( data ) {
                $this.parent().parent().remove();
            }
        });
    });
})