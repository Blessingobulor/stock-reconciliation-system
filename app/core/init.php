<?php 

require_once "../app/core/config.php";
require_once "../app/core/functions.php";
require_once "../app/core/database.php";
require_once "../app/core/model.php";

spl_autoload_register('my_function');

function my_function($classname)
{
	$filename = "../app/models/".ucfirst($classname).".php";
	if (file_exists($filename)) 
	{
		require_once $filename;
	}
}