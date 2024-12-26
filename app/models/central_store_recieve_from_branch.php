<?php

/**
 * Order Class
 */

class central_store_recieve_from_branch extends Model

{
	public $table = "central_store_recieve_from_branch";


	public $allowed_columns = [
		
            'recieve_stock_id',
            'branch_name',
			'source',
			'date',
			'reasons_for_recieving_of_stock',
			'stock_name',
			'qty',
			'category',
			'stock_serial_number',
			'created_by'
			
			];

}



/*--------------------------------------------------------------------------------------------------------------------------
	Validate function: to validate all input
---------------------------------------------------------------------------------------------------------------------------*/
	// public function validate($data, $id = null)
	// {	
	// 	$errors = [];

	// 	//validating description Field
	// 	if (empty($data['description'])) 
	// 	{
	// 		$errors['description'] = "Order description is require_onced"; 

	// 	}elseif(!preg_match('/[a-zA-Z0-9 ]/', $data['description'])) 
	// 	{
	// 		$errors['description'] = "Only letters and numbers are allowed in description";
	// 	}

	// 	//validating quantity Field
	// 	if (empty($data['qty'])) 
	// 	{
	// 		$errors['qty'] = "Order quantity is require_onced"; 

	// 	}elseif(!preg_match('/[0-9]/', $data['qty'])) 
	// 	{
	// 		$errors['qty'] = "Quantity must be a number";
	// 	}

	// 	//validating Amount Field
	// 	if (empty($data['amount'])) 
	// 	{
	// 		$errors['amount'] = "Order Amount is require_onced"; 

	// 	}elseif(!preg_match('/[1-9.]/', $data['amount'])) 
	// 	{
	// 		$errors['amount'] = "Amount must be a number";
	// 	}
		
	// 	//validating Image Field
	// 	if (!$id || ($id &&  !empty($data['image']))) 
	// 	{
	// 		$max_size = 4; //mbs
	// 		$size = $max_size * (1024 * 1024);

	// 		if (empty($data['image'])) 
	// 		{
	// 			$errors['image'] = "Image is require_onced"; 

	// 		}elseif(!($data['image']['type'] == "image/jpeg" || $data['image']['type'] == "image/png" )) 
	// 		{
	// 			$errors['image'] = "Image must be a valid JPEG or PNG";
			
	// 		}elseif($data['image']['error'] > 0) 
	// 		{
	// 			$errors['image'] = "The image failed to upload. Error No.".$data['image']['error'];
			
	// 		}elseif($data['image']['size'] > $size) 
	// 		{
	// 			$errors['image'] = "The image size must not exceed ".$max_size."Mb";
	// 		}
	// 	}
		


	// 	return $errors;
	// }


	// function generate_barcode()
	// {
	// 	return "2222".rand(1000, 999999999);
	// }


	// function generate_filename($ext = "jpg")
	// {
	// 	return hash("sha1", rand(1000, 999999999))."_".rand(1000, 9999).".".$ext;
	// }
