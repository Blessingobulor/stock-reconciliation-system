<?php 

session_start();
/* ROUTING PAGE(seeting up routing)
This init require_onced file contain all other files needed to be require_once on this page.
This is to reduce plenty require_onced files on the index page;
All requests in the url are routed through this page.
*/
define("ABSPATH", __DIR__);

require_once "../app/core/init.php";

/* SETTING UP CONTROLLERS
if the system dont find any controller(page) in the url, it default to home controller.
But if a controller file was found(exist), it will be stored in the page_name varible in $_GET supper global
and find the controller file to require_once it
*/

/* THIS CAN BE USE
$controller = "home,";
 if (isset($_GET['page_name'])) 
{
	$controller = $_GET['page_name'];
}
	OR THIS*/

$controller = $_GET['pg'] ?? "home";
//Converting users supplied data to lowercase (do not trust users supplied data!)
$controller = strtolower($controller);  

if (file_exists("../app/controllers/".$controller.".php")) 
{
	require_once "../app/controllers/".$controller.".php";	

}else{

	echo"Controller not found";
	//Note: you can require_once a page like (404 page not found) here instead of echo
}
