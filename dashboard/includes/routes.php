<?php
	// Add additional routes in this file.
	// Use the format shown in the user mappings if we need to do additional work when returning a view.

	$router->map('GET', '/', 'views/base.php', 'home');	
	$router->map('GET', '/home/', 'views/base.php', 'home-home');		
	
	$router->map('GET', '/users/', function() {			
		return 'views/users.php';
	}, 'users');

	$router->map('GET', '/users/edit', function() {		
		return 'views/users.php';
	}, 'editusers-noid');	
	
	$router->map('GET|POST', '/users/add', function() {
		require 'controllers/usercontroller.php';		
		return 'views/addusers.php';		
	}, 'addusers');	
	
	$router->map('GET|POST', '/users/edit/[i:id]', function($id) {
		global $edituser;
		$edituser = new User;
		$edituser = getEditUser($id);		
		require 'controllers/editusercontroller.php';		
		return 'views/editusers.php';		
	}, 'editusers');	
	
	$router->map('GET|POST', '/inventory/add', function() {
		require 'controllers/addpurchaseordercontroller.php';		
		return 'views/addpurchaseorder.php';		
	}, 'addpurchaseorder');		
	
	$router->map('GET|POST', '/inventory/purchaseorder/view', function() {
		require 'controllers/viewpurchaseordercontroller.php';		
		return 'views/viewpurchaseorder.php';		
	}, 'viewpurchaseorder');
	
	$router->map('GET|POST', '/inventory/purchaseorder/view/[i:id]', function() {
		require 'controllers/viewsinglepurchaseordercontroller.php';		
		return 'views/viewsinglepurchaseorder.php';		
	}, 'viewsinglepurchaseorder');	
	
	$router->map('GET|POST', '/inventory/purchaseorder/edit/[i:id]', function() {
		require 'controllers/editsinglepurchaseordercontroller.php';		
		return 'views/editsinglepurchaseorder.php';		
	}, 'editsinglepurchaseorder');		
	
	$router->map('GET|POST', '/inventory/view', function() {
		require 'controllers/viewinventorycontroller.php';		
		return 'views/viewinventory.php';		
	}, 'viewinventory');	

	$router->map('GET|POST', '/inventory/edit', function() {
		require 'controllers/editinventorycontroller.php';		
		return 'views/editinventory.php';		
	}, 'editinventory');		

	$router->map('GET|POST', '/inventory/view/user', function() {
		require 'controllers/viewuserinventorycontroller.php';		
		return 'views/viewuserinventory.php';		
	}, 'viewuserinventory');		
	
	$router->map('GET|POST', '/inventory/pending', function() {		
		require 'controllers/pendinglocationtransferscontroller.php';		
		return 'views/pendinglocationtransfers.php';
	}, 'pendinglocationtransfers');	
	
	$router->map('GET|POST', '/inventory/pending/[i:id]', function($id) {
		require 'controllers/acceptlocationtransfercontroller.php';		
		return 'views/acceptlocationtransfer.php';
	}, 'acceptlocationtransfer');		

	$router->map('GET|POST', '/inventory/transferlocation', function() {
		require 'controllers/transferequipmentcontroller.php';		
		return 'views/transferequipmentlocation.php';		
	}, 'transferequipment');	
	
	$router->map('GET|POST', '/inventory/transferuser', function() {
		require 'controllers/transferequipmentusercontroller.php';		
		return 'views/transferequipmentuser.php';		
	}, 'transferuser');	

	$router->map('GET|POST', '/inventory/transferuser/[i:id]', function() {
		require 'controllers/transferequipmentuserdetailscontroller.php';		
		return 'views/transferequipmentuserdetails.php';		
	}, 'transferuserdetails');			

	$router->map('GET|POST', '/inventory/discrepancies', function() {
		require 'controllers/discrepanciescontroller.php';		
		return 'views/discrepancies.php';		
	}, 'discrepancies');			
	
	$router->map('GET|POST', '/locations/', function() {
		require 'controllers/locationscontroller.php';		
		return 'views/locations.php';		
	}, 'locations');		
	
	$router->map('GET|POST', '/locations/add', function() {
		require 'controllers/addlocationscontroller.php';		
		return 'views/addlocations.php';		
	}, 'addlocations');			
	
	$router->map('GET|POST', '/locations/managers', function() {
		require 'controllers/locationmanagerscontroller.php';		
		return 'views/locationmanagers.php';		
	}, 'locationmanagers');		
	
	$router->map('GET|POST', '/locations/managers/add', function() {
		require 'controllers/locationmanagercontroller.php';		
		return 'views/addlocationmanagers.php';		
	}, 'addlocationmanagers');	
	
	$router->map('GET|POST', '/installations/add', function() {
		require 'controllers/addinstallationcontroller.php';		
		return 'views/addinstallation.php';		
	}, 'addinstallation');
	
	$router->map('GET|POST', '/installations/view', function() {
		require 'controllers/viewinstallationcontroller.php';		
		return 'views/viewinstallations.php';
	}, 'viewinstallations');

	$router->map('GET|POST', '/installations/view/[i:id]', function() {
		require 'controllers/viewsingleinstallationcontroller.php';		
		return 'views/viewsingleinstallation.php';
	}, 'viewsingleinstallation');			
?>