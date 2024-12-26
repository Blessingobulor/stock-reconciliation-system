<?php

$errors = [];
$user = new User();

$id = $_GET['id'] ?? null;
$row = $user->first(["id"=>$id]);


if(!empty($_SERVER['HTTP_REFERER']))
{
	$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	//make sure only admin can make other admin
	if(isset($_POST['role']) && $_POST['role'] != $row['role']) 
	{
		if(Auth::get('role') != "admin") 
		{
			$_POST['role'] = $row['role']; 
		}
	}


	//make sure only admin can edit gender
	if(isset($_POST['role']) && $_POST['role'] != $row['role']) 
	{
		if(Auth::get('role') != "admin") 
		{
			$_POST['gender'] = $row['gender']; 
		}
	}
	


	if (!empty($_FILES['image']['name'])) 
	{
		$_POST['image'] = $_FILES['image'];
	}


	$errors = $user->validate($_POST, $id);
	if (empty($errors)) 
	{


		$folder = "uploads/";
		if (!file_exists($folder)) 
		{
			mkdir($folder, 0777, true);
		}

		if (!empty($_POST['image'])) 
		{
			$ext = strtolower(pathinfo($_POST['image']['name'], PATHINFO_EXTENSION));
			$product = new Product();

			$destination = $folder . $product->generate_filename($ext);
			move_uploaded_file($_POST['image']['tmp_name'], $destination);
			$_POST['image'] = $destination;

			//delete the old image
			if (file_exists($row['image'])) 
			{
				unlink($row['image']);
			}
		}


		if (empty($_POST['password'])) 
		{
			unset($_POST['password']);

		}else{

			$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		}
		
		$user->update($id, $_POST);
		if (Auth::get('role') == "admin") 
		{
			redirect("admin&tab=users");

		}else{

			redirect("edit-user&id=$id");
		}
		
	}
	

}

if(Auth::access('admin') || ($row && $row['id'] == Auth::get('id')))
{
	require_once views_path('auth/edit-user');

}else{

	Auth::setMessage("Only admin can edit users");
	require_once views_path('auth/denied');
}

