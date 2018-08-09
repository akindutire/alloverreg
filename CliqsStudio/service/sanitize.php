<?php
namespace CliqsStudio\service;
use \CliqsStudio\service\CQS_Logger;

class CQS_Sanitize{

	public function __construct(){

	}

	public static function cleanData($data=[]){

		if (is_array($data) && count($data)!=0) {
			
			$new_data_set = [];

			foreach ($data as $value) {
				

				if (ctype_digit($value) === true) {
				
					$data_cleansed = (int)filter_var($value,FILTER_SANITIZE_NUMBER_INT);
				
				}else if (ctype_alnum($value) === true) {
					
					$data_cleansed = filter_var($value,FILTER_SANITIZE_STRING);

				}else if (is_resource($value) === true) {
					
					$data_cleansed = filter_var($value,FILTER_SANITIZE_URL);
					$data_cleansed = filter_var($value,FILTER_SANITIZE_EMAIL);
				
				}else{

					$data_cleansed = htmlentities($value);

				}
				
				//Queue
				array_push($new_data_set, $data_cleansed);
			}
			
			//CQS_Logger::checkLive($new_data_set);
			return $new_data_set;

		}else{

			$error = __CLASS__." / ".__METHOD__." Expected non-empty Array as parameter 1 on Line ".__LINE__;
			CQS_Logger::checkLive($error);

		}	
	}
}
?>