<?php
	
	namespace CliqsStudio\config;

	use CliqsStudio\CQS_App as CQS_App;

	class CQS_Config extends CQS_App{

 		public $controllerPath 		= 		['controller/'];
		public $modelPath 			= 		['model/'];
		public $viewPath 			= 		['view/'];
		public $sessionPath 		= 		['session/'];
		public $cachePath 			= 		['cache/'];
		public $storagePath 		= 		['storage/'];
		public $dataPath	 		= 		['data/'];
		public $servicePath			=		['service/'];
		public $configPath 			= 		['config/'];
		public $logPath 			= 		['log/'];
		public $CQSPath 			= 		'/alloverreg/CliqsStudio//';  /*Relative Path Required*/
		public $CQSUserPath 		= 		'CliqsStudioWorkSpace/';  /*Relative Path Required*/
		public $CQSAbsPath			=		'/alloverreg/CliqsStudio//';
		public $CQSAbsUserPath		=		'/CliqsStudio//';

		public $dbParams			= 		[];
		

		public $live 				=		false;
		public $trial				=		false;
		public $cache 				=		false;
		public $cacheDuration		=		10;		//Minutes
		public $trialDuration 		= 		100;	//Days

		public function __construct(){

			//$parent = new parent;
			$this->CQSPath 		= parent::$CQSPathe;
			$this->CQSUserPath 	= parent::$CQSUserPathe;
			
			$this->dbParams 	= ['driver'=>parent::$dbdriver,'host'=>parent::$dbhost,'user'=>parent::$dbuser,'password'=>parent::$dbpassword,'database'=>parent::$dbname];
			
			$this->CQSUserPath 	= parent::$CQSUserPathe;

			$this->live 		= parent::$CQSLive;

			/*$doc_root = preg_replace("\/", "\\", $_SERVER['DOCUMENT_ROOT']);
			
			$CQSPath = str_replace($doc_root, '', __DIR__);
			$this->CQSPath = $CQSPath;
			$this->CQSAbsPath = $CQSPath; 
			*/

		}

			
		

 	}


	?>