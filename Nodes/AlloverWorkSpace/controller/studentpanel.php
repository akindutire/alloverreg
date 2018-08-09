<?php 

use \CliqsStudio\config\CQS_Config as CQS_Config;
use \CliqsStudio\controller\CQS_Controller as CQS_Controller;
use \CliqsStudio\service\CQS_Redirect as CQS_Redirect;
use \CliqsStudio\service\CQS_Logger as CQS_Logger;
use \CliqsStudio\service\CQS_Session as CQS_Session;
use \CliqsStudio\service\CQS_Sanitize as CQS_Sanitize;
use \CliqsStudio\service\CQS_Security as CQS_Security;


include_once('constants.php');
include_once('Nodes/AlloverWorkSpace/model/studenttask.php');

class studentpanel extends CQS_Controller{

	public $CQSUserPath = null;
	public $CQSPath = null;

	public function __construct(){

		$parent = new parent;

		$this->CQSUserPath = $parent->CQSUserPath;
		$this->CQSPath = $parent->CQSPath;

	}

	public function index(){

		$studenttask = new studenttask;
		$absPath = $GLOBALS['AlloverAbsPath'];
		$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
		$studentDetails = $studenttask->getAccountDetails($_SESSION['uid']);
		$OutputData = [$absPath,$absLinkPath,$studentDetails];

		parent::View('student/mydetails.php',$OutputData);
	}

	public function regcourse($sess_id,$fac_id,$dept_id,$level,$semester){

		$studenttask = new studenttask;
		$absPath = $GLOBALS['AlloverAbsPath'];
		$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];
		$studentDetails = $studenttask->getAccountDetails($_SESSION['uid']);
		$coursedata = $studenttask->coursedata($sess_id,$fac_id,$dept_id,$level,$semester);
				
		$OutputData = [$absPath,$absLinkPath,$studentDetails,$coursedata];		

		parent::View('student/course.php',$OutputData);

	}
	

	public function logout(){

		$studenttask = new studenttask;
		$studenttask->logout_account();
	}
}

?>