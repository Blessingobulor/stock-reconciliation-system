<!-- <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link <?=($section == 'table') ? 'active' : ''?>" aria-current="page" href="index.php?pg=admin&tab=sales">Table View</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?=($section == 'graph') ? 'active' : ''?>" href="index.php?pg=admin&tab=sales&s=graph">Graph View</a>
  </li>
</ul>

<br>

<?php if($section == "table"):?>

<div>
	<form class="row float-end">
		<div class="col">
			<label for="startdate"> Start Date: </label>
			<input class="form-control" id="startdate" type="date" name="startdate" value="<?= !empty($_GET['startdate']) ? $_GET['startdate'] : ''?>">
		</div>

		<div class="col">
			<label for="enddate"> End Date <small class="text-muted">(optional)</small>: </label>
			<input class="form-control" id="enddate" type="date" name="enddate" value="<?= !empty($_GET['enddate']) ? $_GET['enddate'] : ''?>">
		</div>

		<div class="col">
			<label for="limit"> Rows: </label>
			<input style="max-width: 80px;" class="form-control" id="limit" type="number" name="limit" min="1" value="<?= !empty($_GET['limit']) ? $_GET['limit'] : '10'?>">
		</div>
		<button style="max-width: 50px; height: 40px; position: relative; top: 20px" class="btn btn-primary btn-sm col"> Go <i class="fa fa-chevron-right"></i></button>
		<input type="hidden" name="pg" value="admin">
		<input type="hidden" name="tab" value="sales">
	</form>
	<div class="clearfix"></div>
</div>

<div class="table-responsive">
	<h2>Today's Sales: &#x20A6;<?= number_format($sales_total, 2) ?> </h2>
	<table class="table table-striped table-hover">
		<tr>
			<th>Productcode</th>
			<th>Receipt No</th>
			<th>Description</th>
			<th>Quantity</th>
			<th>Price</th> 
			<th>Total</th>
			<th>Cashier</th>
			<th>Date</th>
			<th>
				<a href="index.php?pg=home">
					<button class="btn btn-sm btn-primary"><i class=" fa fa-plus"></i> Add New Sale</button>
				</a>
			</th>
		</tr>
		<?php if(!empty($sales)):?>
			<?php foreach($sales as $sale):?>
				<tr>
					<td><?=esc($sale['product_code'])?></td>
					<td><?=esc($sale['receipt_no'])?></td>
					<td><?=esc($sale['description'])?></td>
					<td><?=esc($sale['qty'])?></td>
					<td>&#x20A6;<?=esc(number_format($sale['amount']))?></td>
					<td>&#x20A6;<?=esc(number_format($sale['total']))?></td>

					<?php

						$cashier = get_user_by_id($sale['user_id']);
						if(empty($cashier)) 
						{
							$name = 'Unknown';
							$namelink = '#';

						}else{

							$name = $cashier['username'];
							$namelink = "index.php?pg=profile&id=".$cashier['id'];
						}

					?>

					<td>
						<a href="<?=$namelink?>">
							<?=esc($name)?>
						</a>
					</td>
					<td><?=get_date($sale['date'])?></td>
					<td>
						<a href="index.php?pg=sale-edit&id=<?=$sale['id']?>">
							<button class="btn btn-sm btn-success">Edit</button>
						</a>
						
						<a href="index.php?pg=sale-delete&id=<?=$sale['id']?>">
							<button class="btn btn-sm btn-danger">Delete</button>
						</a>
					</td> 
				</tr>
			<?php endforeach;?>
		<?php endif;?>
	</table>

<?php

	$pager->display();

?>

</div>

<?php else:?>

	<style>

		@keyframes move{

			0%{ transform: translateY(200px);opacity: 0 }
			100%{ transform: translateY(0px); opacity: 1}
		}

		svg circle{

			stroke: white;
			fill: purple;
			animation: move 1.5s ease;
		}

		svg circle:hover{

			stroke: red;
			fill:white;
		}
		
	</style>

	<?php

		// Daily Graph
		$graph = new Graph();
		$data = generate_daily_data($today_records);
		$graph->title = "Today's Sales";
		$graph->xtitle = "Hours Of The Day";
		$graph->display($data);

	?>

	<br>
	<br>

	<?php

		// Monthly Graph
		$data = generate_monthly_data($thismonth_records);
		$graph->title = "This Month's Sales";
		$graph->xtitle = "Days Of The Month";
		$graph->display($data);

	?>
	<br>
	<br>

	<?php

		// Yearly Graph
		$data = generate_yearly_data($thisyear_records);
		$graph->title = "This Year's Sales";
		$graph->xtitle = "Months Of The Year";
		$graph->display($data);

	?>


<?php endif;?> -->