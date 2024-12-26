<?php
$tab = $_GET['tab'] ?? 'dashboard';
$report = [];

$limit = 6;
$offset = $_GET['offset'] ?? 0;

$report = [];
if($tab == "stocks") 
{

	$limit = 6;
	$pager = new Pager($limit);
	$offset = $pager->offset;

	$stockClass = new stock();
	$stocks = $stockClass->query("select * from stocks order by id desc limit $limit offset $offset");

}elseif($tab == "orders") 
{

	$limit = 6;
	$pager = new Pager($limit);
	$offset = $pager->offset;

	$orderClass = new Order();
	$orders = $orderClass->query("select * from order_form order by id desc");
	
	
}elseif($tab == "sales_report") 
{
	 $startdate = $_GET['start_date'] ?? null;
	 $enddate = $_GET['end_date'] ?? null;
	 $user_id = $_SESSION['USER']['id'];
	

	if($startdate && $enddate){
		require_once __DIR__ . '/../models/Sale.php';
		
		$sale = new Sale();

		$query = "SELECT sale.*, item.*, customer.*, user.username
				FROM $sale->table AS sale
				JOIN item_sold As item ON  sale.sales_number =  item.sales_number
				INNER JOIN customer_info AS customer ON sale.sales_number = customer.sales_number
				LEFT JOIN users AS user ON sale.user_id = user.id 
				WHERE sale.date between :startdate AND :enddate";
		$report = $sale->query($query, [
			'startdate' => $startdate,
			'enddate'	=>	$enddate
		]);


	}


// query for recieve_from_central_store_report

}elseif($tab == "recieve_from_central_store_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;

    if($startdate && $enddate) {
        require_once __DIR__ . '/../models/recieve_from_central_store.php';
        
        $recieve_from_central_store = new recieve_from_central_store();
        $query = "SELECT * FROM " . $recieve_from_central_store->table . "
                  WHERE date BETWEEN :startdate AND :enddate";

        $report = $recieve_from_central_store->query($query, [
            'startdate' => $startdate,  
            'enddate'   => $enddate    
        ]);
    }


// query for branch_sales_report

}elseif($tab == "branch_sales_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;

    if($startdate && $enddate) {
        require_once __DIR__ . '/../models/branch_sales.php';
        
        $branch_sales = new branch_sales();
        $query = "SELECT * FROM " . $branch_sales->table . "
                  WHERE date BETWEEN :startdate AND :enddate";

        $report = $branch_sales->query($query, [
            'startdate' => $startdate,  
            'enddate'   => $enddate    
        ]);
    }

// query for return_stock_report

}elseif($tab == "return_stock_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;

    if($startdate && $enddate) {
        require_once __DIR__ . '/../models/return_stock.php';
        
        $return_stock = new return_stock();
        $query = "SELECT * FROM " . $return_stock->table . "
                  WHERE date BETWEEN :startdate AND :enddate";

        $report = $return_stock->query($query, [
            'startdate' => $startdate,  
            'enddate'   => $enddate    
        ]);
    }


// query for recieve_from_branch_report

}elseif($tab == "recieve_from_branch_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;

    if($startdate && $enddate) {
        require_once __DIR__ . '/../models/recieve_from_branch.php';
        
        $recieve_from_branch = new recieve_from_branch();
        $query = "SELECT * FROM " . $recieve_from_branch->table . "
                  WHERE date BETWEEN :startdate AND :enddate";

        $report = $recieve_from_branch->query($query, [
            'startdate' => $startdate,  
            'enddate'   => $enddate    
        ]);
    }

// query for transfer_to_branch_report

}elseif($tab == "transfer_to_branch_report") {
    $startdate = $_GET['start_date'] ?? null;
    $enddate = $_GET['end_date'] ?? null;

    if($startdate && $enddate) {
        require_once __DIR__ . '/../models/transfer_to_branch.php';
        
        $transfer_to_branch = new transfer_to_branch();
        $query = "SELECT * FROM " . $transfer_to_branch->table . "
                  WHERE date BETWEEN :startdate AND :enddate";

        $report = $transfer_to_branch->query($query, [
            'startdate' => $startdate,  
            'enddate'   => $enddate    
        ]);
    }





}elseif($tab == "sales") 
{
	$section = $_GET['s'] ?? 'table';
	$startdate = $_GET['startdate'] ?? null;
	$enddate = $_GET['enddate'] ?? null;

	$saleClass = new Sale();

	$limit = $_GET['limit'] ?? 10;
	$limit = (int)$limit;
	$limit = $limit < 1 ? 10 : $limit;

	$pager = new Pager($limit);
	$offset = $pager->offset;

	$query = "select * from sales order by id desc limit $limit offset $offset";

	//Get today's sales total
	$year = date("Y");
	$month = date("m");
	$day = date("d");	

	$query_total = "SELECT sum(total) as total FROM sales WHERE day(date) = $day && month(date) = $month && year(date) = $year";
	
	// If both start date and end date are set
	if ($startdate && $enddate) 
	{
// 		SELECT *
// FROM transaction_list
// INNER JOIN transaction_services ON transaction_list.id=transaction_services.transaction_id INNER JOIN service_list ON transaction_services.service_id=service_list.id 
// where transaction_list.status != 4 and  BETWEEN   
// 2023-05-10 and 2023-05-11


		// SELECT ts.*,tl.code, tl.client_name,sl.name as `service`,tl.date_created FROM `transaction_services` ts inner join transaction_list tl on ts.transaction_id = tl.id inner join service_list sl on ts.service_id = sl.id where date(tl.date_created) BETWEEN date('2023-05-10') AND date('2023-05-11')
		$query = "select * from sales where date BETWEEN '$startdate'  AND '$enddate' order by id desc limit $limit offset $offset";
		
		$query_total = "select sum(total) as total from sales where date BETWEEN '$startdate'  AND '$enddate'";
	
	}elseif ($startdate && !$enddate) 
	{
		// If only start date is set
		$styear = date("Y", strtotime($startdate));
		$stmonth = date("m", strtotime($startdate));
		$stday = date("d", strtotime($startdate));

		$query = "select * from sales where date = '$startdate' order by id desc limit $limit offset $offset";;
		
		$query_total = "select sum(total) as total from sales where date = '$startdate'";
	}

	// sales class .......
	$sales = $saleClass->query($query);

	$st = $saleClass->query($query_total);
	$sales_total = 0;

	if($st) 
	{
		$sales_total = $st[0]['total'] ?? 0;
	}

	if ($section == 'graph') 
	{
		// Read graph data
		$db = new Database();

		//query todays record
		$today = date("Y-m-d");
		$query = "SELECT total,date FROM sales WHERE DATE(date) = '$today' ";
		$today_records = $db->query($query);

		//query this week record
		// $today = date("Y-m-d");
		// $query = "SELECT total FROM sales WHERE DATE(date) = '$today' ";
		// $today_records = $db->query($query);

		//query this month record
		$thismonth = date("m");
		$thisyear = date("Y");

		$query = "SELECT total,date FROM sales WHERE month(date) = '$thismonth' && year(date) = '$thisyear' ";
		$thismonth_records = $db->query($query);

		$thisyear = date("Y");
		//query this year record 
		$query = "SELECT total,date FROM sales WHERE year(date) = '$thisyear' ";
		$thisyear_records = $db->query($query);
	}

}elseif($tab == "users") 
{
	$limit = 5;
	$pager = new Pager($limit);
	$offset = $pager->offset;

	$userClass = new User();
	$users = $userClass->query("select * from users order by id desc limit $limit offset $offset");

}elseif($tab == "dashboard")
{
	$db = new Database();

	// Users Count
	$query = "select count(id) as total from users";	
	$myusers = $db->query($query);
	$total_users = $myusers[0]['total'];

	// // Products Count
	// $query = "select count(id) as total from products";	
	// $myproducts = $db->query($query);
	// $total_products = $myproducts[0]['total'];

	// // Sales Count
	// $query = "select sum(total) as total from sales";	
	// $mysales = $db->query($query);
	// $total_sales = $mysales[0]['total'];
}



if(Auth::access('cashier')) 
{
	if(Auth::access('supervisor')){
		require_once views_path('admin/admin');
	}else{
		require_once views_path('admin/recieve_from_central_store_report');
	}

}else{

	Auth::setMessage("You don't have access to the admin page");
	require_once views_path('auth/denied');
}


if(Auth::access('cashier')) 
{
	if(Auth::access('supervisor')){
		require_once views_path('admin/admin');
	}else{
		require_once views_path('admin/branch_sales_report');
	}

}else{

	Auth::setMessage("You don't have access to the admin page");
	require_once views_path('auth/denied');
}


if(Auth::access('cashier')) 
{
	if(Auth::access('supervisor')){
		require_once views_path('admin/admin');
	}else{
		require_once views_path('admin/return_stock_ report');
	}

}else{

	Auth::setMessage("You don't have access to the admin page");
	require_once views_path('auth/denied');
}
