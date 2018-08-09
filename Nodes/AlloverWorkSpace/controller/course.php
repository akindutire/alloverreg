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

class course extends CQS_Controller{

	public $CQSUserPath = null;
	public $CQSPath = null;

	public function __construct(){

		$parent = new parent;

		$this->CQSUserPath = $parent->CQSUserPath;
		$this->CQSPath = $parent->CQSPath;

	}


	public function index(){

		
	}

	public function courses($sess_id,$fac_id,$dept_id=null){

		if($_SESSION['uid']!=null && $_SESSION['rank'] != null){

			CQS_Session::buildSession([['academic_session',$sess_id]]);
		
			$adminActivity = new adminActivity;

			$cpaneltask = new cpaneltask;

			$absPath = $GLOBALS['AlloverAbsPath'];
			$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
			
			$adminDetails = $adminActivity->getAccountDetails($_SESSION['uid']);

			$sessiondata = $cpaneltask->sessiondata($sess_id);

			if($_SESSION['rank'] == 'faculty'){

				$coursedata = $cpaneltask->coursedata($sess_id,$fac_id);
				$facultyname = $cpaneltask->facultyname($fac_id);
				$CoursePreRequisiteOptionList = $cpaneltask->getCourseOptionList($sess_id);
				$DepartmentOptionList = $cpaneltask->getDepartmentOptionList($fac_id);
				$LevelOptionList = $cpaneltask->getLevelOptionList();
				
				$OutputData = [$absPath,$absLinkPath,$adminDetails,$sessiondata,$facultyname,$fac_id,$coursedata,$CoursePreRequisiteOptionList,$DepartmentOptionList,$LevelOptionList];		

				parent::View('course.php',$OutputData);

			}else if ($_SESSION['rank'] == 'HODdepartment') {

				$coursedata = $cpaneltask->coursedata($sess_id,$fac_id,$dept_id);
				$facultyname = $cpaneltask->facultyname($fac_id);
				$CoursePreRequisiteOptionList = $cpaneltask->getCourseOptionList($sess_id);
				$DepartmentOptionList = "NULL";
				$LevelOptionList = $cpaneltask->getLevelOptionList();
				
				$OutputData = [$absPath,$absLinkPath,$adminDetails,$sessiondata,$facultyname,$fac_id,$coursedata,$CoursePreRequisiteOptionList,$DepartmentOptionList,$LevelOptionList];		

				parent::View('course2.php',$OutputData);
				die();
			
			}else if ($_SESSION['rank'] == 'Lecturer') {
				$coursedata = $cpaneltask->coursedata($sess_id,$fac_id,$dept_id);
				$facultyname = $cpaneltask->facultyname($fac_id);
				$CoursePreRequisiteOptionList = $cpaneltask->getCourseOptionList($sess_id);
				$DepartmentOptionList = "NULL";
				$LevelOptionList = $cpaneltask->getLevelOptionList();
				
				$OutputData = [$absPath,$absLinkPath,$adminDetails,$sessiondata,$facultyname,$fac_id,$coursedata,$CoursePreRequisiteOptionList,$DepartmentOptionList,$LevelOptionList];		

				parent::View('course3.php',$OutputData);
				
				die();
			}else{
				die();
			}

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