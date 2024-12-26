<?php require_once views_path('partials/header');?>
	
	<div class="container-fluid border col-lg-4 col-md-5 mt-4 p-3 shadow-lg rounded">
			<form method="post">
				<center>
					<h3><i class="fa fa-user-tie"></i> Create New User</h3>
					<div><?=esc(APP_NAME)?></div>
				</center>
				<br>
				<div class="mb-3">
				  <label for="usernameControlInput1" class="form-label">Username</label>
				  <input type="text" value="<?=set_value('username')?>" name="username" class="form-control <?=!empty($errors['username'])?'border-danger':''?>" id="usernameControlInput1" placeholder="Username">
				  <?php if(!empty($errors['username'])):?>
				  	<small class="text-danger"><?=$errors['username']?></small>
				  <?php endif;?>
				</div>

				<div class="mb-3">
				  <label for="emailControlInput1" class="form-label">Email address</label>
				  <input type="email" value="<?=set_value('email')?>" name="email" class="form-control <?=!empty($errors['email'])?'border-danger':''?>" id="emailControlInput1" placeholder="name@example.com">
				  <?php if(!empty($errors['email'])):?>
				  	<small class="text-danger"><?=$errors['email']?></small>
				  <?php endif;?>
				</div>

				<div class="mb-2">
				  <label for="genderControlInput1" class="form-label">Gender</label>
				  <select name="gender" class="form-control <?=!empty($errors['gender'])?'border-danger':''?>" id="genderControlInput1">
				  	<option>male</option>
				  	<option>female</option>
				  </select>

				  <?php if(!empty($errors['gender'])):?>
				  	<small class="text-danger"><?=$errors['gender']?></small>
				  <?php endif;?>
				</div>

				<div class="input-group mb-3">
				  <span class="input-group-text" id="basic-addon1">Password</span>
				  <input type="password" value="<?=set_value('password')?>" name="password" class="form-control <?=!empty($errors['password'])?'border-danger':''?>" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
				  <?php if(!empty($errors['password'])):?>
				  	<small class="text-danger col-12"><?=$errors['password']?></small>
				  <?php endif;?>
				</div>

				<div class="input-group mb-3">
				  <span class="input-group-text" id="basic-addon1">Retype Password</span>
				  <input type="password" value="<?=set_value('password_retype')?>" name="password_retype" class="form-control <?=!empty($errors['password_retype'])?'border-danger':''?>" placeholder="Retype Password" aria-label="Retype Password" aria-describedby="basic-addon1">
				  <?php if(!empty($errors['password_retype'])):?>
				  	<small class="text-danger col-12	"><?=$errors['password_retype']?></small>
				  <?php endif;?>
				</div>

				<br>
				<button class="btn btn-success float-end"> Create </button>
				<a href="index.php?pg=admin&tab=users">
					<button type="button" class="btn btn-primary"> Cancel </button>
				</a>
			</form>
	</div>

	
	
<?php require_once views_path('partials/footer');?>






























