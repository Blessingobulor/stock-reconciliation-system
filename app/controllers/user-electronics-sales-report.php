<?php
$tab = $_GET['tab'] ?? 'dashboard';
$report = [];

$limit = 6;
$offset = $_GET['offset'] ?? 0;

$report = [];
if($tab == "electronics_sales_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;

    if($startdate && $enddate) {
        require_once __DIR__ . '/../models/electronics_sales.php';
        
        $user_id = $_SESSION['USER']['user_id'];
        $electronics_sales = new electronics_sales();
        $query = "SELECT * FROM " . $electronics_sales->table . "
        WHERE date BETWEEN :startdate AND :enddate AND created_by = '$user_id'";

        $report = $electronics_sales->query($query, [
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
		require_once views_path('user-electronics-sales-report/user-electronics-sales-report');
	}else{
        
		require_once views_path('user-electronics-sales-report/electronics_sales_report');
	}

}else{

	Auth::setMessage("You don't have access to the admin page");
	require_once views_path('auth/denied');
}

    }
