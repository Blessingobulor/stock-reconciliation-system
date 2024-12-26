<?php

/**
 * Authentication Class
 */
class Auth extends Model
{
	public static function get($column)
	{
		if (isset($_SESSION['USER'][$column]) && !empty($_SESSION['USER'][$column])) 
		{
			return $_SESSION['USER'][$column];
		}

		return 'Unknown';
	}


	public static function logged_in()
	{

		if (isset($_SESSION['USER']) && !empty($_SESSION['USER'])) 
		{
			$db = new Database();
			$check = $db->query("select * from users where email = :email limit 1", ["email"=>$_SESSION['USER']['email']]);

			if($check) 
			{
				return true;
			}
			
		} 

		return false;
	}


// roles access.......

	public static function access($row)
	{
		$access['admin'] 		= ['admin'];
		$access['supervisor'] 	= ['admin','supervisor'];
		$access['cashier'] 		= ['admin','supervisor','cashier'];
		$access['accountant'] 	= ['admin','accountant'];
		$access['user'] 		= ['admin','supervisor','cashier','user'];
		
		$myrole = self::get('role');

		if (in_array($myrole, $access[strtolower($row)])) 
		{
			return true;
		}

		return false;
	}


	public static function setMessage($message)
	{
		$_SESSION['MESSAGE'] = $message;
	}


	public static function getMessage()
	{
		if (!empty($_SESSION['MESSAGE'])) 
		{
			$message = $_SESSION['MESSAGE'];
			unset($_SESSION['MESSAGE']);
			return $message;
		}
	}

}
























