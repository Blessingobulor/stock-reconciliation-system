<?php
$tab = $_GET['tab'] ?? 'cctv-store-stock';
$value = [];

$limit = 6;
$offset = $_GET['offset'] ?? 0;

if ($tab == "cctv_store_stock_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;



    if ($startdate && $enddate) {
        require_once __DIR__ . '/../models/cctv_store_stock.php';
        
        $user_id = $_SESSION['USER']['user_id'];
        $cctv_store_stock = new cctv_Store_stock();

        $query = "SELECT * FROM " . $cctv_store_stock->table . " 
                  WHERE date BETWEEN :startdate AND :enddate AND created_by = '$user_id'";

        $value = $cctv_store_stock->query($query, [
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
            require_once views_path('user-cctv-store-stock-report/user-cctv-store-stock-report');

        } else {
            require_once views_path('user-cctv-store-stock-report/cctv_store_stock_report');
        }

    } else {

        Auth::setMessage("You don't have access to the admin page");
        require_once views_path('auth/denied');
   }


        }