<?php 
	namespace App\Helpers;
	/**
	* Helpers
	*/
	class SumNumber
	{ 
		public static function pre($list, $exit = true)
		{
			echo "<pre>";
			print_r($list);
			if($exit){
				die();
			}
		}
		public static function validate_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
	}
?>