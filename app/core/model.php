<?php

/**
 * Model Class
 */
class Model extends Database
{

/*--------------------------------------------------------------------------------------------------------------------------
	This function select only the columns needed in the database 
	from the $_POST super global variable and unset the others that are not needed  
---------------------------------------------------------------------------------------------------------------------------*/
	protected function get_allowed_columns($data)
	{
		if (!empty($this->allowed_columns)) 
		{
			foreach($data as $key => $value) 
			{
				if(!in_array($key, $this->allowed_columns)) 
				{
					unset($data[$key]);
				}
			}
			return $data;
		}
	}
						
/*--------------------------------------------------------------------------------------------------------------------------
	 
------------------------------------ ---------------------------------------------------------------------------------------*/
	public function where($data, $limit = 20, $offset = 0, $order = "desc", $order_column = "id")
	{
		$keys = array_keys($data);

		$query = "select * from $this->table where ";
		foreach ($keys as $key) 
		{
			$query .= "$key = :$key && ";
		}
		$query = trim($query, " && ");
		$query .= " order by $order_column $order limit $limit offset $offset";
		$db = new Database();
		return $db->query($query, $data);
	}


/*--------------------------------------------------------------------------------------------------------------------------
	 
---------------------------------------------------------------------------------------------------------------------------*/
	public function getAll($limit = 20, $offset = 0, $order = "desc", $order_column = "id")
	{
		$query = "select * from $this->table order by $order_column $order limit $limit offset $offset";
		$db = new Database();
		return $db->query($query);

	}



/*--------------------------------------------------------------------------------------------------------------------------
	Creating Multipurpose insert function which can insert into any table.
	This function run only the insert queries instead of 
	writing the insert query string many times; Inserting dynamically
---------------------------------------------------------------------------------------------------------------------------*/
	public function insert($data)
	{
		
		$clean_array = $this->get_allowed_columns($data, $this->table);
		$keys = array_keys($clean_array);

		$query = "insert into $this->table ";
		$query .= "(". implode(",", $keys) .") values ";
		$query .= "(:". implode(",:", $keys) .")";

		$db = new Database();
		$db->query($query, $clean_array);
	}

	
	

/*--------------------------------------------------------------------------------------------------------------------------
	
---------------------------------------------------------------------------------------------------------------------------*/
	public function update($id, $data)
	{
		$clean_array = $this->get_allowed_columns($data, $this->table);
		$keys = array_keys($clean_array);

		$query = "update $this->table set ";
		
		foreach ($keys as $column) 
		{
			$query .= $column . "=:" . $column .",";
		}

		$query = trim($query, ",");
		$query .= " where id = :id";
		$clean_array['id'] = $id;

		$db = new Database();
		$db->query($query, $clean_array);
	}



/*--------------------------------------------------------------------------------------------------------------------------
	
---------------------------------------------------------------------------------------------------------------------------*/
	public function delete($id)
	{	
		$query = "delete from $this->table where id = :id limit 1";
		$clean_array['id'] = $id;

		$db = new Database();
		$db->query($query, $clean_array);
	}

	

/*--------------------------------------------------------------------------------------------------------------------------
	 
---------------------------------------------------------------------------------------------------------------------------*/
	public function first($data)
	{
		$keys = array_keys($data);

		$query = "select * from $this->table where ";
		foreach ($keys as $key) 
		{
			$query .= "$key = :$key && ";
		}
		$query = trim($query, "&& ");
		$db = new Database();
		
		if($res = $db->query($query, $data))
		{
			return $res[0];
		}

		return false;
	}
}


// //define arrays for data (each input)

// $item_sold = [];
// $price = [];
// $quantity = [];
// $amount = [];

// // for each post value scan for input

// foreach ($_POST as $key => $value){
// 	print(substr($key,0,strlen($key)-1));
// 	print("<br>");

// 	if ( substr($key,0,strlen($key)-1)== "item_sold_"){

// 		array_push($item_sold, $value);
// 	}


// 	if (substr($key,0,strlen($key)-1)== "price_"){
	
// 		array_push($price, $value);
// 	}


// 	if (substr($key,0,strlen($key)-1)==  "quantity_"){
	
// 		array_push($quantity, $value);
// 	}

// 	if (substr($key,0,strlen($key)-1)== "amount_"){
	
// 		array_push($amount, $value);

// 	}
		
//  }



// var_dump($item_sold);
// print("<br>");
// var_dump($price);
// print("<br>");
// var_dump($quantity);
// print("<br>");
// var_dump($amount);
// //Test!!?


// $item_sold = [];
// $price = [];
// $quantity = [];
// $amount = [];

// // $post is an array containing form data
// foreach ($post as $key => $value) {
//     if (str_starts_with($key, "name_")) {

//         if (str_ends_with($key, "item_sold")) {
//             $item_sold[] = $value;
//         } elseif (str_ends_with($key, "price")) {
//             $price[] = $value;
//         } elseif (str_ends_with($key, "quantity")) {
//             $quantity[] = $value;
//         } elseif (str_ends_with($key, "amount")) {
//             $amount[] = $value;
//         }
//     }
// }

// var_dump($item_sold);
// var_dump($price);
// var_dump($quantity);
// var_dump($amount);
// print("<br>");



// $item_sold = [];
// $price = [];
// $quantity = [];
// $amount = [];

// // Check if $post is an array before attempting to loop through it
// if(is_array($post)){
//     foreach ($post as $key => $value) {
//         if (str_starts_with($key, "name_")) {

//             if (str_ends_with($key, "item_sold")) {
//                 $item_sold[] = $value;
//             } elseif (str_ends_with($key, "price")) {
//                 $price[] = $value;
//             } elseif (str_ends_with($key, "quantity")) {
//                 $quantity[] = $value;
//             } elseif (str_ends_with($key, "amount")) {
//                 $amount[] = $value;
//             }
//         }
//     }
// } else {
//     // If $post is not an array, handle the error here
//     echo "Error: \$post is not an array.";
// }

// var_dump($item_sold);
// var_dump($price);
// var_dump($quantity);
// var_dump($amount);
// print("<br>");

