


<head>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>



<?php

$errors = [];

$success_message = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    
    $_POST['created_by'] = $_SESSION['USER']['user_id'];
    $recieved_from_supplier = new recieved_from_supplier();
    // $transfer_to_branch->insert($_POST);

    // COMMENT
    // Connecting the stocks table to the Receive from Central Store Form
    $products = new stock();

    $all_array = $_POST;

    $not_needed_array = [

            'recieved_stock_id',
            'branch_name',
            'supplier_name',
            'date',
            'recieved_by',
            'delivered_by'
        
    ];

function needed_items($all_array, $not_needed_array){

    foreach($all_array as $key => $value) 
    {
                if (in_array($key, $not_needed_array) && ($key !== "recieved_stock_id" && $key !== "branch_name" && $key !== "supplier_name" && $key !== "date" && $key !== "recieved_by" && $key !== "delivered_by" )) 
        {
            unset($all_array[$key]);
        }
    }

    return $all_array;
}



$needed = needed_items($all_array, $not_needed_array);
$count = 0;


foreach ($needed as $key => $value) 
{
    if (strstr($key, "stock_name")) 
    {
        $count++;
    }
}

$recieved_from_supplier = new recieved_from_supplier();
for ($i=0; $i < $count; $i++) 
{ 
    // PUBLIC DECLARATION OF THE STOCK NAME AND QUANTITY TO BE USED FOR CHECKING AND UPDATING IF NECESSARY
    $stock_name = $needed["stock_name_".$i];
    $quantity = $needed["quantity_".$i];
    // echo $i;
    $items = [

       "stock_name" => $needed["stock_name_" . $i],
            "qty" => $needed["quantity_" . $i],
            "category" => $needed["category_" . $i],
            "number_of_bad" => $needed["number_of_bad_" . $i],
            "recieved_stock_id" => $needed["recieved_stock_id"],
            "branch_name" => $needed["branch_name"],
            "supplier_name" => $needed["supplier_name"],
            "date" => $needed["date"],
            "recieved_by" => $needed["recieved_by"],
            "delivered_by" => $needed["delivered_by"],
            
    ];


    $user_id = $_SESSION['USER']['user_id'];
    $stock = "";


    $db = new Database();
    $sql = "SELECT * FROM stock WHERE stock_name = :stock_name AND created_by = '$user_id'";

    $result = $db->query($sql , ["stock_name"=>$stock_name]);


    if (isset($result['0']))$stock = $result['0'];
        
    if ($stock) {

        // If the stock name exists, increase the quantity
        $quantity = $stock['qty'] + $quantity;
        $sql = "UPDATE stock SET qty = $quantity WHERE stock_name = :stock_name AND created_by = '$user_id'";
        
            $update = $db->query($sql, ["stock_name"=>$stock_name ]);
        } else {
        // echo('e no work');
        // If the stock name doesn't exist, insert a new record
        $stock_items = [
            
            "stock_name" => $stock_name, 
            "qty" => $quantity,
            "category"=>$needed["category_".$i],
            "branch_name"=>$needed["branch_name"],
            "created_by"=>$user_id

        ];

        
        $products->insert($stock_items);     

    }

    $items['created_by'] = $_SESSION['USER']['user_id'];
    $recieved_from_supplier->insert($items);
    $success_message = 'Submitted successfully';
}
}


require_once views_path('recieved-from-supplier/recieved-from-supplier-new');


if (!empty($success_message)) {
    echo '<script>
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    title: "Success!",
                    text: "' . $success_message . '",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });

            document.getElementById("submit-button").addEventListener("click", function (e) {
                
            });
          </script>';
};
