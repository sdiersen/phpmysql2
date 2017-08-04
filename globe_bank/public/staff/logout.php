<?php 
	require_once('../../private/initialize.php'); 

	logout_admin();

	redirect_to(url_for('/staff/login.php'));
?>