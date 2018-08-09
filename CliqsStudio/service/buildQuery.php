<?php

	namespace CliqsStudio\service;
	
	use \CliqsStudio\service\CQS_Logger;
	use \CliqsStudio\Config\CQS_Config;

	class CQS_BuildQuery extends CQS_Config{

		public $CQSPath = null;
		public $CQSUserPath = null;

		public function __construct(){
			
			$parent = new parent;
			$this->CQSPath  = $parent->CQSPath;

		}

		public static function create($connect_handle,$table,$data=[]){
			
			$Logger = new CQS_Logger;
			
			try {

				$length = count($data);		
			
			} catch (Exception $e) {
				$Logger->checkLive($e->getMessage());	
			}

			
			$i=1; $variable_space = null;
			
			while ($i <= $length) {
			
				$variable_space.='?,';
				$i++;
			}

			$variable_space = rtrim($variable_space,',');

			$query = "INSERT INTO $table VALUES($variable_space)";
			
			try {

				$Logger->checkLive($query);
				$rs = $connect_handle->prepare($query);
			
				
				if ($rs->execute($data)) {
				
					return true;
				
				}

			} catch (\PDOException $e) {

				$Logger->checkLive($e->getMessage());
				return false;
			}
			
		}

		
		public static function readEx($connect_handle,$table,$data=[[[]]],$data_field_selected=[],$extra=[]){

			$datasize = count($data);
			$length =  $datasize!=0?$datasize:null; 	$conditions = null;
			
			$extrasize = count($extra);
			$extralength =  $extrasize!=0?$extrasize:null;
			
			$Logger = new CQS_Logger;

			try{

				/*Selected Field*/

				if (count($data_field_selected) == 0) {
				
					$field_to_select = '*';
				
				}else{

					$field_to_select = null;

					foreach ($data_field_selected as $field_to_selecting) {
						
						$field_to_select.= "$field_to_selecting,";
						
					}
					$field_to_select = rtrim($field_to_select,',');
					
				}



				if ($length != null) {
					
					/*Predicate*/
					$xconds=null;
					foreach ($data as $key => $as_array) {
						
						if(is_array($as_array)) {
							
							if(!is_array($as_array[0]) && count($as_array)>=3){

								$predicate = $as_array[0];	
								$predicate_assignment_operator = $as_array[1];
								$predicate_val = $as_array[2];
								@$predicate_logical_operator	=	empty($as_array[3])?null:$as_array[3];	
								$xconds.=	"$predicate $predicate_assignment_operator '$predicate_val' $predicate_logical_operator ";
								
							}else if(is_array($as_array[0])){

								$xconds.= " (";

								foreach ($as_array as $ikey=>$in_as_array) {
									

									if (!is_array($in_as_array[$ikey]) && count($in_as_array)>=3) {	
									
										$predicate = $in_as_array[0];	
										$predicate_assignment_operator = $in_as_array[1];
										$predicate_val = $in_as_array[2];
										@$predicate_logical_operator	=	empty($in_as_array[3])?null:$in_as_array[3];	
										$xconds.=	"$predicate $predicate_assignment_operator '$predicate_val' $predicate_logical_operator ";

									}

								}

								$xconds = rtrim($xconds,"$predicate_logical_operator ");
								$xconds.= ") $predicate_logical_operator ";
							
							}
							
							
						}else{
						
							$error = "SQL Error: Line ".__LINE__." on ".__METHOD__." / ". __CLASS__." ".__FILE__." Enter Nested Array as Arguement or Nested items Must be at least 3";
							$Logger->checkLive($error);
						
						}

					}

					$conditions.=$xconds;

					if ($extralength != null) {
					
						$extra_query = $extra[0];
					
					}else{

						$extra_query = null;
					}

					$conditions = rtrim($conditions,"$predicate_logical_operator ");

					$query = "SELECT $field_to_select FROM $table WHERE $conditions $extra_query";

					
				}else{
			
					$query = "SELECT $field_to_select FROM $table $extra_query";
			
				}

				try {

					$Logger->checkLive($query);
					
					$rs = $connect_handle->query($query);

					if ($rs != false){
						return $rs;
					}else{
						
						$Logger->checkLive("Couldn't Generate Data From Source, Query Error!");
						return false;

					}

				} catch (\PDOException $e) {
					$Logger->checkLive($e->getMessage());
					return false;
				}
			}catch(Exception $e){
				
				$Logger->checkLive($e->getMessage());
				
			}
				
		}

		public static function updateEx($connect_handle,$table,$data=[[[]]],$data_field_updated=[[]],$extra=[]){

			$datasize = count($data);
			$length =  $datasize!=0?$datasize:null; 	$conditions = null;
			
			$extrasize = count($extra);
			$extralength =  $extrasize!=0?$extrasize:null;

			$Logger = new CQS_Logger;

			try{

				/*Updated Field*/

				foreach ($data_field_updated as $as_update_array) {

					$field_to_updated = null;

					if (is_array($as_update_array) && count($as_update_array)==2) {
					
						$field = $as_update_array[0];		$field_val = $as_update_array[1];	
					
					}else{
					
						$error = "SQL Error: Line ".__LINE__." on ".__METHOD__." / ". __CLASS__." ".__FILE__." Expecting Nested Array as Arguement, Expecting two(2) parameters";
						$Logger->checkLive($error);
					
					}

					$field_to_updated.=	"$field='$field_val',";
		
				}

				$field_to_updated = rtrim($field_to_updated,",");



				if ($length != null) {
					
					/*Predicate*/
					$xconds=null;
					foreach ($data as $key => $as_array) {

						if (is_array($as_array)) {
							
							if(!is_array($as_array[$key]) && count($as_array)>=3){

								$predicate = $as_array[0];	
								$predicate_assignment_operator = $as_array[1];
								$predicate_val = $as_array[2];
								@$predicate_logical_operator	=	empty($as_array[3])?null:$as_array[3];	
								$xconds.=	"$predicate$predicate_assignment_operator'$predicate_val' $predicate_logical_operator ";
								
							}else if(is_array($as_array[$key])){

								$xconds.= " (";

								foreach ($as_array as $ikey=>$in_as_array) {
									

									if (!is_array($in_as_array[$ikey]) && count($in_as_array)>=3) {	
									
										$predicate = $in_as_array[0];	
										$predicate_assignment_operator = $in_as_array[1];
										$predicate_val = $in_as_array[2];
										@$predicate_logical_operator	=	empty($in_as_array[3])?null:$in_as_array[3];	
										$xconds.=	"$predicate$predicate_assignment_operator'$predicate_val' $predicate_logical_operator ";

									}

								}

								$xconds = rtrim($xconds,"$predicate_logical_operator ");
								$xconds.= ") $predicate_logical_operator ";
							
							}
							
							
						}else{
						
							$error = "SQL Error: Line ".__LINE__." on ".__METHOD__." / ". __CLASS__." ".__FILE__." Enter Nested Array as Arguement or Nested items Must be at least 3";
							$Logger->checkLive($error);
						
						}

					}

					$conditions.=$xconds;

					if ($extralength != null) {
					
						$extra_query = $extra[0];
					
					}else{

						$extra_query = null;
					}

					$conditions = rtrim($conditions,"$predicate_logical_operator ");

					$query = "UPDATE $table SET $field_to_updated  WHERE $conditions";	
				
				}else{
			
					$query = "UPDATE $table SET $field_to_updated";
			
				}

				try {

					$Logger->checkLive($query);
					$rs = $connect_handle->exec($query);

					if ($rs != false){
					
						return $rs;
					
					}else{
						
						$Logger->checkLive("Couldn't Generate Data From Source, Query Error!");
						return false;

					}

				} catch (\PDOException $e) {
					$Logger->checkLive($e->getMessage());
					return false;
				}

			}catch(Exception $e){
				$Logger->checkLive($e->getMessage());
			}

		}

		public static function delete($connect_handle,$table,$data=[[[]]],$extra=[]){

			$datasize = count($data);
			$length =  $datasize!=0?$datasize:null; 	$conditions = null;
			
			$extrasize = count($extra);
			$extralength =  $extrasize!=0?$extrasize:null;

			$Logger = new CQS_Logger;
			
			try{

				if ($length != null) {
					
					/*Predicate*/
					$xconds=null;
					foreach ($data as $key => $as_array) {

						if (is_array($as_array)) {
							
							$Logger->checkLive($key);

							if(!is_array($as_array[$key]) && count($as_array)>=3){

								$predicate = $as_array[0];	
								$predicate_assignment_operator = $as_array[1];
								$predicate_val = $as_array[2];
								@$predicate_logical_operator	=	empty($as_array[3])?null:$as_array[3];	
								$xconds.=	"$predicate$predicate_assignment_operator'$predicate_val' $predicate_logical_operator ";
								
								

							}else if(is_array($as_array[$key])){

								$xconds.= " (";

								foreach ($as_array as $ikey=>$in_as_array) {
									

									if (!is_array($in_as_array[$ikey]) && count($in_as_array)>=3) {	
									
										$predicate = $in_as_array[0];	
										$predicate_assignment_operator = $in_as_array[1];
										$predicate_val = $in_as_array[2];
										@$predicate_logical_operator	=	empty($in_as_array[3])?null:$in_as_array[3];	
										$xconds.=	"$predicate$predicate_assignment_operator'$predicate_val' $predicate_logical_operator ";

									}

								}

								$xconds = rtrim($xconds,"$predicate_logical_operator ");
								$xconds.= ") $predicate_logical_operator ";
							
							}
							
							
						}else{
						
							$error = "SQL Error: Line ".__LINE__." on ".__METHOD__." / ". __CLASS__." ".__FILE__." Enter Nested Array as Arguement or Nested items Must be at least 3";
							$Logger->checkLive($error);
						
						}

					}

					$conditions.=$xconds;

					if ($extralength != null) {
					
						$extra_query = $extra[0];
					
					}else{

						$extra_query = null;
					}

					$conditions = rtrim($conditions,"$predicate_logical_operator ");

					$query = "DELETE FROM $table WHERE $conditions $extra_query";	
				
				}else{
			
					$query = "DELETE FROM $table $extra_query";
			
				}

				try {
					$Logger->checkLive($query);
					$rs = $connect_handle->exec($query);

					if ($rs != false){
					
						return $rs;
					
					}

				} catch (\PDOException $e) {
					$Logger->checkLive($e->getMessage());
					return false;
				}

			}catch(Exception $e){
				$Logger->checkLive($e->getMessage());
			}

			
		}

		public static function truncate($connect_handle,$table){

			$query = "TRUNCATE $table";
			
			$Logger = new CQS_Logger;

			try{

				$Logger->checkLive($query);
				$rs = $connect_handle->exec($query);
				
				if ($rs != false){
				
					return $rs;
				
				}

			}catch (\PDOException $e) {
					$Logger->checkLive($e->getMessage());
					return false;
			}
		}

	}

	
?>