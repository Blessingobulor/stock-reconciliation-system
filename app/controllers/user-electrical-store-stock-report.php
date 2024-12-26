<?php
$tab = $_GET['tab'] ?? 'dashboard';
$report = [];

$limit = 6;
$offset = $_GET['offset'] ?? 0;

$report = [];
if($tab == "electrical_store_stock_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;

    if($startdate && $enddate) {
        require_once __DIR__ . '/../models/electrical_store_stock.php';
        
        $user_id = $_SESSION['USER']['user_id'];
        $electrical_store_stock = new electrical_store_stock();
        $query = "SELECT * FROM " . $electrical_store_stock->table . "
                  WHERE date BETWEEN :startdate AND :enddate AND created_by = '$user_id'";
        $report = $electrical_store_stock->query($query, [
            'startdate' => $startdate,  
            'enddate'   => $enddate    
        ]);
    }


else{

    echo "no data available in the table";
}



if(Auth::access('cashier')) 
{
	if(Auth::access('supervisor')){
		
		require_once views_path('user-electrical-store-stock-report/user-electrical-store-stock-report');
	}else{

		require_once views_path('user-electrical-store-stock-report/electrical_store_stock_report');
	}

}else{

	Auth::setMessage("You don't have access to the admin page");
	require_once views_path('auth/denied');
}


	}


	