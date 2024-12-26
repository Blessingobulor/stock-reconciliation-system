<?php

/**
 * Users Class
 */
class User extends Model
{
	protected $table = "users";

	protected $allowed_columns = [
			'user_id',
			'username',
			'email',
			'password',
			'date',
			'image',
			'role',
			'gender'
			];


/*--------------------------------------------------------------------------------------------------------------------------
	Validate function: to validate all input
---------------------------------------------------------------------------------------------------------------------------*/
	public function validate($data, $id = null)
	{	
		$errors = [];

		//validating Username Field
		if (empty($data['username'])) 
		{
			$errors['username'] = "Username is require_onced"; 

		}elseif(!preg_match('/^[a-zA-Z]+$/', $data['username'])) 
		{
			$errors['username'] = "Only letters are allowed in Username";
		}

		//validating Email Field
		if (empty($data['email'])) 
		{
			$errors['email'] = "Email is require_onced"; 

		}elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) 
		{
			$errors['email'] = "Invalid email supplied";
		}

		//validating Password
		if(!$id)
		{
			if (empty($data['password'])) 
			{
				// $errors['password'] = "Password is require_onced"; 
				$errors['password'] = "Password is require_onced";

			}elseif($data['password'] !== $data['password_retype']) 
			{
				$errors['password_retype'] = "Password do not match";
			
			}elseif(strlen($data['password']) < 8) 
			{
				$errors['password'] = "Password must be atleast 8 characters long";
			}
		}else{

			if(!empty($data['password'])) 
			{
				if($data['password'] !== $data['password_retype']) 
				{
					$errors['password_retype'] = "Password do not match";
				
				}elseif(strlen($data['password']) < 8) 
				{
					$errors['password'] = "Password must be atleast 8 characters long";
				}
			}

		}

		return $errors;
	}

}