<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<?php

require_once views_path('electronics-store-stock/electronics-store-stock-new');

$errors = [];
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_POST['created_by'] = $_SESSION['USER']['user_id'];

    $electronics_store_stock = new electronics_store_stock();
    $products = new stock();

    $all_array = $_POST;

    $not_needed_array = [
        'source',
        'date',
        'stock_id',
        'branch_name',
    ];

    function needed_items($all_array, $not_needed_array) {
        foreach ($all_array as $key => $value) {
            if (in_array($key, $not_needed_array) && ($key !== "stock_id" && $key !== "date" && $key !== "source" && $key !== "branch_name")) {
                unset($all_array[$key]);
            }
        }

        return $all_array;
    }

    $needed = needed_items($all_array, $not_needed_array);
    $count = 0;

    foreach ($needed as $key => $value) {
        if (strstr($key, "stock_name")) {
            $count++;
        }
    }

    // if the stock exist increase the quantity
    $electronics_store_stock = new electronics_store_stock();
    for ($i = 0; $i < $count; $i++) {
        $stock_name = $needed["stock_name_" . $i];
        $quantity = $needed["quantity_" . $i];

        $items = [
            "stock_name" => $needed["stock_name_" . $i],
            "qty" => $needed["quantity_" . $i],
            "category" => $needed["category_" . $i],
            "source" => $needed["source"],
            "date" => $needed["date"],
            "stock_id" => $needed["stock_id"],
            "branch_name" => $needed["branch_name"],
        ];

        $user_id = $_SESSION['USER']['user_id'];
        $stock = "";

        $db = new Database();
        $sql = "SELECT * FROM stock WHERE stock_name = :stock_name AND created_by = :user_id";
 
        $result = $db->query($sql, ["stock_name" => $stock_name, "user_id" => $user_id]);

        if (isset($result[0])) {
            $stock = $result[0];
        }

        if ($stock) {
            $quantity = $stock['qty'] + $quantity;
            $sql = "UPDATE stock SET qty = :quantity WHERE stock_name = :stock_name AND created_by = :user_id";

            $update = $db->query($sql, ["stock_name" => $stock_name, "quantity" => $quantity, "user_id" => $user_id]);
        } else {
            $stock_items = [
                "stock_name" => $stock_name,
                "qty" => $quantity,
                "category" => $needed["category_" . $i],
                "branch_name" => $needed["branch_name"],
                "created_by" => $user_id
            ];

            $products->insert($stock_items);
        }

        $items['created_by'] = $user_id;
        $electronics_store_stock->insert($items);
        $success_message = 'Submitted successfully';
    }
}

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
          </script>';
}
?>
