<?php
$tab = $_GET['tab'] ?? 'dashboard';
$report = [];

$limit = 6;
$offset = $_GET['offset'] ?? 0;

$report = [];
if($tab == "admin_transfer_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;

    if($startdate && $enddate) {
        require_once __DIR__ . '/../models/admin_transfer.php';
        
        $user_id = $_SESSION['USER']['user_id'];
        $admin_transfer = new admin_transfer();
        $query = "SELECT * FROM " . $admin_transfer->table . "
                  WHERE date BETWEEN :startdate AND :enddate AND created_by = '$user_id'";

        $report = $admin_transfer->query($query, [
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
		require_once views_path('user-admin-transfer-report/user-admin-transfer-report');
	}else{
		
		require_once views_path('user-admin-transfer-report/admin_transfer_report');
	}

}else{

	Auth::setMessage("You don't have access to the admin page");
	require_once views_path('auth/denied');
}




