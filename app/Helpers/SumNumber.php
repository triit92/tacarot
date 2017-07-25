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
	}
?>