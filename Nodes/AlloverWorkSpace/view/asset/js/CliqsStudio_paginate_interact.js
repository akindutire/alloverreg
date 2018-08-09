(function($){

	$.fn.CliqsStudioPaginate = function(options,callback){

		var current_object_using_me = this;

		var settings = {'paginateType':'forward','url':null,'placementDOM':null,'wait':'Loading','current_page':1};

		if(options){

			$.extend(settings,options);
			
		}

		if (callback) {

			var paginateType = settings['paginateType'];

			if(paginateType == 'forward'){

				var module_id = current_object_using_me.data('module');
				var perpage = current_object_using_me.data('perpage');

				if (typeof(module_id) != 'undefined' || typeof(perpage) != 'undefined') {

					var extra = settings['extra'];

					var client_page_id = 'c'+module_id;
					var hidden_current_page_iterator = "<div id='"+client_page_id+"'></div>";
					var cur_page = settings['current_page'];
					
				
						
					var url = settings['url'];

					function save_current_page_iterator(){

						if(current_object_using_me.closest('div').has('div#'+client_page_id)){

							current_object_using_me.closest('div').find('div#'+client_page_id).html(cur_page);

						}else{
							
							current_object_using_me.closest('div').append(hidden_current_page_iterator).find('div#'+client_page_id).empty().html(cur_page);	
						
						}
					}

					var posting = $.post(url,{'module_id':module_id,'cur_page':cur_page,'perpage':perpage,'extra':extra});
					
					current_object_using_me.empty().html(settings['wait']);

					posting.done(function(data){

						save_current_page_iterator();

						data = $.trim(data);
						var appendHere = settings['placementDOM'];

						if(data==''){
							
							current_object_using_me.empty().html("Load More");
							alert("Load Complete");	
						
						}else{
							
							current_object_using_me.closest('div').find(appendHere).append(data);
							current_object_using_me.empty().html("Load More");
							
						}
						
					});	
				
				}else{

					alert("An Error Occured : Couldn't Initialize CliqsStudioPaginate , Illegal Argument Supplied [module and perpage]");
				}

			}else if(paginateType == 'backward'){

				//BackWard Pagination

				var module_id = current_object_using_me.data('module');
				var perpage = current_object_using_me.data('perpage');

				if (typeof(module_id) != 'undefined' || typeof(perpage) != 'undefined') {

					var extra = settings['extra'];

					var client_page_id = 'c'+module_id;
					var hidden_current_page_iterator = "<div id='"+client_page_id+"'></div>";
					var cur_page = settings['current_page'];
					
				
						
					var url = settings['url'];

					function save_current_page_iterator(){

						if(current_object_using_me.closest('div').has('div#'+client_page_id)){

							current_object_using_me.closest('div').find('div#'+client_page_id).html(cur_page);

						}else{
							
							current_object_using_me.closest('div').append(hidden_current_page_iterator).find('div#'+client_page_id).empty().html(cur_page);	
						
						}
					}

					var posting = $.post(url,{'module_id':module_id,'cur_page':cur_page,'perpage':perpage,'extra':extra});
					
					current_object_using_me.empty().html(settings['wait']);

					posting.done(function(data){

						save_current_page_iterator();

						data = $.trim(data);
						var appendHere = settings['placementDOM'];

						if(data==''){
							
							current_object_using_me.empty().html("Load Previous");
							alert("Load Complete");	
						
						}else{

							current_object_using_me.closest('div').find(appendHere).prepend(data);
							current_object_using_me.empty().html("Load Previous");
							
						}
						
					});	
				
				}else{

					alert("An Error Occured : Couldn't Initialize CliqsStudioPaginate , Illegal Argument Supplied [module and perpage]");
				}

			}
	
				
		}else{

			alert("An Error Occured : Couldn't Initialize CliqsStudioPaginate plugin");
		}


	}


})(jQuery);