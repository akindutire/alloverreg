<?php 

use \CliqsStudio\config\CQS_Config as CQS_Config;
use \CliqsStudio\controller\CQS_Controller as CQS_Controller;
use \CliqsStudio\service\CQS_Redirect as CQS_Redirect;
use \CliqsStudio\service\CQS_Logger as CQS_Logger;
use \CliqsStudio\service\CQS_Session as CQS_Session;
use \CliqsStudio\service\CQS_Sanitize as CQS_Sanitize;
use \CliqsStudio\service\CQS_Security as CQS_Security;
use \CliqsStudio\service\CQS_BuildQuery as CQS_BuildQuery; 
use \CliqsStudio\service\CQS_Database;

include_once('constants.php');
include_once('Nodes/AlloverWorkSpace/model/adminActivity.php');
include_once('Nodes/AlloverWorkSpace/model/cpaneltask.php');

class cpanel extends CQS_Controller{

	public $CQSUserPath = null;
	public $CQSPath = null;

	public function __construct(){

		$parent = new parent;

		$this->CQSUserPath = $parent->CQSUserPath;
		$this->CQSPath = $parent->CQSPath;

	}

	public function index(){

		if($_SESSION['uid']!=null && $_SESSION['rank']!=null){

			$adminActivity = new adminActivity;

			$cpaneltask = new cpaneltask;


			$absPath = $GLOBALS['AlloverAbsPath'];
			$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
			
			$adminDetails = $adminActivity->getAccountDetails($_SESSION['uid']);

			if($_SESSION['rank'] == 'backdoor'){
				
				$facultydata = $cpaneltask->facultydata($_SESSION['rank']);

				$OutputData = [$absPath,$absLinkPath,$adminDetails,$facultydata];		

				parent::View('cpanel.php',$OutputData);
			
			}else if ($_SESSION['rank'] == 'faculty') {

				$_SESSION['academic_session'] = null;

				$academic_sessions = $cpaneltask->getAllAcademicSession($adminDetails['faculty_id']);
				
				$OutputData = [$absPath,$absLinkPath,$adminDetails,$academic_sessions];

				parent::View('cpanelforfaculty.php',$OutputData);
			
			}else if ($_SESSION['rank'] == 'HODdepartment') {

				$_SESSION['academic_session'] = null;

				$academic_sessions = $cpaneltask->getAllAcademicSession($adminDetails['faculty_id'],$adminDetails['department_id']);

				$OutputData = [$absPath,$absLinkPath,$adminDetails,$academic_sessions];		

				parent::View('cpanelfordepartment.php',$OutputData);

			}else if ($_SESSION['rank'] == 'Lecturer') {
				
				$_SESSION['academic_session'] = null;

				$academic_sessions = $cpaneltask->getAllAcademicSession($adminDetails['faculty_id'],$adminDetails['department_id']);

				$OutputData = [$absPath,$absLinkPath,$adminDetails,$academic_sessions];		

				parent::View('cpanelfordepartment2.php',$OutputData);

			}else{
				#StudentAccount

			}

		}else{

			$this->logout();
		}

	}

	public function addadmin($fac_id,$dept_id = null){

		if($_SESSION['uid']!=null && $_SESSION['rank']!=null){

			$adminActivity = new adminActivity;

			$cpaneltask = new cpaneltask;

			$absPath = $GLOBALS['AlloverAbsPath'];
			$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
			
			$adminDetails = $adminActivity->getAccountDetails($_SESSION['uid']);
			$facultyname = $cpaneltask->facultyname($fac_id);

			if($_SESSION['rank'] == 'backdoor'){
				
				
				
				$OutputData = [$absPath,$absLinkPath,$adminDetails,$facultyname,$fac_id];		

				parent::View('addadmin.php',$OutputData);
			
			}else if ($_SESSION['rank'] == 'faculty') {

				
				$departmentname = $cpaneltask->departmentname($dept_id);

				$OutputData = [$absPath,$absLinkPath,$adminDetails,$facultyname,$departmentname,$fac_id,$dept_id];		

				parent::View('addadminforfaculty.php',$OutputData);
			
			}else{

				die();

			}

		}else{

			$this->logout();
		}

	}

