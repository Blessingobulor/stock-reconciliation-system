<?php

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$user = new User();
	$arr['email'] = $_POST['email'];
	$row = $user->where($arr);
	if ($row) 
	{ 
		if(password_verify($_POST['password'], $row[0]['password'])) 
		{
			authenticate($row[0]);
			redirect("homepage");

		}else{

			$errors['password'] = "Wrong Password Supplied";
		}

	}else{

		$errors['email'] = "Wrong Email Supplied"; 

	}
	
	

}

require_once views_path('auth/login');
