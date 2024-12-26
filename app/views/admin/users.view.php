<div class="table-responsive">
	<table class="table table-striped table-hover">
		<tr>
			<th>Image</th>
			<th>username</th>
			<th>Gender</th>
			<th>Email</th>
			<th>Role</th>
			<th>Date Created</th>
			<th>
				<a href="index.php?pg=signup">
					<button class="btn btn-sm btn-primary"><i class=" fa fa-plus"></i>Create New User</button>
				</a>
			</th>
		</tr>
		<?php if(!empty($users)):?>
			<?php foreach($users as $user):?>
				<tr>
					<td>
						<a href="index.php?pg=profile&id=<?=$user['id']?>">
							<img src="<?=crop($user['image'],300,$user['gender'])?>" style="width:100%; max-width: 40px; border-radius: 50px;">
						</a>
					</td>
					<td>
						<a href="index.php?pg=profile&id=<?=$user['id']?>">
							<?=esc($user['username'])?>	
						</a>
					</td>
					<td><?=esc(ucfirst($user['gender']))?></td>
					<td><?=esc($user['email'])?></td>
					<td><?=esc(ucfirst($user['role']))?></td>
					
					<td><?=get_date($user['date'])?></td>
					<td>
						<a href="index.php?pg=edit-user&id=<?=$user['id']?>">
							<button class="btn btn-sm btn-success">Edit</button>
						</a>
						<a href="index.php?pg=delete-user&id=<?=$user['id']?>">
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