<?php

/**
 * Sales Class
 */
class Sale extends Model
{
	public $table = "sales";

	protected $allowed_columns = [
			
			'sales_number',
			'mode_of_payment',
			'total',
			'date',
			'product_id',
			'user_id',
			];


/*--------------------------------------------------------------------------------------------------------------------------
	Validate function: to validate all input
---------------------------------------------------------------------------------------------------------------------------*/
	// public function validate($data, $id = null)
	// {	
	// 	$errors = [];

	// 	//validating description Field
	// 	if (empty($data['description'])) 
	// 	{
	// 		$errors['description'] = "sale description is require_onced"; 

	// 	}elseif(!preg_match('/[a-zA-Z0-9 ]/', $data['description'])) 
	// 	{
	// 		$errors['description'] = "Only letters and numbers are allowed in description";
	// 	}

	// 	//validating quantity Field
	// 	if (empty($data['qty'])) 
	// 	{
	// 		$errors['qty'] = "sale quantity is require_onced"; 

	// 	}elseif(!preg_match('/[0-9]/', $data['qty'])) 
	// 	{
	// 		$errors['qty'] = "Quantity must be a number";
	// 	}

	// 	//validating Amount Field
	// 	if (empty($data['amount'])) 
	// 	{
	// 		$errors['amount'] = "sale Amount is require_onced"; 

	// 	}elseif(!preg_match('/[1-9.]/', $data['amount'])) 
	// 	{
	// 		$errors['amount'] = "Amount must be a number";
	// 	}

	// 	return $errors;
	// }


}