	public function addvenue($fac_id){

		if($_SESSION['uid']!=null && $_SESSION['rank']!=null){

			$adminActivity = new adminActivity;

			$cpaneltask = new cpaneltask;

			$absPath = $GLOBALS['AlloverAbsPath'];
			$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
			
			$adminDetails = $adminActivity->getAccountDetails($_SESSION['uid']);
			$facultyname = $cpaneltask->facultyname($fac_id);

			if($_SESSION['rank'] == 'backdoor'){
				
				die();

			}else if ($_SESSION['rank'] == 'faculty') {

				$DepartmentSelectOptionList = $cpaneltask->getDepartmentOptionList($fac_id);
				$VenueData = $cpaneltask->venuedata($fac_id);
				$OutputData = [$absPath,$absLinkPath,$adminDetails,$facultyname,$fac_id,$DepartmentSelectOptionList,$VenueData];		

				parent::View('venue.php',$OutputData);
			
			}else{

				die();

			}

		}else{

			$this->logout();
		}

	}

	public function opensession($sess_id,$fac_id,$dept_id = null){

		if($_SESSION['uid']!=null && $_SESSION['rank'] != null){

			CQS_Session::buildSession([['academic_session',$sess_id]]);
		
			$adminActivity = new adminActivity;

			$cpaneltask = new cpaneltask;

			$absPath = $GLOBALS['AlloverAbsPath'];
			$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
			
			$adminDetails = $adminActivity->getAccountDetails($_SESSION['uid']);

			$sessiondata = $cpaneltask->sessiondata($sess_id);

			if($_SESSION['rank'] == 'faculty'){

				$departmentdata = $cpaneltask->departmentdata($fac_id);
				
				$OutputData = [$absPath,$absLinkPath,$adminDetails,$sessiondata,$departmentdata];		

				parent::View('opensession.php',$OutputData);
			
			}else if ($_SESSION['rank'] == 'HODdepartment') {

			

				$lecturerdata = $cpaneltask->lecturerdata($dept_id);
				$OutputData = [$absPath,$absLinkPath,$adminDetails,$sessiondata,$lecturerdata];		

				parent::View('opensession2.php',$OutputData);
			}else{

				$lecturerdata = $cpaneltask->mycoursedata($_SESSION['uid']);
				$OutputData = [$absPath,$absLinkPath,$adminDetails,$sessiondata,$lecturerdata];		

				parent::View('opensession3.php',$OutputData);
			}

		}else{

			$this->logout();	
		}
	
	}

	public function course($sess_id,$fac_id,$dept_id=null){

		if($_SESSION['uid']!=null && $_SESSION['rank'] != null){

			CQS_Session::buildSession([['academic_session',$sess_id]]);
		
			$adminActivity = new adminActivity;

			$cpaneltask = new cpaneltask;

			$absPath = $GLOBALS['AlloverAbsPath'];
			$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
			
			$adminDetails = $adminActivity->getAccountDetails($_SESSION['uid']);

			$sessiondata = $cpaneltask->sessiondata($sess_id);

			if($_SESSION['rank'] == 'faculty'){

				autoload_course($sess_id,$fac_id);

				$coursedata = $cpaneltask->coursedata($sess_id,$fac_id);
				$facultyname = $cpaneltask->facultyname($fac_id);
				$CoursePreRequisiteOptionList = $cpaneltask->getCourseOptionList($sess_id);
				$DepartmentOptionList = $cpaneltask->getDepartmentOptionList($fac_id);
				$LevelOptionList = $cpaneltask->getLevelOptionList();
				
				$OutputData = [$absPath,$absLinkPath,$adminDetails,$sessiondata,$facultyname,$fac_id,$coursedata,$CoursePreRequisiteOptionList,$DepartmentOptionList,$LevelOptionList];		

				parent::View('course.php',$OutputData);

			}else if ($_SESSION['rank'] == 'HODdepartment') {

				autoload_course($sess_id,$fac_id,$dept_id);
				die();
			
			}else if ($_SESSION['rank'] == 'Lecturer') {
				die();
			}else{
				die();
			}

		}else{

			$this->logout();	
		}
	}

	public function exitsession($faculty_id){

		if($_SESSION['uid']!=null && $_SESSION['rank'] == 'faculty'){

			
			$cpaneltask = new cpaneltask;

			$absPath = $GLOBALS['AlloverAbsPath'];
			$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
			
			
			$cpaneltask->exitsession($_SESSION['academic_session'],$faculty_id
		);

			$url = $absLinkPath.'/cpanel';
			new CQS_Redirect($url);
			

		}else{

			$this->logout();	
		}
	}

	public function logout(){

		$adminActivity = new adminActivity;
		$adminActivity->logout_account();
	}

	
}

?>