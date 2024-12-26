
<?php require_once views_path('partials/header');

$receiveReport = [];

?>

<style>
	
	.cashier{
		box-sizing: border-box;
		display: flex;
		background-color: black;
		align-self: center;
		
	}

	.admin{
		box-sizing: border-box;
		display: flex;
		background-color: none;
		align-self: center;
	}

</style>

<div>
	<!-- Cashier / Admin style -->


	<form style="margin: 40px;" class="row float-end <?= !Auth::access('supervisor') ?> ">
    <h2>RECEIVED FROM SUPPLIER REPORT</h2>
    <br><br>
    <hr>

    <div class="col-md-5">
        <label style="font: 20px; background-position: center; padding: 30px;" for="startdate"> Start Date </label>
        <input style="width: 300px; height: 30px;" class="form-control" id="startdate" type="date" name="start_date" 
            value="<?= !empty($_GET['startdate']) ? $_GET['startdate'] : '' ?>">
    </div>

    <div class="col-md-5">
        <label style="font: 20px; background-position: center; padding: 30px;" for="enddate"> End Date <small
                class="text-muted"></small></label>
        <input style="width: 300px; height: 30px;" class="form-control" id="enddate" type="date" name="end_date"
            value="<?= !empty($_GET['enddate']) ? $_GET['enddate'] : '' ?>">
    </div>

    <br><br>

    <a href="index.php?pg=recieved-from-supplier-new">
       <button style="margin: 30px; background-color: blue; max-width: 70px; height: 40px; position: grid; top: 30px; width: 70px; border-radius: 2px;" type="button" class="btn btn-primary"> Cancel </button>

        <button style="margin: 30px; max-width: 70px; height: 40px; position: grid; top: 30px; width: 70px; border-radius: 2px;"

            class="btn btn-primary btn-sm col" name="generate_report_from_recieved_supplier" type="submit"> Generate</button>
    </a>

    <!-- <input type="hidden" name="pg" value="users"> -->
    <input type="hidden" name="pg" value="user-recieved-from-supplier-report">
    <input type="hidden" name="tab" value="recieved_from_supplier_report">
    
</form>

	<div class="clearfix"></div>
</div>



<div class="table-responsive" id="recieved_from_supplier_report">

	<table class="table table-striped table-hover reportTable">
			
        <thead>
            <tr>
                <th>Recieved Stock Id</th>
                <th>Branch Name</th>
                <th>Supplier Name</th>
                <th>Date Supplied</th>
                <th>Stock Name</th>
                <th>qty</th>
                <th>Category</th>
                <th>Number Of Bad</th>

            </tr>
        </thead>

        <tbody>
            <?php  foreach($report as $report): ?>
                <tr>
                    <td><?=$report['recieved_stock_id']?></td>
                    <td><?=$report['branch_name']?></td>
                    <td><?=$report['supplier_name']?></td>
                    <td><?= date('j M, Y', strtotime($report['date_supplied'])) ?></td>
                    <td><?=$report['stock_name']?></td>
                    <td><?=$report['qty']?></td>
                    <td><?=$report['category']?></td>
                    <td><?=$report['number_of_bad']?></td>

                </tr>
            <?php endforeach ?>
        </tbody> 
			
    </table>

	<br>
	

	 <form method="post" action="" class="row float-end <?= !Auth::access('supervisor') ? 'cashier' : 'admin' ?>">

 </form>


<?php


?>

</div>



<script>
   $(document).ready(function() {
      // Destroy existing DataTable instance if it exists
      if ($.fn.DataTable.isDataTable('.reportTable')) {
         $('.reportTable').DataTable().destroy();
      }

      // Initialize DataTable with buttons
      $('.reportTable').DataTable({
         dom: 'Bfrtip',
         buttons: [
            'pdf',
            'print'
         ]
      });
   });
</script>


<!-- DataTables Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">

<!-- DataTables Buttons JS -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>


<script>

 