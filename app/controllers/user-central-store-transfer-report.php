<?php
$tab = $_GET['tab'] ?? 'central-store-transfer';
$report = [];

$limit = 6;
$offset = $_GET['offset'] ?? 0;

if ($tab == "central_store_transfer_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;


    if ($startdate && $enddate) {
        require_once __DIR__ . '/../models/central_store_transfer.php';
        
        $user_id = $_SESSION['USER']['user_id'];
        $central_store_transfer = new Central_Store_transfer();

        $query = "SELECT * FROM " . $central_store_transfer->table . " 
        WHERE date BETWEEN :startdate AND :enddate AND created_by = 
        '$user_id'";

        $report = $central_store_transfer->query($query, [
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
        require_once views_path('user-central-store-report/user-central-store-transfer-report');

        } else {
            require_once views_path('user-central-store-transfer-report/central_store_transfer_report');
        }

    } else {

        Auth::setMessage("You don't have access to the admin page");
        require_once views_path('auth/denied');
    }

        }
?>
