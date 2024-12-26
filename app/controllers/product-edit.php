<?php

$errors = [];

$id = $_GET['id'] ?? null;
$product = new Product();

$row = $product->first(['id'=>$id]);

if ($_SERVER["REQUEST_METHOD"] == "POST" && $row) 
{
	# code...

	$_POST['product_id'] = empty($_POST['product_id']) ? $product->generate_product_id() : $_POST['product_id'];
	
	if (!empty($_FILES['image']['name'])) 
	{
		$_POST['image'] = $_FILES['image'];
	}
	
	$errors = $product->validate($_POST, $row['id']);
	
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
			$destination = $folder . $product->generate_filename($ext);
			move_uploaded_file($_POST['image']['tmp_name'], $destination);
			$_POST['image'] = $destination;

			//delete teh old image
			if (file_exists($row['image'])) 
			{
				unlink($row['image']);
			}
		}

		$product->update($row['id'], $_POST);
		
		redirect("admin&tab=products");
	}
	

}

require_once views_path('products/product-edit');