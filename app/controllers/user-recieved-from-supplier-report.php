<?php
$tab = $_GET['tab'] ?? 'dashboard';
$report = [];

$limit = 6;
$offset = $_GET['offset'] ?? 0;

$report = [];
if($tab == "recieved_from_supplier_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;

    if($startdate && $enddate) {
        require_once __DIR__ . '/../models/recieved_from_supplier.php';
        
        $user_id = $_SESSION['USER']['user_id'];
        $recieved_from_supplier = new recieved_from_supplier();
        $query = "SELECT * FROM " . $recieved_from_supplier->table . "
                  WHERE date BETWEEN :startdate AND :enddate AND created_by = '$user_id'";
        $report = $recieved_from_supplier->query($query, [
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
		require_once views_path('user-recieved-from-supplier-report/user-recieved-from-supplier-report');
	}else{
		require_once views_path('user-recieved-from-supplier-report/recieved_from_supplier_report');
	}

}else{

	Auth::setMessage("You don't have access to the admin page");
	require_once views_path('auth/denied');
}

    }