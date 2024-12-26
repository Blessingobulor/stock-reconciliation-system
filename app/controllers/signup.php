<?php

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	# code...
	$user = new User();
	$_POST['role'] = 'Administrator';
	$_POST['date'] = date("Y-m-d H:i:s");
	$_POST['user_id'] = uniqid();
	
	$errors = $user->validate($_POST);
	if (empty($errors)) 
	{
		$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$user->insert($_POST, 'users');
		redirect("admin&tab=users");
	}
	

}

if(Auth::access('admin')) 
{
	require_once views_path('auth/signup');

}else{

	Auth::setMessage("Only admin can create users");
	require_once views_path('auth/denied');
}

?>