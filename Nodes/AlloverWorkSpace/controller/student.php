<?php 

use \CliqsStudio\config\CQS_Config as CQS_Config;
use \CliqsStudio\controller\CQS_Controller as CQS_Controller;
use \CliqsStudio\service\CQS_Redirect as CQS_Redirect;
use \CliqsStudio\service\CQS_Logger as CQS_Logger;
use \CliqsStudio\service\CQS_Session as CQS_Session;
use \CliqsStudio\service\CQS_Sanitize as CQS_Sanitize;
use \CliqsStudio\service\CQS_Security as CQS_Security;


include_once('constants.php');
include_once('Nodes/AlloverWorkSpace/model/adminActivity.php');
include_once('Nodes/AlloverWorkSpace/model/cpaneltask.php');

class student extends CQS_Controller{

	public $CQSUserPath = null;
	public $CQSPath = null;

	public function __construct(){

		$parent = new parent;

		$this->CQSUserPath = $parent->CQSUserPath;
		$this->CQSPath = $parent->CQSPath;

	}

	public function index(){


		$absPath = $GLOBALS['AlloverAbsPath'];
		$OutputData = [$absPath];
		
	}

	public function list($sess_id,$faculty_id,$dept_id = null){

		if($_SESSION['uid']!=null && $_SESSION['rank'] != null){

			CQS_Session::buildSession([['academic_session',$sess_id]]);
		
			$adminActivity = new adminActivity;

			$cpaneltask = new cpaneltask;

			$absPath = $GLOBALS['AlloverAbsPath'];
			$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
			
			$adminDetails = $adminActivity->getAccountDetails($_SESSION['uid']);

			$sessiondata = $cpaneltask->sessiondata($sess_id);

			if($_SESSION['rank'] == 'faculty'){

				$Studentdata =$cpaneltask->studentdata($_SESSION['academic_session'],$faculty_id);
				$facultyname = $cpaneltask->facultyname($faculty_id);

				
				$OutputData = [$absPath,$absLinkPath,$adminDetails,$sessiondata,$facultyname,$faculty_id,$Studentdata];		

				parent::View('student.php',$OutputData);

			}else if ($_SESSION['rank'] == 'HODdepartment') {

				$coursedata = $cpaneltask->coursedata($sess_id,$faculty_id,$dept_id);
				$facultyname = $cpaneltask->facultyname($faculty_id);
				
				$Studentdata =$cpaneltask->studentdata($_SESSION['academic_session'],$faculty_id,$dept_id);
				$LevelOptionList = $cpaneltask->getLevelOptionList();
				$OutputData = [$absPath,$absLinkPath,$adminDetails,$sessiondata,$Studentdata,$LevelOptionList];		

				parent::View('student2.php',$OutputData);
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

	public function autoload($sess_id,$faculty_id,$dept_id){

		CQS_Session::buildSession([['academic_session',$sess_id]]);
		
			$adminActivity = new adminActivity;

			$cpaneltask = new cpaneltask;

			$absPath = $GLOBALS['AlloverAbsPath'];
			$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
			
			$adminDetails = $adminActivity->getAccountDetails($_SESSION['uid']);

			$sessiondata = $cpaneltask->sessiondata($sess_id);

		if ($_SESSION['rank'] == 'HODdepartment') {

				$coursedata = $cpaneltask->coursedata($sess_id,$faculty_id,$dept_id);
				$facultyname = $cpaneltask->facultyname($faculty_id);
				
				$Studentdata =$cpaneltask->studentdata($_SESSION['academic_session'],$faculty_id,$dept_id);
				$LevelOptionList = $cpaneltask->getLevelOptionList();
				$OutputData = [$absPath,$absLinkPath,$adminDetails,$sessiondata,$Studentdata,$LevelOptionList];		
				

				parent::View('autoload.php',$OutputData);
				die();
			
		}else{
			die();
		}
	}


	public function switch($sess_id,$faculty_id,$dept_id){
				
			CQS_Session::buildSession([['academic_session',$sess_id]]);
		
			$adminActivity = new adminActivity;

			$cpaneltask = new cpaneltask;

			$absPath = $GLOBALS['AlloverAbsPath'];
			$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
			
			$adminDetails = $adminActivity->getAccountDetails($_SESSION['uid']);

			$sessiondata = $cpaneltask->sessiondata($sess_id);

		if ($_SESSION['rank'] == 'HODdepartment') {

				$coursedata = $cpaneltask->coursedata($sess_id,$faculty_id,$dept_id);
				$facultyname = $cpaneltask->facultyname($faculty_id);
				
				$Studentdata =$cpaneltask->studentdata($_SESSION['academic_session'],$faculty_id,$dept_id);
				$LevelOptionList = $cpaneltask->getLevelOptionList();
				$OutputData = [$absPath,$absLinkPath,$adminDetails,$sessiondata,$Studentdata,$LevelOptionList];		
				
				$l = $_POST['level'];
				$s = $_POST['semester'];
				
				CQS_Session::buildSession([ ['entered_level',$l],['entered_semester',$s] ]);


				parent::View('switch.php',$OutputData);
				die();
			
		}else{
			die();
		}


	}

	
}

?>