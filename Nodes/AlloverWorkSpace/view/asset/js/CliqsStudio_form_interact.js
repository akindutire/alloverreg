(function($){

	$.fn.CliqsStudioAjaxifyForms = function(options,callback){

		var current_object_using_me = this;

		var default_url = current_object_using_me.closest('form').attr('action');
		
		var settings = {'url':default_url,'data':null,'extra':0,'setcookie':0};

		if (options) {

			$.extend(settings,options);
		}

		if (callback) {

			var form_data = settings['data'];

			(current_object_using_me.closest('form input')).each(function(i,v){
				$('input').eq(i).attr('value','');
			});
			
			var posting = $.post(settings['url'],form_data);
			
			posting.done(function(data){
				
				
				localStorage.response = data;
				callback.call(this);

			});

			posting.fail(function(){

				localStorage.response = -1;
				alert("An Error Occured, Form Validation Terminated: Network Issues");
			
			});



		}else{
			
			localStorage.response = -1;
			alert("An Error Occured : Couldn't Initialize CliqsStudioAjaxifyForms Plugin")
		
		}

	}


})(jQuery);