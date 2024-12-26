

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<tr>
			<th>Customer Branch</th>
			<th>Surnname of Customer</th>
			<th>Other Names</th>
			<th>Email Address</th>
			<th>Phone Number</th>
			<th>Address</th>
			<th>Customer Type</th>
			<th>Sex</th>			
				
		</tr>
		<?php if(!empty($orders)):?>
			<?php foreach($orders as $order):?>
				<tr>
					<td>
						<?=esc($order['customer_branch'])?>	
					</td>

					<td>
						<?=esc($order['surname_of_customer'])?>	
					</td>

					<td>
						<?=esc($order['other_names'])?>	
					</td>

					<td>
						<?=esc($order['phone_number'])?>	
					</td>

					<td>
						<?=esc($order['address'])?>	
					</td>

					<td>
						<?=esc($order['customers_type'])?>	
					</td>

					<td>
						<?=esc($order['sex'])?>	
					</td>

					<td>
						<?=esc($order['item_sold'])?>	
					</td>
					
					<td>
							<?=get_user_by_id($order['user_id'])['username']?>	
					</td>

				
				</tr>
					

			<?php endforeach;?>
		<?php endif;?>
	</table>
	
</div>