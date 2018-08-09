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
	
	class cpaneltask extends CQS_Model{

		private $con_handle_details = ['database'=>'allover_reg'];
		
		public $CQSUserPath = null;
		public $CQSPath = null;

		public function __construct(){

			$parent = new parent;

			$this->CQSUserPath	=	$parent->CQSUserPath;
			$this->CQSPath	=	$parent->CQSPath;
		

		}

		public function create_account($username,$email,$password){


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
			

 			$realkey = $security->encryptPassword($Encoded,17);
 			

			if(strlen($realkey) >  1){
				
				$rs=$SQL->readEx($handle,'users',[['email','=',$email]],[]);
					
				if($rs->rowCount() == 0){

					if($SQL->create($handle,'users',[' ',$username,$email,$realkey,' ',0,0,0,2,'default.png',0,' '])){

						
						$token = sha1($Encoded);

						$SQL->create($handle,'tok',[null,$email,$token]);
						
						
						echo json_encode(["msg"=>"<center><p class='w3-green w3-padding w3-margin w3-round'>Admin Account Created</p>"]);

					}else{
			
						$Logger->checkLive("Couldn't Send Data to Users table for Registration");
						echo json_encode(["msg"=>"<center><p class='w3-red w3-padding w3-margin w3-round'>Server Error: Couldn't Complete Registration</p>"]);
						
					}


				}else{
					echo json_encode(["msg"=>"<center><p class='w3-red w3-padding w3-margin w3-round'>User Already Existing, Suggest Using Alternative E-mail</p>"]);
					
				}
		
			}else{

				$Logger->checkLive("Couldn't Complete Encoding on line ".__LINE__." on File ".__FILE__." from class ".__CLASS__);
				echo json_encode(["msg"=>"<center><p class='w3-red w3-padding w3-margin w3-round'>Server Error: Couldn't Complete Registration</p>"]);

			}
		
		}

		public function add_faculty($faculty){


			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			$rs = $SQL->create($handle,'faculty',['',$faculty]);

			if ($rs != 0) {
				echo json_encode(["msg"=>1]);
			}else{

				echo json_encode(["msg"=>"Server Error, Couldnt Add Faculty"]);
			}

		}

		public function facultydata($rank){


			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			if ($rank == 'backdoor') {
				
				$rs = $SQL->readEx($handle,'faculty',[['faculty_id','!=',0]],['faculty_id','faculty_name']);
				
				$tableData = null; $i=1;
				while (list($fac_id,$fac_name) = $rs->fetch()) {
					

					$rs_1 = $SQL->readEx($handle,'admin',[['faculty_id','=',$fac_id]],['faculty_id']);
					$no_of_admin = $rs_1->rowCount();

					$fac_name = ucwords($fac_name);
					$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
					$tableData .= "<tr class='w3-border-bottom'>	<td>$i</td> <td><a target='_new' href='$absLinkPath/cpanel/addadmin/$fac_id' style='text-decoration:none;'>$fac_name</a></td> <td>$no_of_admin Admin(s) </td> </tr>";
					
					$i+=1;

				}

				return $tableData;
				
			}
			
		}


		public function facultyname($fac_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			$rs = $SQL->readEx($handle,'faculty',[['faculty_id','=',$fac_id]],['faculty_name']);
			list($facultyname) = $rs->fetch();

			return $facultyname; 

		}
		

		public function getAllAcademicSession($faculty_id,$dept_id= null){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];

			$rs = $SQL->readEx($handle,'session',[['faculty_in','LIKE',"%$faculty_id%"]],['session_id','session_name']);
			$academic_session = null;

			if ($_SESSION['rank'] == 'HODdepartment') {
				while (list($session,$session_name) = $rs->fetch()) {
					$academic_session .= "<a style = 'text-decoration:none;' class='w3-bar-item w3-margin w3-tag w3-grey' href='{$absLinkPath}cpanel/opensession/$session/$faculty_id/$dept_id'>$session_name</a>";
				}	
			}else{

				while (list($session,$session_name) = $rs->fetch()) {
					$academic_session .= "<a style = 'text-decoration:none;' class='w3-bar-item w3-margin w3-tag w3-grey' href='{$absLinkPath}cpanel/opensession/$session/$faculty_id'>$session_name</a>";
				}

			}

			return $academic_session;
		}


		public function join_or_create_academic_session($academic_session,$faculty_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];

			$rs = $SQL->readEx($handle,'session',[['session_name','=',$academic_session]],['session_id','faculty_in']);

			if($rs->rowCount() == 1){

				list($session_id,$faculty_in) = $rs->fetch();
				

				if($faculty_in[0] != $faculty_id || strpos($faculty_in, $faculty_id) === false){
					$faculty_in .= $faculty_id.";";
				}

				$rs = $SQL->updateEx($handle,'session',[['session_id','=',$session_id]],[['faculty_in',$faculty_in]]);
				if ($rs>0) {
					
					//load session
					echo json_encode(["msg"=>1]);

				}else{

					echo json_encode(["msg"=>"Already Joined Session"]);
				}
			
			}else if ($rs->rowCount() == 0) {
				$faculty_id .=";";
				$rs = $SQL->create($handle,'session',[' ',$faculty_id,$academic_session]);
				if ($rs>0) {
					
					//load session
					echo json_encode(["msg"=>1]);

				}else{

					echo json_encode(["msg"=>"Couldn't Join Session"]);
				}
			}

		}

		public function sessiondata($sess_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			$rs = $SQL->readEx($handle,'session',[['session_id','=',$sess_id]],['session_name']);
			list($session_name) = $rs->fetch();

			return ['session_id'=>$sess_id,'session_name'=>$session_name];
		}	

		public function add_department($department,$faculty_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			//$Logger = new CQS_Logger;

			$rs = $SQL->create($handle,'department',[' ',$faculty_id,$department,'NULL']);

			if ($rs > 0) {
				echo json_encode(["msg"=>1]);
			}else{

				echo json_encode(["msg"=>"Server Error, Couldnt add department"]);
			}

		}

		public function update_department($department,$update_id){


			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			//$security = new CQS_Security;
			//$Logger = new CQS_Logger;

			$rs = $SQL->updateEx($handle,'department',[['department_id','=',$update_id]],[['department_name',$department]]);
			
			if ($rs == 1) {
				echo json_encode(["msg"=>1]);
			}else{

				echo json_encode(["msg"=>"Server Error, Couldnt update department"]);
			}	
			
		}


		public function departmentdata($faculty_id){


			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			if ($_SESSION['rank'] == 'faculty') {
				
				$rs = $SQL->readEx($handle,'department',[['faculty_id','=',$faculty_id]],['department_id','department_name']);
				
				$tableData = null; $i=1;
				while (list($dept_id,$dept_name) = $rs->fetch()) {
					
					
					$rs_1 = $SQL->readEx($handle,'admin',[['department_id','=',$dept_id]],[]);
					$no_of_admin = $rs_1->rowCount();

					$dept_name = ucwords($dept_name);
					$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
					
					$absPath = $GLOBALS['AlloverAbsPath'];

					$tableData .= "<tr class='w3-border-bottom'>
						
						<td> <form class='' action='{$absPath}StreamController/stream_updatedept.php' method='post'>
								<label><a id='updatedeptEventListener' title='Double-Click to rename department' class='w3-tag w3-grey' style='cursor:pointer;'>$i</a></label>
								<input type='hidden' name='updatedept' id='updatedept'>
								<input type='hidden' name='updateid' id='updateid' value='$dept_id'>
							</form></td> 
						
						<td>

							<a target='_new' href='$absLinkPath/cpanel/addadmin/$faculty_id/$dept_id' style='text-decoration:none;'>$dept_name</a>

						</td>

						<td>$no_of_admin Admin(s) </td> </tr>";
					
					$i+=1;

				}

				return $tableData;
				
			}
			
		}

		public function coursedata($session_id,$faculty_id,$dept_id=null){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			if ($_SESSION['rank'] == 'faculty') {
				
				$rs = $SQL->readEx
				(
					$handle,
					'course',
					[
						['faculty_id','=',$faculty_id,'AND'],
						['session_id','LIKE',"%$session_id%"]
					],
					['course_id','course_code','course_name','course_level_id','course_semester_id','faculty_id','department_id','course_unit','course_pre_requisite_id','addedby']
				);

			}else{

				$rs = $SQL->readEx
				(
					$handle,
					'course',
					[
						['department_id','=',$dept_id,'AND'],
						['session_id','LIKE',"%$session_id%"]
					],
					['course_id','course_code','course_name','course_level_id','course_semester_id','faculty_id','department_id','course_unit','course_pre_requisite_id','addedby']
				);

			}	

				$tableData = null; $i=1;
				while (list($c_id,$c_code,$c_name,$c_level_id,$c_semester_id,$faculty_id,$dept_id,$c_unit,$c_preq,$addedby) = $rs->fetch()) {
					

					$rs_1 = $SQL->readEx($handle,'level',[['id','=',$c_level_id]],['level']);
					list($level) = $rs_1->fetch();

					$rs_1 = $SQL->readEx($handle,'semester',[['id','=',$c_semester_id]],['semester']);
					list($semester) = $rs_1->fetch();
				
					$preq_code = null;

					$xi = null;
					if($c_preq != 'NULL'){
 								
	 						$rs_1 = $SQL->readEx($handle,'course',[['course_id','=',$c_preq]],['course_code']);
							list($preq_code) = $rs_1->fetch();

							$xi = "$preq_code&nbsp;<a id='deletecoursepreqEventListener7' data-course_id='$c_id' title='Click to remove prerequisite' class='w3-text-red w3-rounder' style='cursor:pointer;'><i class='fa fa-times'></i></a>	";						

	 				}
 					
 					//$preq_code = rtrim($preq_code,';');


					$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
					
					$absPath = $GLOBALS['AlloverAbsPath'];

					$i = 1;
					if ($_SESSION['rank'] == 'faculty') {

						$rs_1 = $SQL->readEx($handle,'department',[['department_id','=',$dept_id]],['department_name']);
						list($dept_name) = $rs_1->fetch();

						$dept_name = str_replace(' ', ' ', $dept_name);
						$idept_name = explode(' ',$dept_name);
						
						$dept_name = null;

						foreach ($idept_name as $value) {
							$dept_name .= strtoupper($value[0]);
	 					}
	 					
	 					$color = $addedby==1?'blue':'grey';
					
						$tableData .= "<tr class='w3-border-bottom w3-border-$color'>
						
						<td> 
								<a id='deletecourseEventListener' data-course_id='$c_id' title='Double-Click to remove course from current session' class='w3-tag w3-round' style='cursor:pointer;'><i class='fa fa-times'></i></a>

						</td> 
						
						<td>$c_name</td>

						<td>$c_code</td>

						<td>$c_unit</td>

						<td>$level</td>

						<td>$dept_name</td>

						<td>$xi</td> </tr>";

					}else if($_SESSION['rank'] == 'HODdepartment'){

						$tableData .= "<tr class='w3-border-bottom'>
						
						<td> 
								<a id='deletecourseEventListener2' data-course_id='$c_id' title='Double-Click to remove course from current session' class='w3-tag w3-round' style='cursor:pointer;'><i class='fa fa-times'></i></a>

						</td> 
						
						<td>$c_name</td>

						<td>$c_code</td>

						<td>$c_unit</td>

						<td>$level</td>

						<td>$semester</td>

						<td>$preq_code</td> </tr>";

				}else{


						$tableData .= "<tr class='w3-border-bottom'>
						
						<td> 
								<a><i class='fa fa-arrow-right'></i></a>

						</td> 
						
						<td>$c_name</td>

						<td>$c_code</td>

						<td>$c_unit</td>

						<td>$level</td>

						<td>$semester</td>

						<td>$preq_code</td> </tr>";

				}


			}

				return $tableData;
				
			
		}

		public function remove_course_preq($course_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
	
			$rs = $SQL->updateEx
			(
				$handle,
				'course',
				[
					['course_id','=',$course_id]
				],
				
				[
					['course_pre_requisite_id','NULL']
				]
			);

			if ($rs>0) {
				echo json_encode(["msg"=>1]);
			}else{
				echo json_encode(["msg"=>"Can't remove pre-requisite"]);
			}
		}

		public function studentdata($sess_id,$faculty_id,$dept_id=null){


			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			

			if ($_SESSION['rank'] == 'faculty') {
				
				$SQL->updateEx($handle,'student',[['student_faculty','=',$faculty_id,'AND'],['status','=','undergraduate','AND'],['session_id','=',$sess_id,'']],[['session_id',$sess_id]]);

				$rs = $SQL->readEx($handle,'student',[['student_faculty','=',$faculty_id,'AND'],['status','=','undergraduate','AND'],['session_id','=',$sess_id,'']],['student_id','student_dept','student_mat_no','student_dob','student_first_name','student_middle_name','student_last_name','student_level_id','student_semester_id','admitted']);
			}else{

				$SQL->updateEx($handle,'student',[['student_faculty','=',$faculty_id,'AND'],['status','=','undergraduate','AND'],['student_dept','=',$dept_id,'AND'],['session_id','=',$sess_id,'']],[['session_id',$sess_id]]);

				$rs = $SQL->readEx($handle,'student',[['student_faculty','=',$faculty_id,'AND'],['status','=','undergraduate','AND'],['student_dept','=',$dept_id,'AND'],['session_id','=',$sess_id,'']],['student_id','student_dept','student_mat_no','student_dob','student_first_name','student_middle_name','student_last_name','student_level_id','student_semester_id','admitted']);
			}

				$tableData = null; $i=1;
				while (list($s_id,$s_dept_id,$s_mat,$s_dob,$s_fname,$s_mname,$s_lname,$s_level_id,$s_semester_id,$admitted) = $rs->fetch()) {
					

					$rs_1 = $SQL->readEx($handle,'level',[['id','=',$s_level_id]],['level']);
					list($level) = $rs_1->fetch();

					$rs_1 = $SQL->readEx($handle,'session',[['session_id','=',$admitted]],['session_name']);
					list($admitted) = $rs_1->fetch();

					$rs_1 = $SQL->readEx($handle,'semester',[['id','=',$s_semester_id]],['semester']);
					list($semester) = $rs_1->fetch();

					$rs_1 = $SQL->readEx($handle,'department',[['department_id','=',$s_dept_id]],['department_name']);
					list($dept_name) = $rs_1->fetch();

 					$s_name = "$s_fname $s_mname $s_lname";

 					
					$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
					
					$absPath = $GLOBALS['AlloverAbsPath'];

					if ($_SESSION['rank'] == 'faculty') {
						$tableData .= "<tr class='w3-border-bottom'>
						
						<td> 
								<a id='courseregisterEventListener6' class='w3-tag w3-grey' title='Double-Click to Open course Registered' data-student_id='$s_id' style='text-decoration:none; cursor:pointer;'> $i </a>
						</td> 
						
						<td>$s_mat</td>

						<td>$s_name</td>

						<td>$level</td>

						<td>$semester</td>

						<td>$dept_name</td>

						<td>$s_dob</td>

						<td>$admitted</td>
						
						 </tr>";

					}else{

						$tableData .= "<tr class='w3-border-bottom'>
						
						<td> 
								<a id='courseregisterEventListener6' class='w3-tag w3-grey' title='Double-Click to Open course Registered' data-student_id='$s_id' style='text-decoration:none; cursor:pointer;'> $i </a>
						</td> 
						
						<td>$s_mat</td>

						<td>$s_name</td>

						<td>$level</td>

						<td>$semester</td>

						

						<td>$s_dob</td> 

						<td>$admitted</td></tr>
						";
						
					}

					$i+=1;


				}

				return $tableData;
				
		}

		public function getCourseOptionList($sess_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;
			
			$rs = $SQL->readEx($handle,'course',[['session_id','LIKE',"%$sess_id%"]],['course_id','course_name']);
			
			$OptionData = null;
			while(list($course_id,$course_name) = $rs->fetch()){

				$OptionData .= "<option value='$course_id'>$course_name</option>";

			}

			return $OptionData;			
		}

		public function getLevelOptionList(){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;
			
			$rs = $SQL->readEx($handle,'level',[['id','!=',0]],['id','level']);
			
			$OptionData = null;
			while(list($id,$level) = $rs->fetch()){

				$OptionData .= "<option value='$id'>$level</option>";

			}

			return $OptionData;			
		}

		public function getDepartmentOptionList($fac_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;
			
			$rs = $SQL->readEx($handle,'department',[['faculty_id','=',$fac_id]],['department_id','department_name']);
			
			$OptionData = null;
			while(list($department_id,$departmentname) = $rs->fetch()){

				$OptionData .= "<option value='$department_id'>$departmentname</option>";

			}

			return $OptionData;			
		}

		public function departmentname($dept_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			$rs = $SQL->readEx($handle,'department',[['department_id','=',$dept_id]],['department_name']);
			list($departmentname) = $rs->fetch();

			return $departmentname; 

		}

		public function add_venue($class_code,$class_name,$class_capacity,$class_assigned_to,$class_assignment_note,$faculty){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			
			$rs = $SQL->create($handle,'venue',[' ',$class_code,$class_assigned_to,$faculty,$class_assignment_note,$class_capacity,$class_name]);

			if ($rs > 0) {
				echo json_encode(["msg"=>1]);
			}else{

				echo json_encode(["msg"=>"Server Error, Couldnt add Venue"]);
			}


		}

		public function remove_venue($venue_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			$rs = $SQL->delete
			(
				$handle,
				'venue',
				[
					['venue_id','=',$venue_id]
				]
			);


			if ($rs > 0) {
				echo json_encode(["msg"=>1]);
			}else{

				echo json_encode(["msg"=>"Server Error, Couldnt add Venue"]);
			}
		}

		public function autoload_course($sess_id,$fac_id,$dept_id = null){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;
			
			$rs = $SQL->readEx($handle,'course',[['faculty_id','=',$fac_id]],['session_id']);			
			list($xsess_id) = $rs->fetch();

			$xsess_id .= $sess_id.';';

			if (is_null($dept_id)) {
				
				$rs = $SQL->updateEx($handle,'course',[['faculty_id','=',$fac_id]],[['session_id',$xsess_id]]);			
			
			}else{

				//$rs = $SQL->updateEx($handle,'course',[['department_id','=',$dept_id]],[['session_id',$xsess_id]]);			
			
			}

		}


		public function create_course($course_title,$course_code,$course_unit,$course_preq,$faculty,$department,$level,$semester){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			$sess_id = $_SESSION['academic_session'].';';

			$added = 0;
			if($_SESSION['rank']=='faculty'){

				$added = 1;
			}

			$rs = $SQL->create($handle,'course',[' ',$course_title,$course_code,$course_unit,'NULL',$course_preq,$level,$semester,$department,$faculty,$sess_id,$added]);

			if ($rs > 0) {
				echo json_encode(["msg"=>1]);
			}else{

				echo json_encode(["msg"=>"Server Error, Couldnt add Venue"]);
			}


		}

		public function getUnassignedcoursedata($sess_id,$department_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;
			

			$rs = $SQL->readEx($handle,'course AS c',[['c.department_id','=',$department_id]],['c.course_id','c.course_name','c.course_code','c.course_unit']);
			
			$tableData = null; $i=1;
			while(list($course_id,$course_name,$course_code,$course_unit) = $rs->fetch()){

				

				$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
					
				$absPath = $GLOBALS['AlloverAbsPath'];

				$rt = $SQL->readEx($handle,'assignment_tab',[['department_id','=',$department_id,'AND'],['course','=',$course_id,'AND'],['session_id','=',$sess_id]]);
				
				if($rt->rowCount() == 0){
						$tableData .= "<tr class='w3-border-bottom'>
							
							<td> <a id='assigncoursetolecturerEventListener3' class='w3-tag w3-grey' title='Double-Click to Assign course' data-course_id='$course_id' style='text-decoration:none; cursor:pointer;'>$i </a></td> 
							
							<td>$course_name</td>
							<td>$course_unit </td>
							<td>$course_code </td> </tr>";
						
						$i+=1;
					
				}


			}

			return $tableData;			

		} 

		public function getassignedcoursedata($department_id,$lecturer_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;
			
			$sess_id = $_SESSION['academic_session'];

			$rs = $SQL->readEx($handle,'assignment_tab',[['department_id','=',$department_id,'AND'],['lecturer','=',$lecturer_id,'AND'],['session_id','=',$sess_id]],['course']);
				
			
			$tableData = null; $i=1;
			while(list($course_id) = $rs->fetch()){

				

				$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
					
				$absPath = $GLOBALS['AlloverAbsPath'];

				$rt = $SQL->readEx($handle,'course',[['course_id','=',$course_id]],['course_name','course_code','course_unit']);
				list($course_name,$course_code,$course_unit) =  $rt->fetch();

				$tableData .= "<tr class='w3-border-bottom'>
					
					<td> <a id='unassigncoursetolecturerEventListener5' class='w3-tag w3-grey' title='Double-Click to Unssign course' data-course_id='$course_id' style='text-decoration:none; cursor:pointer;'>$i </a></td> 
					
					<td>$course_name</td>
					<td>$course_unit </td>
					<td>$course_code </td> </tr>";
				
				$i+=1;
			
			}

			return $tableData;			
		}

		public function getregisteredcourse($sess_id,$student_id){



			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;
			
			$sess_id = $_SESSION['academic_session'];

			$rs = $SQL->readEx($handle,'student_course_registration',[['student_id','=',$student_id,'AND'],['session_id','=',$sess_id]],['course_id','course_code','reg_date','completed_pre_req']);
				
			
			$tableData = null; $i=1;
			while(list($course_id,$course_code,$reg_date) = $rs->fetch()){

				date_default_timezone_set('Africa/Lagos');
				$reg_date=date('d M Y, h:m a',time());

				$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
					
				$absPath = $GLOBALS['AlloverAbsPath'];

				$rt = $SQL->readEx($handle,'course',[['course_id','=',$course_id]],['course_name','course_unit']);
				list($course_name,$course_unit) =  $rt->fetch();

				$tableData .= "<tr class='w3-border-bottom'>
					
					<td> <a> $i </a></td> 
					
					<td>$course_name</td>
					<td>$course_unit </td>
					<td>$course_code </td>
					<td>$reg_date </td>
					 </tr>";
				
				$i+=1;
			
			}

			return $tableData;			
		}

		public function assign_course($department_id,$lecturer_id,$course_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;
			
			$sess_id = $_SESSION['academic_session'];

			$rs = $SQL->readEx($handle,'assignment_tab',[['department_id','=',$department_id,'AND'],['lecturer','=',$lecturer_id,'AND'],['course','=',$course_id,'AND'],['session_id','=',$sess_id]]);
			if($rs->rowCount() == 0){

				$rs = $SQL->create($handle,'assignment_tab',[$department_id,$sess_id,$lecturer_id,$course_id]);
			
			}else{
				echo json_encode(["msg"=>"Can't Re-assign course"]);
			}

			if ($rs>0) {
				echo json_encode(["msg"=>1]);
			}else{
				echo json_encode(["msg"=>"Can't assign course, try again"]);
			}			
		}

		public function unassign_course($department_id,$lecturer_id,$course_id,$sessx_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;
			
			$rs = $SQL->delete($handle,'assignment_tab',[['department_id','=',$department_id,'AND'],['lecturer','=',$lecturer_id,'AND'],['course','=',$course_id,'AND'],['session_id','=',$sessx_id,''] ]);

			if ($rs>0) {
				echo json_encode(["msg"=>1]);
			}else{
				echo json_encode(["msg"=>"Can't unassign course"]);
			}
						
		}

		public function remove_course($course_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			
			$rs = $SQL->readEx($handle,'course',[['course_id','=',$course_id]],['session_id']);
			list($sess_id) = $rs->fetch();
			
			$msess_id = $_SESSION['academic_session'].';';
			$sess_id = str_replace($msess_id, '', $sess_id);


			if (strcmp($msess_id,$sess_id) == 0 || $sess_id== null) {
				$rs = $SQL->delete($handle,'course',[['course_id','=',$course_id]]);
			}else{
				$rs = $SQL->updateEx($handle,'course',[['course_id','=',$course_id]],[['session_id',$sess_id]]);
			}
			
			$SQL->delete($handle,'student_course_registration',[['course_id','=',$course_id]]);

			$rt = $SQL->readEx($handle,'lectures',[['course','LIKE',"%$course_id%"]],['lectures_id','course','venue','time']);
			while(list($lecture_id,$course,$venue,$time) = $rt->fetch()){

				$course=explode(';', $course);
				$venue=explode(';', $venue);
				$time=explode(';', $time);

				$v = null; $t = null; $c = null;
				foreach ($course as $i => $v) {
					
					$g = 1;

					if($course_id == $v){
						
						$venue[$i] = null;
						$time[$i] = null;
						$course[$i] = null;
						$g = null;
					}
					
					if($g != null){
						$v .= $venue[$i].';';
						$t .= $time[$i].';';
						$c .= $course[$i].';';
					}

				}

				$SQL->updateEx($handle,'lectures',[['lectures_id','=',$lecture_id]],[['course',$c],['venue',$v],['time',$t]]);

			}
			
			
			if ($rs != 0) {
				echo json_encode(["msg"=>1]);
			}else{
				echo json_encode(["msg"=>"Course not removed"]);
			}

		}

		public function venuedata($faculty_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;

			if ($_SESSION['rank'] == 'faculty') {
				
				$rs = $SQL->readEx($handle,'venue',[['venue_under_faculty_id','=',$faculty_id]],['venue_id','venue_alias','venue_assigned_to','venue_assignment_hint','venue_capacity','venue_name']);
				
				$tableData = null;
				while (list($v_id,$v_alias,$v_assigned_to,$v_assignment_hint,$v_capacity,$v_name) = $rs->fetch()) {
					
					if ($v_assignment_hint == 'Faculty') {
						
						$df = $SQL->readEx($handle,'faculty',[['faculty_id','=',$v_assigned_to]],['faculty_name']);
						list($assigned_to) = $df->fetch(); 
					
					}else{

						$df = $SQL->readEx($handle,'department',[['department_id','=',$v_assigned_to]],['department_name']);
						list($assigned_to) = $df->fetch();
					}

				
					$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
					
					$absPath = $GLOBALS['AlloverAbsPath'];

					$tableData .= "<tr class='w3-border-bottom'>
						
						<td><a class='w3-tag w3-round' title='Double-Click:remove venue' style='cursor:pointer;' id='deletevenueEventListenue' data-venue_id='$v_id'><i class='fa fa-times'></i></a></td>
						<td> 
								$v_alias
								
							</td> 
						
						

						<td>$v_capacity</td>

						<td>$assigned_to</td>";

				}

				return $tableData;
				
			}
		}


		public function lecturerdata($dept_id){


			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			if ($_SESSION['rank'] == 'HODdepartment') {
				
				$rs = $SQL->readEx($handle,'admin',[['department_id','=',$dept_id,'AND'],['admin_capability','=','Lecturer']],['admin_id','admin_first_name','admin_middle_name','admin_last_name']);
				
				$tableData = null; $i=1;
				while (list($admin_id,$fname,$mname,$lname) = $rs->fetch()) {
					
					$d = $SQL->readEx($handle,'assignment_tab',[['department_id','=',$dept_id,'AND'],['lecturer','=',$admin_id]],['course']);
					$no_of_course_assigned = $d->rowCount();

					$lec_name = "$fname $mname $lname";

					$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
					
					$absPath = $GLOBALS['AlloverAbsPath'];

					$tableData .= "<tr class='w3-border-bottom'>
						
						<td> <a id='assigncoursetolecturerEventListener' class='w3-tag' title='Double-Click to Assign course' data-lecturer_id='$admin_id' style='text-decoration:none;'>$i </a></td> 
						
						<td>$lec_name</td>

						<td><a id='assignedcoursetolecturerEventListener4' class='w3-tag w3-grey' title='Double-Click to Check Assigned courses' data-lecturer_id='$admin_id' style='text-decoration:none;'>$no_of_course_assigned </a></td> </tr>";
					
					$i+=1;

				}

				return $tableData;
				
			}
		}

		public function mycoursedata($admin_id){


			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;


			if ($_SESSION['rank'] == 'Lecturer') {
				
				$d = $SQL->readEx($handle,'assignment_tab',[['lecturer','=',$admin_id]],['course']);
					
				
				$sess_id = $_SESSION['academic_session'];

				$tableData = null; $i=1;
				while (list($course_id) = $d->fetch()) {
					
					$rs = $SQL->readEx($handle,'course',[['course_id','=',$course_id,'AND'],['session_id','LIKE',"%$sess_id%"]],['course_name','course_code','course_unit']);
					list($course_name,$course_code,$course_unit) = $rs->fetch();
					

					$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
					
					$absPath = $GLOBALS['AlloverAbsPath'];

					$tableData .= "<tr class='w3-border-bottom'>
						
						<td> $i</td> 
						
						<td>$course_name</td>
						<td>$course_unit</td>

						<td>$course_code</td> </tr>";

					
					$i+=1;

				}

				return $tableData;
				
			}
		}


		public function switchStudent($oldlevel,$oldsemester,$newlevel,$newsemester){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;

			if ($newlevel != 0) {
				
			
				$E=$SQL->updateEx($handle,'student',[['student_level_id','=',$oldlevel,'AND'],['student_semester_id','=',$oldsemester]],[['student_level_id',$newlevel],['student_semester_id',$newsemester]]);
			}else{

				$E=$SQL->updateEx($handle,'student',[['student_level_id','=',$oldlevel,'AND'],['student_semester_id','=',$oldsemester]],[['student_level_id','NULL'],['student_semester_id','NULL'],['status','graduate']]);
			}		

			if($E > 0){

				echo $E." Students has been moved";
			}else{

				echo "Operation Failed";
			}
			

		}


		public function exitsession($session_id,$faculty_id){

			$parent = new parent;
			$connection_array 	=	$parent->connect($this->con_handle_details);
			$handle = $connection_array[0];
			
			$SQL = new CQS_BuildQuery;
			$security = new CQS_Security;
			$Logger = new CQS_Logger;

			#in progress
		}



	} 

?>