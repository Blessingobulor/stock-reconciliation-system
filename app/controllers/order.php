<?php

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$customer_info = new Customer_info();
	$customer_info->insert($_POST);

	$sales = new Sale();
	$sales->insert($_POST);


	$all_array = $_POST;

	$not_needed_array = [

		'customer_branch',
		'surname_of_customer',
		'other_names',
		'email_address',
		'phone_number',
		'address',
		'customers_type',
		'sex',
		'sales_number',
		'mode_of_payment',
		'total',
		'date',
		'user_id',

	];

function needed_items($all_array, $not_needed_array){

	foreach($all_array as $key => $value) 
	{
		if (in_array($key, $not_needed_array)) 
		{
			if ($key == "sales_number") 
			{
				continue;
			}elseif($key == "total"){
				continue;
			}else{
				unset($all_array[$key]);
			}
		}
	}

	return $all_array;
}


$needed = needed_items($all_array, $not_needed_array);
$count = 0;


foreach ($needed as $key => $value) 
{
	if (strstr($key, "item_sold")) 
	{
		$count++;
	}
}

$item_sold = new Item_sold();
for ($i=0; $i < $count; $i++) 
{ 
	// echo $i;
	$items = [
		"item_sold"=>$needed["item_sold_".$i], 
		"price"=>$needed["price_".$i],
		"qty"=>$needed["quantity_".$i],
		"amount"=>$needed["amount_".$i],
		"sales_number"=>$needed["sales_number"],
		"total"=>$needed["total"],
		"comments"=>$needed["comments"],
	];

	$item_sold->insert($items);
}

	

}

require_once views_path('orders/orders-new');