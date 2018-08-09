$(function(){

	var loading_gif = '<img src="/app/CliqsStudio/view/presentation_core/admin/images/loading1.gif" width="20px">';
	var cancel_gif = '<img src="/app/CliqsStudio/view/presentation_core/admin/images/cancel.png" width="20px">';


	admin = {

		password_length:function(e){
		
			var pass_obj = $('input#Password').val();

			var regex = new RegExp(/[0-9!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/? ]/g);
			
			if(pass_obj.length > 8){

				if(regex.test(pass_obj) === true){

					$('span#passwordNotice small').empty();
					$('input#ConfirmPassword').removeAttr('disabled');

				}else{
					
					$('span#passwordNotice small').empty().html("Too Weak Password");
					$('input#ConfirmPassword').removeAttr('disabled');				 
				}
		
			}else{
				
				$('span#passwordNotice small').empty().html("Password must be at least 8");
				$('input#ConfirmPassword').attr('disabled','disabled');
			
			}
		
		
		},


		check_if_field_empty:function(e){

			e.preventDefault();
			cur_obj = $(this).val();
			
			if (cur_obj.length > 0) {

				$('button#login_admin').removeAttr('disabled');	
			
			}else{
				$('button#login_admin').attr('disabled','disabled');
			}
		},

		open_create_group_modal:function(e){

			e.preventDefault();
			$('#createGroupModal').css({'display':'block'});

		},

		open_invite_request_modal:function(e){

			e.preventDefault();
			$('#InviteRequestModal').css({'display':'block'});

		},

		open_private_chat_box_modal:function(e){

			e.preventDefault();
			$('#PrivateChatBoxModal').css({'display':'block'});
		},

		open_dialog_send_send_box_of_file_transfer:function(e){

			e.preventDefault();
			$('#DialogSendBoxOfFileTransfer').css({'display':'block'});

		},

		open_create_rank_modal:function(e){

			e.preventDefault();
			$('#createRankModal').css({'display':'block'});

		},

		confirm_password_equality:function(e){

			/*e.preventDefault();*/
			var pass_obj = $('input#Password').val(),
			conf_pass_obj = $('input#ConfirmPassword').val();
			
			

			if(typeof(pass_obj) != 'undefined' && typeof(conf_pass_obj) !='undefined'){
				
				
				
				if(pass_obj == conf_pass_obj){

					$('#result_space').html("<center><p class='w3-padding w3-margin w3-round w3-blue'>Good</p></center>");
					$('button#register_admin').removeAttr('disabled');

				}else{

					$('#result_space').empty().html("<center><p class='w3-red w3-padding w3-margin w3-round'>Password Not Match</p></center>");
					$('button#register_admin').attr('disabled','disabled');

				}

			}
		},

		open_form_beside_group_and_hide_group_name_then_load_group_into_opened_form:function(e){

			e.preventDefault();

			cur_obj_val=$(this).find('e').text();
			input_box = $(this).find('form').css({'display':'block'});
			$(this).find('e').css({'display':'none'});
			$(this).append(input_box).find('input').val(cur_obj_val);

		},

		get_equivalent_rating_bar:function(e){

			e.preventDefault();

			var cur_obj_val = $(this).val();

			if (cur_obj_val >= 0 && cur_obj_val <=50) {

				var percent = cur_obj_val/50 * 100;

				$('#rating_bar').css({'width':percent+'%','background':'#2196F3'}).empty().html("<center><a class='w3-margin w3-round'>"+percent+"%</a></center>");

			}
		},

		open_promote_users_modal:function(e){
			e.preventDefault();
			$('#promoteUserModal').css({'display':'block'});
			$('input#tmp_user_id').attr('value',$(this).data('user_id'));

			$('input#tmp_op_code').attr('value',$(this).data('order'));
		},

		open_basic_info_update_form:function(e){

			$('#DialogBasicInfoUpdateFormBox').css({'display':'block'});
		}

		


	}

	
		


	/*-----------------Binders--------------------*/
	$('input#EmailOnAdminLogin').bind('keyup',admin.check_if_field_empty);
	$('input#PasswordOnAdminLogin').bind('keyup',admin.check_if_field_empty);
	$('input#ConfirmPassword').bind('keyup',admin.confirm_password_equality);
	$('input#Password').bind('keyup',admin.password_length);
	$('#btn_open_createGroup').bind('click',admin.open_create_group_modal);
	$('#btn_open_createRank').bind('click',admin.open_create_rank_modal);
	$('table').on('dblclick','td#root_cat_row',admin.open_form_beside_group_and_hide_group_name_then_load_group_into_opened_form);
	$('input#rank_rating').on('change',admin.get_equivalent_rating_bar);
	$('table tbody').on('click','a#migrate_user',admin.open_promote_users_modal);
	$('a#openInviteUserModal').on('click',admin.open_invite_request_modal);
	$('button#openDialogSendBoxOfFileTransfer').on('click',admin.open_dialog_send_send_box_of_file_transfer);
	$('a#openInviteUserModal').on('click',admin.open_invite_request_modal);
	$('ul#admindiscussionparticipants').on('click','li#openPrivateMessageModal',admin.open_private_chat_box_modal);
	$('button#OpenUpdateBasicInfoForm').on('click',admin.open_basic_info_update_form);
	$('button#btnChangeProfilePix').on('click',admin.open_dialog_send_send_box_of_file_transfer);
	
});