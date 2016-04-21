<?php
	global $validationmessage;
	$validationmessage = "";	
	
	global $podetails;
	global $polineitems;
	
	global $match;
	global $user;	
	
	$urlstatus = $match['params'];		
	
	$podetails = getPoDetails($urlstatus["id"]);	
	$polineitems = generatePoLineItemsList($podetails[1]);
?>