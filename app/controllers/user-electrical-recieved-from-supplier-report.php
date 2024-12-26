<?php
$tab = $_GET['tab'] ?? 'dashboard';
$report = [];

$limit = 6;
$offset = $_GET['offset'] ?? 0;

$report = [];
if($tab == "electrical_recieved_from_supplier_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;

    if($startdate && $enddate) {
        require_once __DIR__ . '/../models/electrical_recieved_from_supplier.php';
        
        $user_id = $_SESSION['USER']['user_id'];
        $electrical_recieved_from_supplier = new electrical_recieved_from_supplier();
        $query = "SELECT * FROM " . $electrical_recieved_from_supplier->table . "
            WHERE date BETWEEN :startdate AND :enddate AND created_by = '$user_id'";
        $report = $electrical_recieved_from_supplier->query($query, [
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
		
		require_once views_path('user-electrical-recieved-from-supplier-report/user-electrical-recieved-from-supplier-report');
	}else{

		require_once views_path('user-electrical-recieved-from-supplier-report/electrical_recieved_from_supplier_report');
	}

}else{

	Auth::setMessage("You don't have access to the admin page");
	require_once views_path('auth/denied');
}

    }

        

	

