<?php
$tab = $_GET['tab'] ?? 'dashboard';
$report = [];

$limit = 6;
$offset = $_GET['offset'] ?? 0;

$report = [];
if($tab == "electronics_return_inward_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;

    if($startdate && $enddate) {
        require_once __DIR__ . '/../models/electronics_return_inward.php';
        
        $user_id = $_SESSION['USER']['user_id'];
        $electronics_return_inward = new electronics_return_inward();
        $query = "SELECT * FROM " . $electronics_return_inward->table . "
        WHERE date BETWEEN :startdate AND :enddate AND created_by = '$user_id'";

        $report = $electronics_return_inward->query($query, [
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
		require_once views_path('user-electronics-return-inward-report/user-electronics-return-inward-report');
	}else{
		require_once views_path('user-electronics-return-inward-report/electronics_return_inward_report');
	}

}else{

	Auth::setMessage("You don't have access to the admin page");
	require_once views_path('auth/denied');
}


	}

	