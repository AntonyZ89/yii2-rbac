$(function(){
    $(document).on('click', '.show-modal',  function(){
        var self = $(this),
        	target = $(self.attr('data-target')),
            ajax_url = self.attr('data-url') || self.attr('href'),
            header = self.attr('data-header')||'';
		var h4 = target.find('.modal-header').find('h4');
		if (h4.length === 0) {
		    $('<h4>'+header+'</h4>').appendTo(target.find('.modal-header'));
		} else {
			h4.text(header);
		}
        if (ajax_url) {
        	var body = target.modal('show').find('.modal-body').empty();
        	$.ajax({
    			url: ajax_url,
    			success: function (response) {
    				body.html(response);
    			},
    			error: function (jqXHR) {
    				body.html('<div class="error-summary">'+jqXHR.responseText+'</div>');
    			}
    		});
        	return false;
        }
    });
    $(document).on('submit', 'form[data-ajax]', function(event) {
    	event.preventDefault();
		var formData = new FormData(this);
		var form = $(this);
		var body = form.closest('.modal-body').empty();
		// submit form
		$.ajax({
			url: form.attr('action'),
			type: 'post',
			enctype: 'multipart/form-data',
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			data: formData,
			success: function (response) {
				body.html(response);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				body.html('<div class="error-summary">'+jqXHR.responseText+'</div>');
			}
		});
		return false;
	});
	$('body').on('click', 'a[data-ajax]', function () {
		var self = $(this),
			modal_body = self.closest('.modal-body').empty();
		$.ajax({
			url: self.attr('href'),
			success: function (response) {
				modal_body.html(response);
			},
			error: function (jqXHR) {
				modal_body.html('<div class="error-summary">'+jqXHR.responseText+'</div>');
			}
		});
		return false;
	});
});