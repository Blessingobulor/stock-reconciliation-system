<?php require_once views_path('partials/header');?>

<div class="row container-fluid">
<h3> <i class="fa fa-user-shield"></i> Admin</h3>
	<div class="col-12 col-sm-4 col-md-3 col-lg-2">
		<ul class="list-group">
			<a href="index.php?pg=admin">
		 		<li class="list-group-item <?=!$tab || $tab=='dashboard'?'active':'';?>"><i class="fa fa-dashboard"></i> Dashboard</li>
		  	</a>
		  	<a href="index.php?pg=admin&tab=users">
		  		<li class="list-group-item <?=$tab=='users'?'active':'';?>"><i class="fa fa-users"></i> Users</li>
		  	</a>

		  	<a href="index.php?pg=admin&tab=products">
		  		<li class="list-group-item <?=$tab=='products'?'active':'';?>"><i class="fa fa-dolly"></i> Products</li>
		  	 </a>

		  	<!-- <a href="index.php?pg=admin&tab=sales">
		  		<li class="list-group-item <?=$tab=='sales'?'active':'';?>"><i class="fa fa-briefcase"></i> Sales</li>
		  	</a>
 -->
			  <a href="index.php?pg=admin&tab=sales_report">
		  		<li class="list-group-item <?=$tab=='sales_report'?'active':'';?>"><i class="fa fa-briefcase"></i> Sales_Report</li>
		  	</a>


		  	 <a href="index.php?pg=admin&tab=recieve_from_central_store_report">
		  		<li class="list-group-item <?=$tab=='recieve_from_central_store_report'?'active':'';?>"><i class="fas fa-truck"></i> Central Store Report</li>
		  	</a>


			<a href="index.php?pg=admin&tab=branch_sales_report">
		  		<li class="list-group-item <?=$tab=='branch_sales_report'?'active':'';?>"><i class="fa fa-dolly"></i> Branch Sales Report</li>
		  	</a>


		  	<a href="index.php?pg=admin&tab=return_stock_report">
		  		<li class="list-group-item <?=$tab=='return_stock_report'?'active':'';?>"><i class="fas fa-undo"></i>Return Stock Report</li>
		  	</a>


		  	<a href="index.php?pg=admin&tab=recieve_from_branch_report">
		  		<li class="list-group-item <?=$tab=='recieve_from_branch_report'?'active':'';?>"><i class="fa fa-dolly"></i>Recieve From Branch Report </li>
		  	</a>



		  	<a href="index.php?pg=admin&tab=transfer_to_branch_report">
		  		<li class="list-group-item <?=$tab=='transfer_to_branch_report'?'active':'';?>"><i class="fa fa-dolly"></i>Transfer To Branch Report </li>
		  	</a>



		  	<a href="index.php?pg=logout">
		  		<li class="list-group-item"><i class="fa fa-sign-out-alt"></i> Logout</li>
		  	</a>
		  	
		</ul>
	</div>
	<div class="border col p-3">
		<h4><?=strtoupper($tab)?></h4>

		<?php

		switch ($tab) 
		{
			case 'products':
				require_once views_path('admin/products');
				break;

			case 'users':
				require_once views_path('admin/users');
				break;

			// case 'sales':
			// 	require_once views_path('admin/sales');
			// 	break;

			case 'sales_report':
				require_once views_path('admin/sales_report');
				break;

			case 'branch_sales_report':
				require_once views_path('admin/branch_sales_report');
				break;
				

			case 'recieve_from_central_store_report':
				require_once views_path('admin/recieve_from_central_store_report');
				break;


			case 'return_stock_report':
				require_once views_path('admin/return_stock_report');
				break;
			

			case 'recieve_from_branch_report':
				require_once views_path('admin/recieve_from_branch_report');
				break;


				case 'transfer_to_branch_report':
				require_once views_path('admin/transfer_to_branch_report');
				break;

			// case 'orders':
			// 	require_once views_path('admin/orders');
			// 	break;


			default:
				# code...
				require_once views_path('admin/dashboard');
				break;
		}

		?>
	</div>
</div>




<?php require_once views_path('partials/footer');?>