<?php
$tab = $_GET['tab'] ?? 'dashboard';
$report = [];

$limit = 6;
$offset = $_GET['offset'] ?? 0;

$report = [];
if($tab == "transfer_cctv_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;

    if($startdate && $enddate) {
        require_once __DIR__ . '/../models/transfer_cctv.php';
        
        $user_id = $_SESSION['USER']['user_id'];
        $transfer_cctv = new transfer_cctv();
        $query = "SELECT * FROM " . $transfer_cctv->table . "
        WHERE date BETWEEN :startdate AND :enddate AND created_by = '$user_id'";

        $report = $transfer_cctv->query($query, [
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
		require_once views_path('user-transfer-cctv-report/user-transfer-cctv-report');
	}else{
		require_once views_path('user-transfer-cctv-report/transfer_cctv_report');
	}

}else{

	Auth::setMessage("You don't have access to the admin page");
	require_once views_path('auth/denied');
}

	}



	