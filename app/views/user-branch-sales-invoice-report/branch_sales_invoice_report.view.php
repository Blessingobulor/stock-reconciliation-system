
<?php require_once views_path('partials/header');

?>

<style>
	
	.cashier{
		box-sizing: border-box;
		display: flex;
		background-color: none;
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
	

	<form style="margin: 40px;"class="row float-end <?= !Auth::access('cashier') ?> ">
			<h2>NOVELSOLAR CUSTOMER SALES INVOICE</h2>

			<br><br>
			<hr>

			<div class="col-md-5"> 
			<label style="font: 20px; background-position: center; padding: 30px; for="startdat"> Start Date </label>
			<input style="width: 300px; height: 30px;"class="form-control" id="startdate" type="date" name="start_date" value="<?= !empty($_GET['startdate']) ? $_GET['startdate'] : ''?>">

		</div>

			<div class="col-md-5">
			<label style="font: 20px;  background-position: center; padding: 30px; " for="enddate"> End Date <small class="text-muted"></small></label>
			<input style="width: 300px;  height: 30px;" class="form-control" id="enddate" type="date" name="end_date" value="<?= !empty($_GET['enddate']) ? $_GET['enddate'] : ''?>">
		
		</div>

		<br><br>
 
				<a href="index.php?pg=branch-sales-new">
				<button style="margin: 30px; blue; max-width: 70px; height: 40px; position: grid; top: 30px; width: 70px; border-radius: "2px; type="button" class="btn btn-primary"> Cancel </button>		
				
				<button style="margin: 30px; max-width: 70px; height: 40px; position: grid; top: 30px; width: 70px; border-radius: 2px;"
            class="btn btn-primary btn-sm col" name="generate_branch_sales_invoice_report" type="submit"> Generate</button>

            </a>

		<input type="hidden" name="pg" value="user-branch-sales-invoice-report">
      <input type="hidden" name="tab" value="branch_sales_invoice_report">


    	</form>
	<div class="clearfix"></div>
</div>

<div class="table-responsive">

	<table class="table table-striped table-hover reportTable">
			
        <thead>
            <tr>
                <th>Sales Id</th>
                <th>Customer Name</th>
                <th>Branch Name</th>
                <th>Date</th>
                <th>Stock Name</th>
                <th>qty</th>
                <th>Price</th>
                <th>Amount</th>
                <th>Total</th>
                <th>Sub Total</th>
                <th>Vat Amount</th>
                <th>Grand Total</th>

               <a href="index.php?pg=branch_sales_invoice_reciept_report">
                <button style="margin: 5px; text-align: right;" type="button" class="btn btn-success">Generate Sales Invoice&nbsp;&nbsp;<i class="fa-solid fa-download"></i></button>
               </a>
                
            </tr>
        </thead>

        <tbody>
         <?php if (!empty($report)):  ?>
            <?php  foreach($report as $report): ?>
                <tr>
	                <td><?=$report['sales_id']?></td>
                    <td><?=$report['customer_name']?></td>
                    <td><?=$report['branch_name']?></td>
                    <td><?= date('j M, Y', strtotime($report['date'])) ?></td>
                    <td><?=$report['stock_name']?></td>
                    <td><?=$report['qty']?></td>
                    <td><?=$report['price']?></td>
                    <td><?=$report['amount']?></td>
                    <td><?=$report['total']?></td>
                    <td><?=$report['sub_total']?></td>
                    <td><?=$report['vat_amount']?></td>
                    <td><?=$report['grand_total']?></td>
                    
      

            </td>

                </tr>
            <?php endforeach ?>
            <?php else: echo "" ?>
        
        <?php endif; ?>
        </tbody>
			
    </table>
	
	<br>
	
	

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

               title: 'Customer Sales Reports'
            },
            {
               extend: 'print',
               exportOptions: {
                  columns: ':not(:last-child)' 
               },

               title: 'Customer Sales report'
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
