<?php
$tab = $_GET['tab'] ?? 'dashboard';
$report = [];

$limit = 6;
$offset = $_GET['offset'] ?? 0;

$report = [];
if($tab == "branch_sales_invoice_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;

    if($startdate && $enddate) {
        require_once __DIR__ . '/../models/branch_sales.php';
        
        $user_id = $_SESSION['USER']['user_id'];
        $branch_sales = new branch_sales();
        $query = "SELECT * FROM " . $branch_sales->table . "
                  WHERE date BETWEEN :startdate AND :enddate AND created_by = '$user_id'";

        $report = $branch_sales->query($query, [
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
		require_once views_path('user-branch-sales-invoice-report/user-branch-sales-invoice-report');

	}else{

		require_once views_path('user-branch-sales-invoice-report/branch_sales_invoice_report');
	}

}else{

	Auth::setMessage("You don't have access to the admin page");
	require_once views_path('auth/denied');
}

    }


