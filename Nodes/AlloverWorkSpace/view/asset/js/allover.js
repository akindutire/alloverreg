$(function(){

	
	var loading_gif = '<img src="/alloverreg/Nodes/AlloverWorkSpace/view/asset/img/loading1.gif" width="20px">';
	var loading_gif2 = '<img src="/alloverreg/Nodes/AlloverWorkSpace/view/asset/img/loading1.gif" width="10px">';
	
	var paginate_current_page = [0,1];

	var updateDivFor3secUpdate = null;

	var UserPath = 'Nodes/AlloverWorkSpace/';
	var UserAbsPath = "/alloverreg/Nodes/AlloverWorkSpace/";
	var UserAbsLinkPath = "/alloverreg/";

	var pop_photo_pass_model = function(e){

		e.preventDefault();
		$('#photo_pass').css({'display':'block'});
	
	},

	admin = {

		upload_file:function(e){

			e.preventDefault();
	
			var url = $(this).closest('form').attr('action');
			
			file_handle = $(this).closest('form').find('input[type=file]');

			$('p#result_space_in_modal').empty().html("Processing: Transferring Media File");

			file_handle.CliqsStudioFileTransfer({'url':url},function(){


				if (localStorage.response != -1) {

					var data = JSON.parse(localStorage.response);
					
					$('p#photo_in_main e').empty().html(data.msg);
					$('p#result_space_in_modal').empty().html("");
					$('div#DialogForPhotoUpload').css({'display':'none'});
					$('e img').each(function(){

						$(this).css({'border-radius':'50%'});

					});


				}else{

					$('p#result_space_in_modal').empty().html("");
				}

				localStorage.removeItem("response");
			
			});	
				
		}
	},


	registration = {

		process_admin_registration:function(e){

			e.preventDefault();

			var fdata = $(this).closest('form').serialize();
			
			
			//var url = $(this).closest('form').attr('action');

			$('#result_space').html("<p class='w3-red w3-padding w3-margin w3-round'>"+loading_gif+"</p>");
			$('button#register_admin').attr('disabled','disabled');
			

			$(this).closest('form').CliqsStudioAjaxifyForms({'data':fdata},function(){


				var data = localStorage.response;
				
				if (data != -1) {

					var data = JSON.parse(data);

					$('#result_space').empty().html(data.msg);
					$('button#register_admin').removeAttr('disabled');
				

				}else{

					$('#result_space').empty().html("<center><p class='w3-red w3-padding w3-margin w3-round'>An Error Occured: Couldn't Estimate Parameters</p></center>");

				}

				localStorage.removeItem("response");
			});

		},

		process_admin_registration_at_dept_level:function(e){

			e.preventDefault();

			var fdata = $(this).closest('form').serialize();
			
			
			//var url = $(this).closest('form').attr('action');

			$('#result_space').html("<p class='w3-white w3-padding w3-margin w3-round'>"+loading_gif+"</p>");
			$('button#register_admin').attr('disabled','disabled');
			

			$(this).closest('form').CliqsStudioAjaxifyForms({'data':fdata},function(){


				var data = localStorage.response;
				
				if (data != -1) {

					var data = JSON.parse(data);

					$('#result_space').empty().html(data.msg);
					$('button#register_admin').removeAttr('disabled');
				

				}else{

					$('#result_space').empty().html("<center><p class='w3-red w3-padding w3-margin w3-round'>An Error Occured: Couldn't Estimate Parameters</p></center>");

				}

				localStorage.removeItem("response");
			});

		}


	},	

	login = {

		process_admin_login:function(e) {

			e.preventDefault();
			
			var form_handle = $(this).closest('form');

			var url = $(this).closest('form').attr('action');
			var data = form_handle.serialize();
			

			$('#result_space').empty().html("<center><small class='w3-text-green'>"+loading_gif+"</small></center>");

			form_handle.CliqsStudioAjaxifyForms({'data':data},function(){

				var data = JSON.parse(localStorage.response);

				if(data != -1){

					if (data.msg === 1) {
						
						window.location = UserAbsLinkPath+'/cpanel';
				
					}else{

						$('#result_space').empty().html(data.msg);

					}

				}else{
					$('#result_space').empty().html("");					
				}

				localStorage.removeItem("response");

				 //End Callback 

			});

		},

		process_admin_login2:function(e) {

			e.preventDefault();
			
			var form_handle = $(this).closest('form');

			var url = $(this).closest('form').attr('action');
			var data = form_handle.serialize();
			

			$('#result_space').empty().html("<center><small class='w3-text-green'>"+loading_gif+"</small></center>");

			form_handle.CliqsStudioAjaxifyForms({'data':data},function(){

				var data = JSON.parse(localStorage.response);

				if(data != -1){

					if (data.msg === 1) {
						
						window.location = UserAbsLinkPath+'/studentpanel';
				
					}else{

						$('#result_space').empty().html(data.msg);

					}

				}else{
					$('#result_space').empty().html("");					
				}

				localStorage.removeItem("response");

				 //End Callback 

			});

		}


	},

	cpaneltask = {

		addfaculty:function(e){

			e.preventDefault();
			var form_handle = $(this).closest('form');

			var url = $(this).closest('form').attr('action');
			var data = form_handle.serialize();
			
			$('#result_space').empty().html("<center><small class=''>Creating...<small></center>");

			form_handle.CliqsStudioAjaxifyForms({'data':data},function(){

				var data = JSON.parse(localStorage.response);

				if(data != -1){

					
					if (data.msg ==1) {

						url = UserPath+'StreamController/stream_fetchfaculty.php';
						$.get(url,{},function(data){

							$('table#facultydata tbody').empty().html(data);
							$('#result_space').empty();
						});
					
					}else{
						$('#result_space').empty().html(data.msg);	
					}
					

				}else{
					$('#result_space').empty().html("");					
				}

				localStorage.removeItem("response");

				 //End Callback 

			});

		},

		adddepartment:function(e){

			e.preventDefault();
			var form_handle = $(this).closest('form');

			var url = $(this).closest('form').attr('action');
			var data = form_handle.serialize();
			
			$('#result_space').empty().html("<center><small class=''>Creating...<small></center>");

			form_handle.CliqsStudioAjaxifyForms({'data':data},function(){

				var data = JSON.parse(localStorage.response);

				if(data != -1){


					if (data.msg ==1) {

						
						url = UserAbsPath+'StreamController/stream_fetchdept.php';
						
						var faculty_id = $('input#faculty_id').val();

						$.post(url,{'faculty_id':faculty_id},function(data){
							
							$('table#deptdata tbody').empty().html(data);
							$('#result_space').empty();

						});
					
					

					}else{
						$('#result_space').empty().html(data.msg);	
					}
					

				}else{
					$('#result_space').empty().html("");					
				}

				localStorage.removeItem("response");

				 //End Callback 

			});

		},

		addcourse:function(e){

			e.preventDefault();
			var form_handle = $(this).closest('form');

			var url = $(this).closest('form').attr('action');
			var data = form_handle.serialize();
			
			$('#result_space').empty().html("<center>"+loading_gif+"</center>");

			form_handle.CliqsStudioAjaxifyForms({'data':data},function(){

				var data = JSON.parse(localStorage.response);

				if(data != -1){


					if (data.msg ==1) {

						
						url = UserAbsPath+'StreamController/stream_fetchcourse.php';
						
						var faculty_id = $('input#faculty_id').val();

						$.post(url,{'faculty_id':faculty_id,'parser':1},function(data){
							
							$('table#coursedata tbody').empty().html(data);
							$('#result_space').empty();

						});
					
					

					}else{
						$('#result_space').empty().html(data.msg);	
					}
					

				}else{
					$('#result_space').empty().html("");					
				}

				localStorage.removeItem("response");

				 //End Callback 

			});

		},

		addcoursedept:function(e){

			e.preventDefault();
			var form_handle = $(this).closest('form');

			var url = $(this).closest('form').attr('action');
			var data = form_handle.serialize();
			
			$('#result_space').empty().html("<center>"+loading_gif+"</center>");

			form_handle.CliqsStudioAjaxifyForms({'data':data},function(){

				var data = JSON.parse(localStorage.response);

				if(data != -1){


					if (data.msg ==1) {

						
						url = UserAbsPath+'StreamController/stream_fetchcourse.php';
						
						var faculty_id = $('input#faculty_id').val();
						var department_id = $('input#department').val();

						$.post(url,{'faculty_id':faculty_id,'parser':2,'department_id':department_id},function(data){
							
							$('table#coursedata tbody').empty().html(data);
							$('#result_space').empty();

						});
					
					

					}else{
						$('#result_space').empty().html(data.msg);	
					}
					

				}else{
					$('#result_space').empty().html("");					
				}

				localStorage.removeItem("response");

				 //End Callback 

			});

		},

		assignvenue:function(e){

			e.preventDefault();
			var form_handle = $(this).closest('form');

			var url = $(this).closest('form').attr('action');
			var data = form_handle.serialize();
			
			$('#result_space').empty().html("<center><small class=''>Assigning...<small></center>");

			form_handle.CliqsStudioAjaxifyForms({'data':data},function(){

				var data = JSON.parse(localStorage.response);

				if(data != -1){


					if (data.msg ==1) {

						
						url = UserAbsPath+'StreamController/stream_fetchvenue.php';
						
						var faculty_id = $('input#faculty_id').val();
						

						$.post(url,{'faculty_id':faculty_id},function(data){
							
							$('table#venuedata tbody').empty().html(data);
							$('#result_space').empty();

						});
					
					

					}else{
						$('#result_space').empty().html(data.msg);	
					}
					

				}else{
					$('#result_space').empty().html("");					
				}

				localStorage.removeItem("response");

				 //End Callback 

			});

		},


		joinsession:function(e){

			e.preventDefault();
			var form_handle = $(this).closest('form');

			var url = $(this).closest('form').attr('action');
			var data = form_handle.serialize();
			
			$('#result_space').empty().html("<center><small class=''>Joining...<small></center>");

			form_handle.CliqsStudioAjaxifyForms({'data':data},function(){

				var data = JSON.parse(localStorage.response);

				if(data != -1){

					
					if (data.msg ==1) {

						url = UserPath+'StreamController/stream_fetchsession.php';
						
						var faculty_id = $('input#faculty_id').val();

						$.post(url,{'faculty_id':faculty_id},function(data){
							
							$('replaceit#cpanelPage').empty().html(data);
							$('#result_space').empty();
						});
					
					}else{
						$('#result_space').empty().html(data.msg);	
					}
					

				}else{
					$('#result_space').empty().html("");					
				}

				localStorage.removeItem("response");

				 //End Callback 

			});

		},

		open_hidden_rename_form_form:function(e){

			e.preventDefault();
			$(this).closest('td').find('form input#updatedept').attr('type','text');
		},

		update_dept:function(e){

			e.preventDefault();

			var form_handle = $(this);
			var url = form_handle.attr('action');

			var data = form_handle.serialize();

			$('#table_space').empty().html(loading_gif);


			form_handle.CliqsStudioAjaxifyForms({'data':data},function(){

				var data = JSON.parse(localStorage.response);

				if(data != -1){


					if (data.msg ==1) {

						
						url = UserAbsPath+'StreamController/stream_fetchdept.php';
						
						var faculty_id = $('input#faculty_id').val();

						$.post(url,{'faculty_id':faculty_id},function(data){
							
							$('table#deptdata tbody').empty().html(data);
							$('#table_space').empty();

						});
					
					

					}else{

						alert(data.msg);
						$('#table_space').empty().html("");
						form_handle.find('input[type=text]').attr('type','hidden');	
					}
					

				}else{

					form_handle.find('input[type=text]').attr('type','hidden');
					$('#table_space').empty().html("");					
				
				}

				localStorage.removeItem("response");

				 //End Callback 

			});

		},

		remove_course:function(e){

			e.preventDefault();

			url = UserAbsPath+'StreamController/stream_deletefacultycourse.php';
						
			var delete_handle = $(this);

			var course_id = delete_handle.data('course_id');
			
			$.post(url,{'course_id':course_id},function(data){

				console.log(data);
				data = JSON.parse(data);

				if (data.msg == 1) {

					url = UserAbsPath+'StreamController/stream_fetchcourse.php';
						
						var faculty_id = $('input#faculty_id').val();

						$.post(url,{'faculty_id':faculty_id,'parser':1},function(data){
							
							$('table#coursedata tbody').empty().html(data);
							$('#result_space').empty();

						});
					

				}else{

					alert(data.msg);

				}


			});
		},

		remove_course_dept:function(e){

			e.preventDefault();

			url = UserAbsPath+'StreamController/stream_deletefacultycourse.php';
						
			var delete_handle = $(this);

			var course_id = delete_handle.data('course_id');
			
			$.post(url,{'course_id':course_id},function(data){

				console.log(data);
				data = JSON.parse(data);

				if (data.msg == 1) {

					url = UserAbsPath+'StreamController/stream_fetchcourse.php';
						
						var faculty_id = $('input#faculty_id').val();
						var department_id = $('input#department').val();

						$.post(url,{'faculty_id':faculty_id,'department_id':department_id,'parser':2},function(data){
							
							$('table#coursedata tbody').empty().html(data);
							$('#result_space').empty();

						});
					

				}else{

					//alert(data.msg);

				}


			});
		},



		open_course_modal:function(e){


			localStorage.lecdata = $(this).data('lecturer_id');
			//console.log(localStorage.lecdata);
		
			$('div#DialogModalForCourses').css({'display':'block'});

			url = UserAbsPath+'StreamController/stream_fetchunassignedcourse.php';
						
						var department_id = $('input#department').val();
						
						$('div#DialogModalForCourses table tbody').empty().html('<center>'+loading_gif+'</center>');

						$.post(url,{'parser':1,'department_id':department_id},function(data){
							
							$('div#DialogModalForCourses').find('table tbody').empty().html(data);
							$('#result_space').empty();

						});
					
		},

		open_assigned_course_modal:function(e){

			localStorage.lecdata = $(this).data('lecturer_id');
			//console.log(localStorage.lecdata);
		
			$('div#DialogModalForAssignedCourses').css({'display':'block'});

			url = UserAbsPath+'StreamController/stream_fetchassignedcourse.php';
						
						var department_id = $('input#department').val();
						
						$('div#DialogModalForCourses table tbody').empty().html('<center>'+loading_gif+'</center>');

						$.post(url,{'parser':1,'department_id':department_id,'lecturer_id':localStorage.lecdata},function(data){
							
							$('div#DialogModalForAssignedCourses').find('table tbody').empty().html(data);
							$('#result_space').empty();

						});

		},

		assignandgetunassignedcourses:function(e){

				url = UserAbsPath+'StreamController/stream_assignedcourse.php';
						
						var department_id = $('input#department').val();
						var lecturer_id = localStorage.lecdata;
						var course_id = $(this).data('course_id');
						

						$('div#DialogModalForCourses table tbody').empty().html('<center>'+loading_gif+'</center>');

						$.post(url,{'parser':1,'department_id':department_id,'lecturer_id':lecturer_id,'course_id':course_id},function(data){
							data = JSON.parse(data);
							

							if(data.msg == 1){

								url = UserAbsPath+'StreamController/stream_fetchunassignedcourse.php';
						
								var department_id = $('input#department').val();
								
								$('div#DialogModalForCourses table tbody').empty().html('<center>'+loading_gif+'</center>');

								$.post(url,{'parser':1,'department_id':department_id},function(data){
									
									$('div#DialogModalForCourses').find('table tbody').empty().html(data);
									$('#result_space').empty();

								});

							}else{

								alert(data.msg);
							}
						});
						
		},

		unassign_course:function(){

			url = UserAbsPath+'StreamController/stream_unassigncourse.php';
						
						var department_id = $('input#department').val();
						var lecturer_id = localStorage.lecdata;
						var course_id = $(this).data('course_id');
						

						$('div#DialogModalForAssignedCourses table tbody').empty().html('<center>'+loading_gif+'</center>');

						$.post(url,{'parser':1,'department_id':department_id,'lecturer_id':lecturer_id,'course_id':course_id},function(data){
							data = JSON.parse(data);
							

							if(data.msg == 1){

								url = UserAbsPath+'StreamController/stream_fetchassignedcourse.php';
						
								var department_id = $('input#department').val();
								
								$('div#DialogModalForCourses table tbody').empty().html('<center>'+loading_gif+'</center>');

								$.post(url,{'parser':1,'department_id':department_id,'lecturer_id':lecturer_id},function(data){
									
									$('div#DialogModalForAssignedCourses').find('table tbody').empty().html(data);
									$('#result_space').empty();

								});

							}else{

								alert(data.msg);
							}
						});
		},

		addstudent:function(e){

			e.preventDefault();
			var form_handle = $(this).closest('form');

			var url = $(this).closest('form').attr('action');
			var data = form_handle.serialize();
			


			$('#result_space').empty().html("<center>"+loading_gif+"</center>");

			form_handle.CliqsStudioAjaxifyForms({'data':data},function(){

				var data = JSON.parse(localStorage.response);

				if(data != -1){


					if (data.msg ==1) {


						
						url = UserAbsPath+'StreamController/stream_fetchstudentfordept.php';
						
						var faculty_id = $('input#faculty_id').val();
						var department_id = $('input#department').val();

						$.post(url,{'faculty_id':faculty_id,'department_id':department_id},function(data){
							

							$('table#studentdata tbody').empty().html(data);
							$('#result_space').empty();

						});
					
					

					}else{
						$('#result_space').empty().html(data.msg);	
					}
					

				}else{
					$('#result_space').empty().html("");					
				}

				localStorage.removeItem("response");

				 //End Callback 

			});
		},

		getstudentdata:function(e){

			url = UserAbsPath+'StreamController/stream_fetchstudentforothers.php';
						
						var faculty_id = $('input#faculty_id').val();
						var department_id = $('input#department').val();

						$.post(url,{'faculty_id':faculty_id},function(data){
							
							$('table#studentdata tbody').empty().html(data);
							$('#result_space').empty();

						});

		},

		getcouursesregistered:function(){


			var studdata = $(this).data('student_id');
			//console.log(localStorage.lecdata);
		
			$('div#DialogModalForAssignedCourses').css({'display':'block'});

			url = UserAbsPath+'StreamController/stream_fetchregisteredcourse.php';
						
						var department_id = $('input#department').val();
						
						$('div#DialogModalForCoursesRegistered table tbody').empty().html('<center>'+loading_gif+'</center>');

						$.post(url,{'department_id':department_id,'student_id':studdata},function(data){
							
							$('div#DialogModalForAssignedCourses').find('table tbody').empty().html(data);
							$('#result_space').empty();

						});
		},

		remove_prerequisite:function(e){

			e.preventDefault();

			url = UserAbsPath+'StreamController/stream_deletefacultycourseprerequisite.php';
						
			var delete_handle = $(this);

			var course_id = delete_handle.data('course_id');
			
			$.post(url,{'course_id':course_id},function(data){

				console.log(data);
				data = JSON.parse(data);

				if (data.msg == 1) {

					url = UserAbsPath+'StreamController/stream_fetchcourse.php';
						
						var faculty_id = $('input#faculty_id').val();

						$.post(url,{'faculty_id':faculty_id,'parser':1},function(data){
							
							$('table#coursedata tbody').empty().html(data);
							$('#result_space').empty();

						});
					

				}else{

					alert(data.msg);

				}


			});
		},

		register_course_stud:function(e){
			
			e.preventDefault();
			
			var url = UserAbsPath+'StreamController/stream_registercourse.php';
						
						
						var course_id = $(this).data('course_id');


						
						var sess_id = $('input#session_id').val();

						$('p#result_space').empty().html(loading_gif);
						$.post(url,{'session_id':sess_id,'course_id':course_id},function(data){
							
							data = JSON.parse(data);
							
							if(data.msg == 1){

								alert('Course Added');

							}else{

								
								alert(data.msg);
							}
							$('p#result_space').empty();
						});
		},

		unregister_course_stud:function(e){
			
			e.preventDefault();

			var url = UserAbsPath+'StreamController/stream_unregistercourse.php';
						
						
						var course_id = $(this).data('course_id');
						var sess_id = $('input#session_id').val();

						$('p#result_space').empty().html(loading_gif);
						$.post(url,{'session_id':sess_id,'course_id':course_id},function(data){
							data = JSON.parse(data);
							

							if(data.msg == 1){

								alert('Course removed');

							}else{
								
								alert(data.msg);
							}
							$('p#result_space').empty();
						});
		},

		remove_venue:function(e){
			e.preventDefault();


			url = UserAbsPath+'StreamController/stream_deletevenue.php';
						
			var delete_handle = $(this);

			var venue_id = delete_handle.data('venue_id');
			
			$.post(url,{'venue_id':venue_id},function(data){

				
				data = JSON.parse(data);

				if (data.msg == 1) {
					$('#table_space').empty().html(loading_gif);
					url = UserAbsPath+'StreamController/stream_fetchvenue.php';
						
						var faculty_id = $('input#faculty_id').val();
						
						$.post(url,{'faculty_id':faculty_id},function(data){
							
							$('table#venuedata tbody').empty().html(data);
							$('#table_space').empty();

						});
					

				}else{

					//alert(data.msg);

				}


			});


		}





		
	},

	rank = {

		

	},

	registrar_lock = {

		


	},

	pageActivity = {

		
		LoadLogin : function(e){

			$(this).find('p#feedback').empty();

			var url = UserPath+'StreamController/getLoginForm.php';
			
			$.get(url,{},function(data){

				$('replaceit#firstPage').empty().html(data);

			});
			
		}

		


	},

	users = {

		

		

		
		
	

		transfer_user_profile_pix:function(e){

			$('#mediaPreviewBox').empty().html('<center>'+loading_gif+'</center>');

			$(this).CliqsStudioFileTransfer({},function(){

				data = $('#HiddenCliqsStudioFeedback').html();
						
				if(data!=99 && data!=100 && data!=101){

					
					$('#mediaPreviewBox').empty().html(data);

				}else if(data==99){

					$('input#changeProfilePix').val('');
					$('#mediaPreviewBox').empty().html('<center> Error Sending File, Try Again</center>');
				
				}else if(data==100){
					
					$('input#changeProfilePix').val('');
					$('#mediaPreviewBox').empty().html('<center> File too large, Try to uplaod A 5 Mb file size, Try Again</center>');
				
				}else if(data==101){
					
					$('input#changeProfilePix').val('');
					$('#mediaPreviewBox').empty().html('<center>Incompatible File type: Try to uplaod A gif,jpeg or png token</center>');
				
				}
			});

			//$('#HiddenCliqsStudioFeedback').remove();
		},

		

	}


	




	/*--------------BINDERS--------------------- */
	$('input#file').on('change',admin.upload_file);
	
	$('button#btnAddAdmin').bind('click',registration.process_admin_registration);
	$('button#btnAddAdminAtDeptLevel').bind('click',registration.process_admin_registration_at_dept_level);
	
	$('button#login_admin').bind('click',login.process_admin_login);
	$('button#login_student').bind('click',login.process_admin_login2);
	

	$('button#btnAddFaculty').bind('click',cpaneltask.addfaculty);
	$('button#btnAddDept').bind('click',cpaneltask.adddepartment);
	$('button#btnJoinSession').bind('click',cpaneltask.joinsession);
	$('button#btnAssignVenue').bind('click',cpaneltask.assignvenue);
	$('button#btnAddCourse').bind('click',cpaneltask.addcourse);
	$('button#btnAddCoursedept').bind('click',cpaneltask.addcoursedept);
	$('button#btnRegisterStudent').bind('click',cpaneltask.addstudent);
	

	
	$('table#coursedata tbody').on('dblclick','tr td a#deletecourseEventListener',cpaneltask.remove_course);
	$('table#coursedata tbody').on('click','tr td a#deletecoursepreqEventListener7',cpaneltask.remove_prerequisite);
	$('table#venuedata tbody').on('dblclick','tr td a#deletevenueEventListenue',cpaneltask.remove_venue);

	
	$('table#coursedata tbody').on('dblclick','tr td a#deletecourseEventListener2',cpaneltask.remove_course_dept);
	$('table#coursedata2 tbody').on('click','tr td a#iregistercourseEventListener18',cpaneltask.register_course_stud);
	$('table#coursedata2 tbody').on('click','tr td a#registercourseEventListener18',cpaneltask.unregister_course_stud);
	

	

	$('div#DialogModalForCourses table tbody').on('dblclick','tr td a#assigncoursetolecturerEventListener3',cpaneltask.assignandgetunassignedcourses);
	$('table#lecdata tbody').on('dblclick','tr td a#assigncoursetolecturerEventListener',cpaneltask.open_course_modal);
	$('table#lecdata tbody').on('dblclick','tr td a#assignedcoursetolecturerEventListener4',cpaneltask.open_assigned_course_modal);
	$('table#studentdata tbody').on('dblclick','tr td a#courseregisterEventListener6',cpaneltask.getcouursesregistered);


	
	$('div#DialogModalForAssignedCourses table tbody').on('dblclick','tr td a#unassigncoursetolecturerEventListener5',cpaneltask.unassign_course);
	

	$('table#deptdata tbody').on('dblclick','tr td form label a#updatedeptEventListener',cpaneltask.open_hidden_rename_form_form);
	$('table#deptdata tbody').on('submit','tr td form',cpaneltask.update_dept);
	

	
	//$('table').on('dblclick','td#branch_category_row',group.open_subgroup_modal);

	

});