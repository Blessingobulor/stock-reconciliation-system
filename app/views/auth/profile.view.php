<?php
if (!empty($_SESSION['referer'])) 
{
	$back_link = $_SESSION['referer'];

}else{

	$back_link  = "index.php?pg=admin&tab=users";
}


?>

<?php require_once views_path('partials/header');?>
	
	<div class="container-fluid border col-lg-4 col-md-5 mt-4 p-3 shadow-lg rounded">
			<?php if(is_array($row)):?>

				<center>
					<h3><i class="fa fa-user-tie"></i> User Pofile</h3>
				</center>
				<br>

				<table class="table table-hover table-striped">
					<tr>
						<td colspan="2">
							<img src="<?=crop($row['image'],300,$row['gender'])?>" style="width:100%; max-width: 100px;">
						</td>
					</tr>
					<tr>
						<th>Username:</th> <td><?=$row['username']?></td>
					</tr>
					<tr>
						<th>Email:</th> <td><?=$row['email']?></td>
					</tr>
					<tr>
						<th>Gender:</th> <td><?=$row['gender']?></td>
					</tr>
					<tr>
						<th>Role:</th> <td><?=$row['role']?></td>
					</tr>
					<tr>
						<th>Date Created:</th> <td><?=get_date($row['date'])?></td>
					</tr>
				</table>

				<?php if(Auth::get('role') == "admin"):?>
					<a href="<?=$back_link?>">
						<button type="button" class="btn btn-primary btn-sm"> Cancel </button>
					</a>
				<?php else:?>
					<a href="index.php?pg=home">
						<button type="button" class="btn btn-primary btn-sm"> Cancel </button>
					</a>
				<?php endif;?>

				<a href="index.php?pg=edit-user&id=<?=$row['id']?>">
					<button type="button" class="btn btn-info btn-sm float-end text-white ms-3"> Edit </button>
				</a>

				<a href="index.php?pg=delete-user&id=<?=$row['id']?>">
					<button type="button" class="btn btn-danger btn-sm float-end"> Delete </button>
				</a>

			<?php else:?>

				<div class="alert alert-danger text-center">That user was not found!</div>
				<center>
					<a href="index.php?pg=admin&tab=users">
						<button type="button" class="btn btn-primary"> Cancel </button>
					</a>
				</center>
			<?php endif;?>
	</div>

	
	
<?php require_once views_path('partials/footer');?>






























