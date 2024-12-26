<?php

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	# code...
	$product = new Product();
	$_POST['date'] = date("Y-m-d H:i:s");
	$_POST['user_id'] = auth('id');
	$_POST['product_id'] = empty($_POST['product_id']) ? $product->generate_product_id() : $_POST['product_id'];
	
	if (!empty($_FILES['image']['name'])) 
	{
		$_POST['image'] = $_FILES['image'];
	}
	$errors = $product->validate($_POST);
	if (empty($errors)) 
	{
		$folder = "uploads/";
		if (!file_exists($folder)) 
		{
			mkdir($folder, 0777, true);
		}

		$ext = strtolower(pathinfo($_POST['image']['name'], PATHINFO_EXTENSION));
		$destination = $folder . $product->generate_filename($ext);
		move_uploaded_file($_POST['image']['tmp_name'], $destination);

		$_POST['image'] = $destination;
		$product->insert($_POST);
		redirect("admin&tab=products");
	}
	

}

require_once views_path('product/product-new');