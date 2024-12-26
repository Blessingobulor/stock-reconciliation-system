<?php

defined("ABSPATH") ? "" : die();


// Access user/ admin to the point of sale section


if(Auth::access('Admin')) 
{
	require_once views_path('home');

}else{

	// Auth::setMessage("You need to login to access this page");
	// require_once views_path('auth/denied');
	redirect("login");
}
