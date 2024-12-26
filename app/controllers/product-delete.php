<?php

$errors = [];

$id = $_GET['id'] ?? null;
$product = new Product();

$row = $product->first(['id'=>$id]);

if ($_SERVER["REQUEST_METHOD"] == "POST" && $row) 
{

	$product->delete($row['id']);

	//delete the old image
	if (file_exists($row['image'])) 
	{
		unlink($row['image']);
	}
	
	redirect("admin&tab=products");
	

}

require_once views_path('products/product-delete');