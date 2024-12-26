<?php
$tab = $_GET['tab'] ?? 'dashboard';
$report = [];

$limit = 6;
$offset = $_GET['offset'] ?? 0;

$report = [];
if($tab == "central_store_transfer_to_branch_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;

    if($startdate && $enddate) {
        require_once __DIR__ . '/../models/central_store_transfer_to_branch.php';
        
        $user_id = $_SESSION['USER']['user_id'];
        $central_store_transfer_to_branch = new central_store_transfer_to_branch();
        $query = "SELECT * FROM " . $central_store_transfer_to_branch->table . "
                  WHERE date BETWEEN :startdate AND :enddate AND created_by = '$user_id'";

        $report = $central_store_transfer_to_branch->query($query, [
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
		require_once views_path('user-central-store-transfer-to-branch-report/user-cenral-store-transfer-to-branch-report');
	}else{
		require_once views_path('user-central-store-transfer-to-branch-report/central_store_transfer_to_branch_report');
	}

}else{

	Auth::setMessage("You don't have access to the admin page");
	require_once views_path('auth/denied');
}

	}


	