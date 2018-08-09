<?php
	
	namespace CliqsStudio;

	use CliqsStudio\config\CQS_Config as CQS_Config;
	use CliqsStudio\service\CQS_Database as CQS_Database;
	use CliqsStudio\service\CQS_BuildQuery as CQS_BuildQuery;
	use CliqsStudio\service\CQS_Logger as CQS_Logger;
			

	class CQS_App{


		public $defaultcontroller 	=		'home';
		public $defaultview 		= 		'index';
		public $pageparams 			= 		[];
		public $urlParams 			= 		[];


		public static $CQSPathe 	 			= 		'CliqsStudio/';
		public static $CQSUserPathe 			= 		'CliqsStudioWorkSpace/';
		public static $CQSAbsPathe	 			= 		'//CliqsStudio/';
		public static $CQSLive		 			= 		null;
		
		public static $dbdriver					=		null;
		public static $dbhost					=		null;
		public static $dbuser					=		null;
		public static $dbpassword				=		null;
		public static $dbname 					=		null;


		public $controllerPath 					=		'controller/'; 
		
		public $go_Flag = 0;
		public $appkey = "<&+7624]\"+!8!!\&&{0&8,!#X4{;-;+\UuV";



		public function __construct($path0 , $path1 , $db = ['driver'=>'mysql','host'=>'localhost','user'=>'root','password'=>'','database'=>'test'], $live = false, $appkey = null){


			
			$this->setCQSPath($path0);
			$this->setCQSUserPath($path1);
			$this->setDbParams($db['driver'],$db['host'],$db['user'],$db['password'],$db['database']);
			$this->setCQSLiveState($live);
			$this->processDatabaseJson();

			$this->pareseUrlParams();

			$appkey = is_null($appkey)?$this->appkey:$appkey;

			$session_path = self::$CQSUserPathe."session/";	
			if(!is_dir($session_path)){
				
				$Logger = new CQS_Logger;
				$Logger->checkLive("Session Container not Valid");

			}


			session_name($appkey);

			session_save_path($session_path);
			session_start();

		}

		private function setCQSPath($CQSPathe){
			self::$CQSPathe = $CQSPathe;
		}

		private function setCQSUserPath($CQSUserPathe){
			self::$CQSUserPathe	=	$CQSUserPathe;
		}

		private function setDbParams($driver,$host,$user,$password,$database){
		
			self::$dbdriver 	= $driver;
			self::$dbhost 		= $host;
			self::$dbuser 		= $user;
			self::$dbpassword 	= $password;
			self::$dbname 		= $database;
		
		}

		
		private function setCQSLiveState($boolState){
			self::$CQSLive	=	$boolState;
		}

		private function processDatabaseJson(){

			/****
			*	More Development is Needed in Future -Supported Database , Mysql , Sqlite , PGSQL
			*/

			if(file_exists(self::$CQSUserPathe.'/database/database.json') == true){

				$databaseJSONContext = file_get_contents(self::$CQSUserPathe.'database/database.json');
				
				$databaseArray	=	json_decode($databaseJSONContext,true);
				
				$Database = new CQS_Database;
				$SQL = new CQS_BuildQuery;
				
				foreach ($databaseArray as $databaseName => $databaseParams) {
					if ($databaseParams['driver'] == 'mysql') {
						
						$Connection1 = $Database->addConnection([$databaseParams['driver'],$databaseParams['host'],'',$databaseParams['username'],$databaseParams['password']]);
			
					}else if ($databaseParams['driver'] == 'sqlite') {
						
						$Connection1 = $Database->addConnection([$databaseParams['driver'],$databaseParams['path']]);
					
					}else if ($databaseParams['driver'] == 'pgsql') {
						
						$Connection1 = $Database->addConnection([$databaseParams['driver'],$databaseParams['host'],$databaseParams['port'],'test',$databaseParams['username'],$databaseParams['password']]);

					}
					
					if(!empty($databaseParams['prefix']))
						$db = $databaseParams['prefix'].'_'.$databaseName;
					else
						$db = $databaseName;

					$Connection1->exec("CREATE DATABASE IF NOT EXISTS $db");
					
				}
			}

		}

		
		public function View($view,$data = []){
			
			$vFile = self::$CQSUserPathe."view/$view";
			
			if(file_exists($vFile) === true){

				include_once($vFile);
			
			}
		
		}

		

		public function start($io = 1){

			if ($io == 0) {

				$vFile = self::$CQSPathe."view/CQS/maintenance.php";
				include_once($vFile);
				die();
			}

			
			
			$urlParams = $this->urlParams;
			
				if (empty($urlParams)) {
										
					$urlParams = [$this->defaultcontroller,$this->defaultview];	
				}
				

				$cPath = self::$CQSUserPathe.''.$this->controllerPath;
				
				if(file_exists($cPath.''.$urlParams[0].'.php') === true){

					$this->pagecontroller = $urlParams[0];	
					include_once($cPath.''.$urlParams[0].'.php');

					unset($urlParams[0]);


					/* Checking if method entered from URL*/
					$urlParams[1] = empty($urlParams[1])?$this->defaultview:$urlParams[1];
						

						


					if (method_exists("\\$this->pagecontroller", $urlParams[1])) {
						
						$this->pageview = $urlParams[1];
						unset($urlParams[1]);
						
						$this->pageparams = $urlParams ? array_values($urlParams):[];
					
						/*Import CliqsStudio namespace*/
						
						$controller = "\\".$this->pagecontroller;
						$this->pagecontroller = new $controller;


						call_user_func_array([$this->pagecontroller,$this->pageview], $this->pageparams);

					}else{
						
						if(file_exists(self::$CQSUserPathe."view/404/index.php") == false){

							$vFile = self::$CQSPathe."view/CQS/404.php";
							include_once($vFile);
							die();
						}else{

							include_once(self::$CQSUserPathe."view/404/index.php");
							die();

						}
					}

				}else{
					
					$this->View(self::$CQSUserPathe.'404/index.php');
			
				}

				session_write_close();

			

		}

		public function close(){

			session_write_close();
		}

		private function sanitizeUrlParams($urlParams){

			//[a-zA-Z0-9]

			$pattern = '/^(\w+\/?)+$/';
			if (preg_match($pattern, $urlParams)===1) {
				
				return $urlParams;

			}else{

				$defaultUrlParams = "$this->defaultcontroller/$this->defaultview";
				return $defaultUrlParams;
			}
		}

		private function pareseUrlParams(){
			
			$urlParams = null;

			if (isset($_GET['url_parameters'])) {
				
				$urlParams = $_GET['url_parameters'];

				$urlParams = $this->sanitizeUrlParams($urlParams);

				$this->urlParams = explode('/',$urlParams);
			}

		}


		public function __destruct(){


		}

		public function stop(){

			$this->__destruct();
		}
		
	}

?>