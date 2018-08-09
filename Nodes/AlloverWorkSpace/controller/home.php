<?php 

use \CliqsStudio\config\CQS_Config as CQS_Config;
use \CliqsStudio\controller\CQS_Controller as CQS_Controller;
use \CliqsStudio\service\CQS_Redirect as CQS_Redirect;
use \CliqsStudio\service\CQS_Logger as CQS_Logger;
use \CliqsStudio\service\CQS_Session as CQS_Session;
use \CliqsStudio\service\CQS_Sanitize as CQS_Sanitize;
use \CliqsStudio\service\CQS_Security as CQS_Security;


include_once('constants.php');


class home extends CQS_Controller{

	public $CQSUserPath = null;
	public $CQSPath = null;

	public function __construct(){

		$parent = new parent;

		$this->CQSUserPath = $parent->CQSUserPath;
		$this->CQSPath = $parent->CQSPath;

	}

	public function index(){


		$absPath = $GLOBALS['AlloverAbsPath'];
		$absLinkPath = $GLOBALS['AlloverAbsLinkPath'];

		$OutputData = [$absPath,$absLinkPath];

		parent::View('index.php',$OutputData);

	}

	public function login(){

		$absPath = $GLOBALS['AlloverAbsPath'];
		$OutputData = [$absPath];
		parent::View('logn.php',$OutputData);
	}
}

?>