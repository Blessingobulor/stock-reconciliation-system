<?php
/*--------------------------------------------------------------------------------------------------------------------------
	This is the logout controller. No view, just to redirect to login page.
	You can also use session_destroy(); session_regenerate_id();
	If session_regenerate_id() is used the user will be given new session if he/she login again;
	this is used incase your session is hijack by another person
	Note: dont use it if you are building an app lication that have cart
---------------------------------------------------------------------------------------------------------------------------*/
if (isset($_SESSION['USER'])) 
{
	unset($_SESSION['USER']);
	//session_destroy();
	//session_regenerate_id();
}


redirect("login");