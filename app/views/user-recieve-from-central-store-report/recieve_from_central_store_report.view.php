
<?php require_once views_path('partials/header');

// $report = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_stock'])) {

    $qty = $_POST['qty'];
    $stock_id = $_POST['stock_id'];

    $id = $_POST['id'];
    $stock_name = $_POST['stock_name'];
    $created_by = $_POST['created_by'];


    $db = new Database();

    // Delete the stock item from the recieve_from_central store table

   $db->query("DELETE FROM recieve_from_central_store WHERE id = $id");


    // update the stock quantity in the stock table
    $db->query("UPDATE stock SET qty = qty - $qty WHERE stock_name = '$stock_name' AND created_by = '$created_by'");

   echo '<script>alert("Stock item deleted successfully!"); window.location.href = window.location.href;</script>';
}


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
    <h2>RECEIVE FROM CENTRAL STORE REPORT</h2>
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

    <a href="index.php?pg=recieve-central-store-new">
       <button style="margin: 30px; background-color: blue; max-width: 70px; height: 40px; position: grid; top: 30px; width: 70px; border-radius: 2px;" type="button" class="btn btn-primary"> Cancel </button>

        <button style="margin: 30px; max-width: 70px; height: 40px; position: grid; top: 30px; width: 70px; border-radius: 2px;"
            class="btn btn-primary btn-sm col" name="generate_report_from_central" type="submit"> Generate</button>
    </a>

    <!-- <input type="hidden" name="pg" value="users"> -->
    <input type="hidden" name="pg" value="user-recieve-from-central-store-report">
    <input type="hidden" name="tab" value="recieve_from_central_store_report">
    
</form>

	<div class="clearfix"></div>
</div>



<div class="table-responsive" id="recieve_from_central_store_report">

	<table class="table table-striped table-hover reportTable">
			
        <thead>
            <tr>
                <th>Stock Id</th>
                <th>Branch Name</th>
                <th>Source</th>
                <th>Date</th>
                <th>Stock Name</th>
                <th>qty</th>
                <th>Category</th>
                <th>Stock Serial Number</th>
                <th>Delete</th>


            </tr>
        </thead>

        <tbody>
            <?php if (!empty($report)):  ?>
            <?php  foreach($report as $report): ?>
                <tr>
                    <td><?=$report['stock_id']?></td>
                    <td><?=$report['branch_name']?></td>
                    <td><?=$report['source']?></td>
                    <td><?= date('j M, Y', strtotime($report['date'])) ?></td>
                    <td><?=$report['stock_name']?></td>
                    <td><?=$report['qty']?></td>
                    <td><?=$report['category']?></td>
                    <td><?=$report['stock_serial_number']?></td>
                    <td>

                        <form method="POST">
                           
                            <input type="hidden" name="qty" value="<?=$report['qty']?>">
                            <input type="hidden" name="stock_name" value="<?=$report['stock_name']?>">
                            <input type="hidden" name="stock_id" value="<?=$report['stock_id']?>">
                            <input type="hidden" name="id" value="<?=$report['id']?>">
                            <input type="hidden" name="created_by" value="<?=$report['created_by']?>">
                            <button type="submit" name="delete_stock" class="btn btn-danger">Delete</button>
                        </form>


                        </td>

                </tr>
            <?php endforeach ?>
        <?php else: echo "" ?>
        
        <?php endif; ?>

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
      if ($.fn.DataTable.isDataTable('.reportTable')) {
         $('.reportTable').DataTable().destroy();
      }

      $('.reportTable').DataTable({
         dom: 'Bfrtip',
         buttons: [
            {
               extend: 'pdfHtml5',
               exportOptions: {
                  columns: ':not(:last-child)'
               },

               title: 'Receive From Central Store Report'
            },
            {
               extend: 'print',
               exportOptions: {
                  columns: ':not(:last-child)' 
               },

               title: 'Receive From Central Store Report'
            }
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

 