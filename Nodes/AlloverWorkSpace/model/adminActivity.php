<?php
	
	
	use \CliqsStudio\model\CQS_Model;
	use \CliqsStudio\service\CQS_Database;
	use \CliqsStudio\service\CQS_BuildQuery;
	use \CliqsStudio\config\CQS_Config;
	use \CliqsStudio\service\CQS_Security;
	use \CliqsStudio\service\CQS_Mailer;
	use \CliqsStudio\service\CQS_Session;
	use \CliqsStudio\service\CQS_Logger;
	use \CliqsStudio\service\CQS_Redirect;
	
	if(is_readable('Nodes/AlloverWorkSpace/controller/constants.php')){
		include_once('Nodes/AlloverWorkSpace/controller/constants.php');
	}else{
		include_once('../controller/constants.php');
	}
	
	
	class adminActivity extends CQS_Model{

		private $con_handle_details = ['database'=>'allover_reg'];
		
		public $CQSUserPath = null;
		public $CQSPath = null;

		public function __construct(){

			$parent = new parent;

			$this->CQSUserPath	=	$parent->CQSUserPath;
			$this->CQSPath	=	$parent->CQSPath;
		

		}

		public function create_account($fname,$mname,$lname,$username,$password,$faculty){


			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
		
			/*pg*/
			$paginate = 3;


			$security = new CQS_Security;
			$SQL = new CQS_BuildQuery;
			$Logger = new CQS_Logger;
			
			//Encode Password Generate a 8bit Key
			$Encoded = $security->Encode($password);
			

 			$realkey = $security->encryptPassword($Encoded,12);
 			

			if(strlen($realkey) >  0){
				
				$rs=$SQL->readEx($handle,'admin',[['username','=',$username]],[]);
					
				if($rs->rowCount() == 0){

					if($SQL->create($handle,'admin',[' ','faculty',$faculty,0,$username,$realkey,$fname,$mname,$lname])){

						
						echo json_encode(["msg"=>"<center><p class='w3-green w3-padding w3-margin w3-round'>Admin Account Created</p>"]);

					}else{
			
						$Logger->checkLive("Admin Registration Failed");
						echo json_encode(["msg"=>"<center><p class='w3-red w3-padding w3-margin w3-round'>Server Error: Couldn't Complete Registration</p>"]);
						
					}


				}else{
					echo json_encode(["msg"=>"<center><p class='w3-red w3-padding w3-margin w3-round'>User Already Existing, Suggest Using Alternative Username</p>"]);
					
				}
		
			}else{

				$Logger->checkLive("Couldn't Complete Encoding on line ".__LINE__." on File ".__FILE__." from class ".__CLASS__);
				echo json_encode(["msg"=>"<center><p class='w3-red w3-padding w3-margin w3-round'>Server Error: Couldn't Complete Registration</p>"]);

			}
		
		}

		public function create_student_account($matric,$fname,$mname,$lname,$dob,$password,$faculty,$department,$level,$semester){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
		
			/*pg*/
			$paginate = 3;


			$security = new CQS_Security;
			$SQL = new CQS_BuildQuery;
			$Logger = new CQS_Logger;
			
			//Encode Password Generate a 8bit Key
			$Encoded = $security->Encode($password);
			

 			$realkey = $security->encryptPassword($Encoded,12);
 			

			if(strlen($realkey) >  0){
				
				$rs=$SQL->readEx($handle,'student',[['student_mat_no','=',$matric]],[]);
					
				if($rs->rowCount() == 0){

					$status = 'undergraduate';
					$sess_id = $_SESSION['academic_session'];

					if($SQL->create($handle,'student',[' ',$faculty,$department,$matric,$dob,$fname,$mname,$lname,$level,$semester,$realkey,$status,$sess_id,$sess_id])){

						
						echo json_encode(["msg"=>1]);

					}else{
			
						$Logger->checkLive("Admin Registration Failed");
						echo json_encode(["msg"=>"<center><p class='w3-red w3-padding w3-margin w3-round'>Server Error: Couldn't Complete Registration</p>"]);
						
					}


				}else{
					echo json_encode(["msg"=>"<center><p class='w3-red w3-padding w3-margin w3-round'>Matric. No. Already Existing</p>"]);
					
				}
		
			}else{

				$Logger->checkLive("Couldn't Complete Encoding on line ".__LINE__." on File ".__FILE__." from class ".__CLASS__);
				echo json_encode(["msg"=>"<center><p class='w3-red w3-padding w3-margin w3-round'>Server Error: Couldn't Complete Registration</p>"]);

			}

		}


		public function create_account_for_dept($fname,$mname,$lname,$username,$password,$priority,$faculty,$department){


			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
		
			/*pg*/
			$paginate = 3;


			$security = new CQS_Security;
			$SQL = new CQS_BuildQuery;
			$Logger = new CQS_Logger;
			
			//Encode Password Generate a 8bit Key
			$Encoded = $security->Encode($password);
			

 			$realkey = $security->encryptPassword($Encoded,12);
 			

			if(strlen($realkey) >  0){
				
				$rs=$SQL->readEx($handle,'admin',[['username','=',$username]],[]);
					
				if($rs->rowCount() == 0){

					$rs = $SQL->readEx($handle,'admin',[['department_id','=',$department,'AND'],['admin_capability','=','HODdepartment']],[]);
					
					if($rs->rowCount() == 1 && $priority == 'HODdepartment'){
						$priority = 'Lecturer';
					}

					if($SQL->create($handle,'admin',[' ',$priority,$faculty,$department,$username,$realkey,$fname,$mname,$lname])){

						
						echo json_encode(["msg"=>"<center><p class='w3-green w3-padding w3-margin w3-round'>$priority Account Created</p>"]);

					}else{
			
						$Logger->checkLive("Admin Registration Failed");
						echo json_encode(["msg"=>"<center><p class='w3-red w3-padding w3-margin w3-round'>Server Error: Couldn't Complete Registration</p>"]);
						
					}


				}else{
					echo json_encode(["msg"=>"<center><p class='w3-red w3-padding w3-margin w3-round'>User Already Existing, Suggest Using Alternative Username</p>"]);
					
				}
		
			}else{

				$Logger->checkLive("Couldn't Complete Encoding on line ".__LINE__." on File ".__FILE__." from class ".__CLASS__);
				echo json_encode(["msg"=>"<center><p class='w3-red w3-padding w3-margin w3-round'>Server Error: Couldn't Complete Registration</p>"]);

			}
		
		}

		public function reset_account($email,$plainpass){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];

			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			//Encode Password Generate a 8bit Key
			$Encoded=$security->Encode($plainpass);

			$rs = $SQL->readEx($handle,'admin',[['username','=',$email]],['admin_id']);
				
			list($uid) = $rs->fetch();

			$realkey = $security->encryptPassword($Encoded,12);

			$rs = $SQL->updateEx($handle,'admin',[['admin_id','=',$uid]],[['password',$realkey]]);

			if ($rs == 1) {
				echo "Password reset";
			}else{
				echo "Operation Failed, Username may be wrong";
			}


		}

		public function login_account($email,$plainpass){


			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			//Encode Password Generate a 8bit Key
			$Encoded=$security->Encode($plainpass);
			
			
				$rs = $SQL->readEx($handle,'admin',[['username','=',$email]],['admin_id','password','admin_capability']);
				
				list($uid,$ukey,$rank) = $rs->fetch();

				if (password_verify($Encoded,$ukey) === true) {
					
					CQS_Session::buildSession([['uid',$uid],['rank',$rank],['browser',$_SERVER['HTTP_USER_AGENT']],['active',1]]);
					
					echo json_encode(["msg"=>1]);


				}else{

					echo json_encode(["msg"=>"<a class='w3-red w3-padding'>Incorrect Login Credentials</a>"]);
				}
		}


		public function getAccountDetails($uid){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;

			$rs = $SQL->readEx($handle,'admin',[['admin_id','=',$uid]],['admin_first_name','admin_middle_name','admin_last_name','admin_capability','faculty_id','department_id']);
			list($fname,$mname,$lname,$rank,$faculty_id,$d_id) = $rs->fetch();


			$rs = $SQL->readEx($handle,'faculty',[['faculty_id','=',$faculty_id]],['faculty_name']);
			list($faculty) = $rs->fetch();


			$department = "Null";

			if($d_id != 0){
				$rso = $SQL->readEx($handle,'department',[['department_id','=',$d_id]],['department_name']);
				list($department) = $rso->fetch();
			}
			
			$department_id = $d_id;

			return ['name'=>"$fname $mname $lname",'rank'=>$rank,'faculty'=>$faculty,'faculty_id'=>$faculty_id,'department'=>$department,'department_id'=>$department_id];

		}


		public function updateAccountPassword($oldpassword,$newpassword){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;


			$uid = $_SESSION['uid'];

			$rs = $SQL->readEx($handle,'users',[['uid','=',$uid]],['ukey']);
			list($ukey) = $rs->fetch();

			//Encode Password Generate a 8bit Key
			$Encoded=$security->Encode($oldpassword);
			
			if (password_verify($Encoded,$ukey) == true) {
				//Encode Password Generate a 8bit Key
				$Encoded=$security->Encode($newpassword);
				
				
				$new_hashed_pass = $security->encryptPassword($Encoded,17);
 				
 				$rs = $SQL->updateEx($handle,'users',[['uid','=',$uid]],[['ukey',$new_hashed_pass]]);
 				if ($rs != 0) {
 					$this->logout_account();	
 				}else{
 					echo "Password not Changed";
 				}

			}else{

				echo "Wrong Password, verify your old Password";
			}	


		}

		public function logout_account(){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;

			$session = new CQS_Session();


			$user_id = $session->getSession('uid');

			$session->deleteSession('uid');
			$session->deleteSession('active');
			$session->deleteSession('browser');
			$session->deleteSession('rank');

			$rs = $SQL->updateEx($handle,'users',[['admin_id','=',$user_id]],[['active',0]]);
			
			$url	= $GLOBALS['AlloverAbsLinkPath'];
		
			if ($rs != 0) {
	
				new CQS_Redirect($url);
	
			}else{

				$Logger = new CQS_Logger;
				$Logger->checkLive("Server Error, Couldn't activate User Logout");
				new CQS_Redirect($url);
	
			}
	
		}
	} 

?>