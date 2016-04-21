<?php
	global $validationmessage;
	
	global $installdetails;
	global $installlineitems;
	
	$validationmessage = "";
	
	global $match;
	global $user;
	
	$urlstatus = $match['params'];
	
	$installdetails = getInstallationDetails($urlstatus["id"]);
	$installlineitems = generateInstallLineItemsList($urlstatus["id"]);
?>