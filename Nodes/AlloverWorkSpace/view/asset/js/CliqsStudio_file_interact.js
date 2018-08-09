(function($){

	$.fn.CliqsStudioFileTransfer = function(options,callback){

		var current_object_using_me = this;
		var default_url = $(this).closest('form').attr('action');
				
		var settings = {'url':default_url,'error':'An Error Occuered : Media Transfer Failed'};

		if (options) {

			$.extend(settings,options);
		}

		if (callback) {

			var form_data=new FormData();

			var files = current_object_using_me[0].files;

			for (var i = 0; i < files.length; i++) {
        		form_data.append("file", files[i]);
    		}
			
			
			$.ajax({
					url: settings['url'],
           			type: 'POST',
            		data: form_data,
					contentType:false,
					processData:false,
					cache:false,
					beforeSend:function(evt){
						
						(current_object_using_me.closest('form input')).each(function(i,v){
							$('input[type=file]').eq(i).attr('value','');
						});


						localStorage.response = "Processing: Transfering Media";
					},

					error:function(){
						
						localStorage.response = -1;
						alert("Error: Media Transfer Failed");
					},

            		success: function (data) {
						
						
						localStorage.response = data;

						callback.call(this);
							
						
					}
                		
				});
  

		}else{

			localStorage.response = -1;
			alert("An Error Occuered : Couln't Initialize CliqsStudioFileTransfer Plugin");
		}

	}


	
})(jQuery);