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
	
	class studenttask extends CQS_Model{

		private $con_handle_details = ['database'=>'allover_reg'];
		
		public $CQSUserPath = null;
		public $CQSPath = null;

		public function __construct(){

			$parent = new parent;

			$this->CQSUserPath	=	$parent->CQSUserPath;
			$this->CQSPath	=	$parent->CQSPath;
		

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
			
			
				$rs = $SQL->readEx($handle,'student',[['student_mat_no','=',$email]],['student_id','password']);
				
				list($uid,$ukey) = $rs->fetch();


				if (password_verify($Encoded,$ukey) === true) {
					
					CQS_Session::buildSession([['uid',$uid],['browser',$_SERVER['HTTP_USER_AGENT']],['active',1]]);
					
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

			$rs = $SQL->readEx($handle,'student',[['student_id','=',$uid]],['student_mat_no','student_first_name','student_middle_name','student_last_name','student_dob','student_level_id,student_semester_id,student_dept,student_faculty','session_id','admitted','status']);

			list($mat,$fname,$mname,$lname,$dob,$level_id,$semester_id,$department_id,$faculty_id,$session_id,$admitted,$status) = $rs->fetch();

			$rs = $SQL->readEx($handle,'faculty',[['faculty_id','=',$faculty_id]],['faculty_name']);
			list($faculty) = $rs->fetch();

			$rs = $SQL->readEx($handle,'session',[['session_id','=',$session_id]],['session_name']);
			list($cur_session) = $rs->fetch();

			$rs = $SQL->readEx($handle,'session',[['session_id','=',$admitted]],['session_name']);
			list($admitted) = $rs->fetch();

			$rs = $SQL->readEx($handle,'level',[['id','=',$level_id]],['level']);
			list($level) = $rs->fetch();

			$rs = $SQL->readEx($handle,'semester',[['id','=',$semester_id]],['semester']);
			list($semester) = $rs->fetch();

			$status = strtoupper($status);


			$rs = $SQL->readEx($handle,'department',[['department_id','=',$department_id]],['department_name']);
			list($department) = $rs->fetch();
			

			return ['name'=>"$fname $mname $lname",'matric'=>$mat,'faculty'=>$faculty,'faculty_id'=>$faculty_id,'department'=>$department,'department_id'=>$department_id,'cur_session'=>$cur_session,'admitted'=>$admitted,'level'=>$level,'semester'=>$semester,'status'=>$status,'session_id'=>$session_id,'dob'=>$dob,'level_id'=>$level_id,'semester_id'=>$semester_id];

		}

		public function coursedata($session_id,$faculty_id,$dept_id,$level,$semester){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
			$uid = $_SESSION['uid'];

				$rs = $SQL->readEx
				(
					$handle,
					'course',
					[ 
						[
							 ['faculty_id','=',$faculty_id,'AND'],
							 ['addedby','=',1,'OR'],
							 ['department_id','=',$dept_id,'AND'],
						] ,
						['session_id','LIKE',"%$session_id%",'AND'],
						['course_level_id','=',$level,'AND'], 
						['course_semester_id','=',$semester,''] 
					], 

					['department_id','course_code','course_name','course_unit','course_pre_requisite_id','course_id']
				);

				$tableData = null;
				$i=1;
				while (list($dept_id,$c_code,$c_name,$c_unit,$c_preq,$course_id) = $rs->fetch()) {
				
					$preq_code = null;

					if($c_preq != 'NULL'){
 								
	 						$rs_1 = $SQL->readEx
	 						(
	 							$handle,
	 							'course',
	 							[
	 								['course_id','=',$c_preq]
	 							],
	 							['course_code']
	 						);
	 						
							list($preq_code) = $rs_1->fetch();

	 				}

	 				$rs_1 = $SQL->readEx($handle,'department',[['department_id','=',$dept_id]],['department_name']);
					list($department_name) = $rs_1->fetch();


					$rs_1 = $SQL->readEx
					(
						$handle,
						'student_course_registration',
						[
							['session_id','=',$session_id,'AND'],
							['student_id','=',$uid,'AND'],
							['course_id','=',$course_id]
						]
					);

					if ($rs_1->rowCount() == 1) {
						$registered = "<a><i class='fa fa-check-circle w3-text-green'></i></a>";
						$icon = "<a id='registercourseEventListener18' data-course_id='$course_id' title='Click to unregister' class='w3-tag w3-grey w3-padding' style='cursor:pointer;'><i class='fa fa-minus'></i></a>";
					}else{

						$registered = null;
						$icon = "<a id='iregistercourseEventListener18' data-course_id='$course_id' title='Click to register' class='w3-tag w3-grey w3-padding' style='cursor:pointer;'><i class='fa fa-plus'></i></a>";
					}
 					
 					//$preq_code = rtrim($preq_code,';');


					$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
					
					$absPath = $GLOBALS['AlloverAbsPath'];

					$i = 1;
					

						
					
						$tableData .= "<tr class='w3-border-bottom'>
						
						<td> 
								$icon

						</td> 
						
						<td>{$registered} $c_name</td>

						<td>$c_code</td>

						<td>$c_unit</td>

						<td>$department_name</td>

						<td>$preq_code</td> </tr>";

					


			}

				

				return $tableData;
				
			
		}

		public function register_course($session_id,$course_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;

			$uid = $_SESSION['uid'];

			$rs = $SQL->readEx
			(
				$handle,
				'course',
				[
					['course_id','=',$course_id]
				],
				['course_code','course_pre_requisite_id']
			);

			list($course_code,$course_preq) = $rs->fetch();

			$go_key = 1;

			if($course_preq != 'NULL'){

				$rs = $SQL->readEx
				(
					$handle,
					'student_course_registration',
					[
						['course_id','=',$course_id,'AND'],
						['student_id','=',$uid]
					]
				);

				if($rs->rowCount() == 0){
					$go_key = 0;
					
				}
			}

			if ($go_key == 1) {


				$rt = $SQL->readEx
				(
					$handle,
					'student_course_registration',
					[
						['session_id','=',$session_id,'AND'],
						['student_id','=',$uid,'AND'],
						['course_id','=',$course_id]
					]
				);

				if($rt->rowCount() == 0){

					date_default_timezone_set('Africa/Lagos');
					$reg_date = date(time());

					$rs = $SQL->create
					(
						$handle,
						'student_course_registration',
						[' ',$uid,$course_id,$course_code,$reg_date,'NULL',0,$session_id]
					);
				
					if($rs > 0){
						echo json_encode(["msg"=>1]);
					}else{

						echo json_encode(["msg"=>"Can't register course"]);
					}
				}else{
					echo json_encode(["msg"=>"Can't register course"]);
				}
				
			
			}else{

				echo json_encode(["msg"=>"Can't Register Course, Because of its pre-requisite"]);
			}

		}


		public function unregister_course($session_id,$course_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;

			$uid = $_SESSION['uid'];

			$rs = $SQL->delete
				(
					$handle,
					'student_course_registration',
					[
						['session_id','=',$session_id,'AND'],
						['student_id','=',$uid,'AND'],
						['course_id','=',$course_id]
					]
				);

			if ($rs > 0) {
				echo json_encode(["msg"=>1]);
			}else{
				echo json_encode(["msg"=>"Can't remove course"]);
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