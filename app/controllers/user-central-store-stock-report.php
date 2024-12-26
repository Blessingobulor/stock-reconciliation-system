

<?php
$tab = $_GET['tab'] ?? 'central-store-stock';
$value = [];


$limit = 6;
$offset = $_GET['offset'] ?? 0;

if ($tab == "central_store_stock_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;



    if ($startdate && $enddate) {
        require_once __DIR__ . '/../models/central_store_stock.php';
        
        $user_id = $_SESSION['USER']['user_id'];
        $central_store_stock = new Central_Store_stock();

        $query = "SELECT * FROM " . $central_store_stock->table . " 
                  WHERE date BETWEEN :startdate AND :enddate AND created_by = '$user_id'";

        $value = $central_store_stock->query($query, [
            'startdate' => $startdate,
            'enddate'   => $enddate,
            
        ]);

    }


else{

    echo "no data available in the table";
}


    // Access control
    if (Auth::access('cashier')) {

        if (Auth::access('supervisor')) {
            require_once views_path('user-central-store-stock-report/user-central-store-stock-report');

        } else {
            require_once views_path('user-central-store-stock-report/central_store_stock_report');
        }

    } else {

        Auth::setMessage("You don't have access to the admin page");
        require_once views_path('auth/denied');
   }


        }