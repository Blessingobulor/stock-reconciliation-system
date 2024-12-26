<?php require_once views_path('partials/header');?>
	
	<div class="container-fluid border col-lg-4 col-md-5 mt-4 p-3 shadow-lg rounded">
			<?php if(is_array($row) && $row['deletable']):?>
				<form method="post">
					<center>
						<h3><i class="fa fa-user-tie"></i> Delete User</h3>
						<div class="alert alert-danger  text-center">Are you sure you want to delete this user?</div>
					</center>
					<br>
					<div class="mb-3">
					  <label for="usernameControlInput1" class="form-label">Username</label>
					  <div class="form-control text-muted"><?=esc($row['username'])?></div>
					</div>

					<div class="mb-3">
					  <label for="emailControlInput1" class="form-label">Email address</label>
					  <div class="form-control text-muted"><?=esc($row['email'])?></div>
					</div>

					<div class="mb-3">
					  <label for="genderControlInput1" class="form-label">Gender</label>
					  <div class="form-control text-muted"><?=esc($row['gender'])?></div>
					</div>

					<div class="mb-3">
					  <label for="roleControlInput1" class="form-label">Role</label>
					  <div class="form-control text-muted"><?=esc($row['gender'])?></div>
					</div>

					<br>
					<button class="btn btn-danger float-end"> Delete </button>
					<a href="index.php?pg=admin&tab=users">
						<button type="button" class="btn btn-primary"> Cancel </button>
					</a>
				</form>
			<?php else:?>
				<?php if(is_array($row) && !$row['deletable']):?>
					<div class="alert alert-danger text-center">Admin cannot be deleted!</div>
				<?php else:?>
					<div class="alert alert-danger text-center">That user was not found!</div>
				<?php endif;?>
				<center>
					<a href="index.php?pg=admin&tab=users">
						<button type="button" class="btn btn-primary"> Cancel </button>
					</a>
				</center>
			<?php endif;?>
	</div>

	
	
<?php require_once views_path('partials/footer');?>






























