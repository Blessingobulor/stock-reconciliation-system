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
				<form method="post" enctype="multipart/form-data">
					<center>
						<h3><i class="fa fa-user-tie"></i> Edit User</h3>
					</center>
					<br>
					
					<div class="mb-2">
					  <label for="usernameControlInput1" class="form-label">Username</label>
					  <input type="text" value="<?=set_value('username', $row['username'])?>" name="username" class="form-control <?=!empty($errors['username'])?'border-danger':''?>" id="usernameControlInput1" placeholder="Username">
					  <?php if(!empty($errors['username'])):?>
					  	<small class="text-danger"><?=$errors['username']?></small>
					  <?php endif;?>
					</div>

					<div class="mb-2">
					  <label for="emailControlInput1" class="form-label">Email address</label>
					  <input type="email" value="<?=set_value('email', $row['email'])?>" name="email" class="form-control <?=!empty($errors['email'])?'border-danger':''?>" id="emailControlInput1" placeholder="name@example.com">
					  <?php if(!empty($errors['email'])):?>
					  	<small class="text-danger"><?=$errors['email']?></small>
					  <?php endif;?>
					</div>


					<?php if(Auth::get('role') == "admin"):?>
						<div class="mb-2">
						  <label for="genderControlInput1" class="form-label">Gender</label>
						  <select name="gender" class="form-control <?=!empty($errors['gender'])?'border-danger':''?>" id="genderControlInput1">
						  	<option><?=$row['gender']?></option>
						  	<option>male</option>
						  	<option>female</option>
						  </select>

						  <?php if(!empty($errors['gender'])):?>
						  	<small class="text-danger"><?=$errors['gender']?></small>
						  <?php endif;?>
						</div>

						<div class="mb-2">
						  <label for="roleControlInput1" class="form-label">Role</label>
						  <select name="role" class="form-control <?=!empty($errors['role'])?'border-danger':''?>" id="roleControlInput1">
						  	<option><?=$row['role']?></option>
						  	<option>admin</option>
						  	<option>supervisor</option>
						  	<option>cashier</option>
						  	<option>user</option>
						  </select>

						  <?php if(!empty($errors['role'])):?>
						  	<small class="text-danger"><?=$errors['role']?></small>
						  <?php endif;?>
						</div>
					<?php endif;?>



					<div style="font-size: 13px;" class="text-muted">
						You can leave the password field empty if you don't wish to change it
					</div>
					<div class="input-group mb-2">
					  <span class="input-group-text" id="basic-addon1">Password</span>
					  <input type="password" value="<?=set_value('password','')?>" name="password" class="form-control <?=!empty($errors['password'])?'border-danger':''?>" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
					  <?php if(!empty($errors['password'])):?>
					  	<small class="text-danger col-12"><?=$errors['password']?></small>
					  <?php endif;?>
					</div>

					<div class="input-group mb-2">
					  <span class="input-group-text" id="basic-addon1">Retype Password</span>
					  <input type="password" value="<?=set_value('password_retype','')?>" name="password_retype" class="form-control <?=!empty($errors['password_retype'])?'border-danger':''?>" placeholder="Retype Password" aria-label="Retype Password" aria-describedby="basic-addon1">
					  <?php if(!empty($errors['password_retype'])):?>
					  	<small class="text-danger col-12	"><?=$errors['password_retype']?></small>
					  <?php endif;?>
					</div>

					<button class="btn btn-success float-end"> Save Changes </button>

					<?php if(Auth::get('role') == "admin"):?>
						<a href="<?=$back_link?>">
							<button type="button" class="btn btn-primary"> Cancel </button>
						</a>
					<?php else:?>
						<a href="index.php?pg=profile">
							<button type="button" class="btn btn-primary"> Cancel </button>
						</a>
					<?php endif;?>
				</form>
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






























