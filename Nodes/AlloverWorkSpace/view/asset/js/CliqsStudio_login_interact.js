(function($){

	//This Plugin Needs Form AS an Anchor
	$.fn.CliqsStudioLogin = function(options,callback){

		var current_object_using_me = this;

		var default_url = current_object_using_me.closest('form').attr('action');
		var settings = {'url':default_url,'setcookie':0};

		if (options) {

			$.extend(settings,options);
		}

		if (callback) {


			var form_data = this.serialize();
				
			var posting = $.post(settings['url'],form_data);

			(current_object_using_me.closest('form input')).each(function(i,v){
				$('input').eq(i).attr('value','');
			});

			posting.done(function(data){
				
				
				localStorage.response = data;
				

				callback.call(this);

			});

			posting.fail(function(){
				alert("An Error Occured, Login Validation Terminated: Network Issues");
			});



		}else{
			alert("An Error Occured on CliqsStudioLogin Plugin")
		}


	}
	
	
})(jQuery);