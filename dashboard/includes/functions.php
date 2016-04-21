<?php
	function getTableRecords($tablename) {
		global $db;
		
		$selectall = "SELECT * FROM `" . $tablename . "` WHERE 1";		
		$select = $db->prepare($selectall);
		$select->execute();
		$results = $select->fetchAll();
		
		return $results;
	}	
	
	function generateUpdatedInventoryQuantityList() {
		$inventoryitems = getTableRecords("inventory");
		
		foreach( $inventoryitems as $item ){
			$inventorytable = $inventorytable . "<tr><td>"
			. $item[1] . "</td><td>" 
			. $item[3] . "</td><td>" 			
			. "<input type='number' class='form-control' name='itemquantity[]' value='" . $item[2] . "' min='0'></input><input type='hidden' name='itemid[]' value='" . $item[1] . "'></input></td></tr>";
		}
		
		return $inventorytable;			
	}
	

	// Compilation of functions to be removed and replaced with the getTableRecords function since they are all doing the same thing
	function getInventoryItems(){
		global $db;
		
		$selectinventoryitems ="SELECT * FROM `inventoryitems`";
		$select = $db->prepare($selectinventoryitems);
		$select->execute();
		$inventoryitemlist = $select->fetchAll();
		
		return $inventoryitemlist;
	}	
	
	function getLocations() {
		global $db;
		
		$selectlocations = "SELECT * FROM `locations`";
		$select = $db->prepare($selectlocations);
		$select->execute();
		$locationlist = $select->fetchAll();
		
		return $locationlist;
	}	
	
	function getInventoryList() {
		global $db;
		
		$selectinventory = "SELECT * FROM `inventory`";
		$select = $db->prepare($selectinventory);
		$select->execute();
		$inventorylist = $select->fetchAll();
		
		return $inventorylist;	
	}	
	
	function getRoles() {
		global $db;
		
		$selectroles = "SELECT * FROM `role`";
		$select = $db->prepare($selectroles);
		$select->execute();
		$rolelist = $select->fetchAll();
		
		return $rolelist;
	}	
	
	function getInstallationList() {
		global $db;
		
		$selectinstallations = "SELECT * FROM `installations`";
		$select = $db->prepare($selectinstallations);
		$select->execute();
		$installationlist = $select->fetchAll();
		
		return $installationlist;
	}
	// End of list of functions to be removed

	function getCurrentUser($email) {
		global $db;
		$user = new User;
		$selectcurrentuser = "SELECT `users`.*, `role`.type, `locations`.`locationname` FROM `users` INNER JOIN `role` on `users`.role=`role`.id LEFT OUTER JOIN `locations` on `users`.location=`locations`.id  WHERE `email` = '" . $email . "'";
				
		if ($select = $db->query($selectcurrentuser)){			
			while ($row = $select->fetch(PDO::FETCH_BOTH)) {			
				$user->setFirstName($row['firstname']);			
				$user->setLastName($row['lastname']);
				$user->setEmail($row['email']);
				$user->setEmployeeID($row['employeeid']);
				$user->setID($row['id']);
				$user->setRole($row['type']);
				$user->setLocation($row['location']);
			}		
		}
		return $user;
	}
	
	function getEditUser($id) {
		global $db;
		$edituser = new User;
		$selectedituser = "SELECT `users`.*, `role`.type, `locations`.`locationname` FROM `users` INNER JOIN `role` on `users`.role=`role`.id LEFT OUTER JOIN `locations` on `users`.location=`locations`.id  WHERE `users`.`id` = '" . $id . "'";	
		
		if ($select = $db->query($selectedituser)){			
			while ($row = $select->fetch(PDO::FETCH_BOTH)) {			
				$edituser->setFirstName($row['firstname']);			
				$edituser->setLastName($row['lastname']);
				$edituser->setEmail($row['email']);
				$edituser->setEmployeeID($row['employeeid']);
				$edituser->setID($row['id']);
				$edituser->setRole($row['type']);
				$edituser->setLocation($row['location']);
			}		
		}
		return $edituser;		
	}
	
	function getUserList() {
		global $db;
		
		$selectusers = "SELECT `users`.*, `role`.type, `locations`.`locationname` FROM `users` INNER JOIN `role` on `users`.role=`role`.id LEFT OUTER JOIN `locations` on `users`.location=`locations`.id";
		$select = $db->prepare($selectusers);
		$select->execute();
		$userlist = $select->fetchAll();
		
		return $userlist;
	}
	
	function getLocationTechnicianList( $locationid ){
		global $db;
		
		$selectechs = "SELECT * FROM `users` WHERE role = 3 OR role = 2 AND location = " . $locationid;
		$select = $db->prepare($selectechs);
		$select->execute();
		$techlist = $select->fetchAll();
		
		return $techlist;
	}
	
	function generateLocationTechList( $locationid ){
		$techlist = getLocationTechnicianList( $locationid );
		
		foreach( $techlist as $tech ) {
			$techlistoptions = $techlistoptions . "<option value='" . $tech[0] . "'>" . ucwords($tech[3]) . " " . ucwords($tech[4]) . "</option>";				
		}
		
		return $techlistoptions;
	}
	
	function generateUserOptions() {
		global $edituser;
		
		// If we are editing a user, we want to pre-select their current employment level in the drop down options
		// If the global $edituser doesn't exist it means we are creating a new user
		$editinguserrole;		
		if( $edituser != NULL ){
			$editinguserrole = $edituser->getRole();
		} else {
			$editinguserrole = NULL;
		}
		
		$roles = getRoles();
		
		foreach($roles as $role) {
			if( $role[1] == $editinguserrole ){
				$rolelistings = $rolelistings . "<option value='" . $role[0] . "' selected='selected'>" . ucwords($role[1]) . "</option>";	
			} else {				
				$rolelistings = $rolelistings . "<option value='" . $role[0] . "'>" . ucwords($role[1]) . "</option>";	
			}
		}
		return $rolelistings;
	}
	
	function generateUserList() {
		$users = getUserList();
		$tempuser = getCurrentUser($_SESSION["myemail"]);
		
		if( $tempuser->getRole() == "admin" ) {
			foreach($users as $user) {
				$usertable = $usertable . "<tr><td>" 
				. $user[3] . "</td><td>" 
				. $user[4] . "</td><td>" 
				. $user[1] . "</td><td>" 
				. $user[9] . "</td><td>" 
				. $user[5] . "</td><td>" 			
				. ucwords($user[8]) . "</td><td><a href='/dashboard/users/edit/" 
				. $user[0] . "' class='btn-sm btn-warning'>Edit</a></td></tr>";
			}
		} else {
			foreach($users as $user) {
				$usertable = $usertable . "<tr><td>" 
				. $user[3] . "</td><td>" 
				. $user[4] . "</td><td>" 
				. $user[1] . "</td><td>" 
				. $user[9] . "</td><td>" 
				. $user[5] . "</td><td>" 			
				. ucwords($user[8]) . "</td>";
			}		
		}
		return $usertable;
	}
	
	function generateInstallationList() {
		$installationitems = getInstallationList();
		
		foreach ( $installationitems as $item ){
			$installtable = $installtable . "<tr><td>"
			. $item[1] . "</td><td>" 
			. $item[7] . "</td><td>" 
			. $item[6] . "</td><td><a href='/dashboard/installations/view/"
			. $item[0] . "'>View</a></td></tr>";
		}
		
		return $installtable;
	}
	
	function generateInventoryList() {
		$inventoryitems = getInventoryList();
		
		foreach( $inventoryitems as $item ){
			$inventorytable = $inventorytable . "<tr><td>"
			. $item[1] . "</td><td>" 
			. $item[3] . "</td><td>$" 
			. $item[4] . "</td><td>" 
			. $item[5] . "</td><td>" 
			. $item[6] . "</td><td>" 
			. $item[2] . "</td></tr>";
		}
		
		return $inventorytable;
	}
	
	function generateCompleteInventoryList() {
		global $db;
		global $validationmessage;
		
		$inventoryitems = getInventoryList();
		
		foreach( $inventoryitems as $item ){
			$locationinventory = getInventoryQuantityAtLocations($item[1]);
			$techinventory = getInventoryQuantityWithTechs($item[1]);
			
			$inventorytable = $inventorytable . "<tr><td>"
			. $item[1] . "</td><td>" 
			. $item[3] . "</td><td>$" 
			. $item[4] . "</td><td>" 
			. $item[5] . "</td><td>" 
			. $item[6] . "</td><td>" 
			. $item[2] . "</td><td>" 
			. $locationinventory . "</td><td>" 
			. $techinventory . "</td></tr>";			
		}
		
		return $inventorytable;
	}
	
	function getInventoryQuantityAtLocations( $productid ) {
		global $db;
		
		$countinventory = "SELECT quantity FROM `locationinventory` WHERE productid = " . $productid;
		$select = $db->prepare($countinventory);
		$select->execute();
		$inventorylist = $select->fetchAll();
		
		foreach( $inventorylist as $item ){
			$totalquantity = $totalquantity + $item[0];
		}
		
		return $totalquantity;
	}
	
	function getInventoryQuantityWithTechs( $productid) {
		global $db;
		
		$countinventory = "SELECT quantity FROM `userinventory` WHERE productid = " . $productid;
		$select = $db->prepare($countinventory);
		$select->execute();
		$inventorylist = $select->fetchAll();
		
		foreach( $inventorylist as $item ){
			$totalquantity = $totalquantity + $item[0];
		}
		
		return $totalquantity;	
	}
	
	function generateTransferInventoryList() {
		$inventoryitems = getInventoryList();
		
		foreach( $inventoryitems as $item ){
			$inventorytable = $inventorytable . "<tr><td>"
			. $item[1] . "</td><td>" 
			. $item[3] . "</td><td>" 
			. $item[2] . "</td><td>"
			. "<input type='number' class='form-control' name='itemquantity[]' max='" . $item[2] . "' min='0' value='0'></input><input type='hidden' name='itemid[]' value='" . $item[1] . "'></input></td></tr>";
		}
		
		return $inventorytable;	
	}

	function getLocationInventoryList( $locationid ) {
		global $db;				
		
		$selectinventory = "SELECT `locationinventory`.*, `inventory`.* FROM `locationinventory` INNER JOIN `inventory` on `locationinventory`.productid=`inventory`.productid WHERE locationid = " . $locationid;
		$select = $db->prepare($selectinventory);
		$select->execute();
		$inventorylist = $select->fetchAll();
		
		return $inventorylist;		
	}

	function generateTransferUserInventoryList( $locationid ) {
		$inventoryitems = getLocationInventoryList( $locationid );
		
		foreach( $inventoryitems as $item ){
			$inventorytable = $inventorytable . "<tr><td>"
			. $item[2] . "</td><td>" 
			. $item[7] . "</td><td>" 
			. $item[3] . "</td><td>"
			. "<input type='number' class='form-control' name='itemquantity[]' max='" . $item[3] . "' min='0'></input><input type='hidden' name='itemid[]' value='" . $item[2] . "'></input></td></tr>";
		}
		
		return $inventorytable;		
	}		
	
	function checkUserExists($email, $employeeid) {
		global $db;
		global $validationmessage;
		
		$selectuseremail = $db->query('SELECT * FROM `users` WHERE `email` = "' . $email . '"');
		$selectuserid = $db->query('SELECT * FROM `users` WHERE `employeeid` = "' . $employeeid . '"');
		
		$usercountemail = $selectuseremail->rowCount();
		$usercountid = $selectuserid->rowCount();
		$usercount = $usercountemail + $usercountid;
		if( $usercountemail >= 1 ) {
			$validationmessage = "A user with that email address already exists.";
		}
		if( $usercountid >= 1 ) {
			$validationmessage = "A user with that employee ID already exists.";
		}
		if( $usercount >= 2 ) {
			$validationmessage = "A user with that email address and employee ID already exists.";
		}
		return $usercount;
	}
	
	// The following two functions might seem redundant to the function above however these functions are used when a user profile is being updated
	// They make sure that if the email address or the employee ID is not already being used by another person
	// The database has it's own checks as well but we want to do validation for descriptive error messages as well
	function checkEmployeeEmailInUse($email) {
		global $db;
		global $validationmessage;			
		global $edituser;
		
		$edituserid = $edituser->getEmployeeID();
		
		$usercountemail = $db->query('SELECT count(*) FROM `users` WHERE `email` = "' . $email . '" AND `employeeid` != "' . $edituserid . '"')->fetchColumn();
		
		return $usercountemail;
	}
	
	function checkEmployeeIdInUse($employeeid) {
		global $db;
		global $validationmessage;	
		global $edituser;
		
		$edituseremail = $edituser->getEmail();
		
		$usercountid = $db->query('SELECT count(*) FROM `users` WHERE `employeeid` = "' . $employeeid . '" AND `email` != "' . $edituseremail . '"')->fetchColumn();
		
		return $usercountid;
	}	
	
	function createNewUser($email, $firstname, $lastname, $employeeid, $password, $role, $location) {
		global $db;
		global $validationmessage;
		$encryptedpassword = md5($password);

		$doesexist = checkUserExists($email, $employeeid);	
		
		if( $doesexist == 0 ) {
			$addnewuser = "INSERT INTO users(email, password, firstname, lastname, employeeid, role, location) VALUES('" . $email . "', '" . $encryptedpassword . "', '" . $firstname . "', '" . $lastname . "', '" . $employeeid . "', '" . $role . "', '" . $location . "')";
			$insertuser = $db->prepare($addnewuser);
			$status = $insertuser->execute();			
		}
		
		return $status;
	}
	
	function checkPoExists($ponumber) {
		global $db;
		global $validationmessage;
		
		$poinuse = $db->query('SELECT count(*) FROM `purchaseorder` WHERE `ponumber` = "' . $ponumber . '"')->fetchColumn();
		return $poinuse;
	}
	
	function checkItemExists($productid) {
		global $db;
		global $validationmessage;
		
		$productexists = $db->query('SELECT count(*) FROM `inventory` WHERE `productid` = "' . $productid . '"')->fetchColumn();
		return $productexists;
	}
	
	function checkItemExistsAtLocation($productid, $locationid) {
		global $db;
		global $validationmessage;
		
		$productexists = $db->query('SELECT count(*) FROM `locationinventory` WHERE `productid` = "' . $productid . '" AND `locationid` = "' . $locationid . '"')->fetchColumn();
		return $productexists;	
	}
	
	function createNewLocationTransfer($location, $submittedby){
		global $db;
		global $validationmessage;
		
		$addsuccess = false;
		
		$addnewpendingtransfer = "INSERT INTO pendinglocationtransfers(location, submittedby) VALUES('" . $location . "', '" . $submittedby . "')";		
		$inserttransfer = $db->prepare($addnewpendingtransfer);
		$status = $inserttransfer->execute();
		$newtransferid = $db->lastInsertId();
		$addsuccess = true;		
		
		return $newtransferid;
	}	
	
	function addLocationTransferLineItems($transferid, $productid, $quantity) {
		global $db;
		global $validationmessage;
		
		if( $quantity > 0 ){
			$addnewpendingtransferlineitem = "INSERT INTO pendinglocationtransferslineitems(transferid, productid, quantity) VALUES('" . $transferid . "', '" . $productid . "', '" . $quantity . "')";
			$insertlineitem = $db->prepare($addnewpendingtransferlineitem);
			$insertlineitem->execute();
			$validationmessage = "Item added.";
			
			$currentquantity = getCurrentInventoryQuantity($productid);
			$updatedquantity = $currentquantity - $quantity;			
			
			$updatequantityquery = "UPDATE `inventory` SET `quantity` = :quantity WHERE `productid` = :productid";
			$updatequantity = $db->prepare($updatequantityquery);
			$updatequantity->bindValue(":productid", $productid);
			$updatequantity->bindValue(":quantity", $updatedquantity);
			$updatequantity->execute();					
		}
	}
	
	function addInstallationInventory( $installationid, $productid, $quantity ){
		global $db;
		global $validationmessage;
		global $user;
		
		$userid = $user->getID();				
		
		if( $quantity > 0 ) {
			$addnewlineitem = "INSERT INTO installationlineitems( installationid, productid, quantity ) VALUES('" . $installationid . "', '" . $productid . "', '" . $quantity . "')";
			$insertlineitem = $db->prepare($addnewlineitem);
			$insertlineitem->execute();
			
			$currentquantity = getCurrentUserQuantity($productid);
			$updatedquantity = $currentquantity - $quantity;						
			
			$updatequantityquery = "UPDATE `userinventory` SET `quantity` = :quantity WHERE `userid` = :userid AND `productid` = :productid";
			$updatequantity = $db->prepare($updatequantityquery);
			$updatequantity->bindValue(":userid", $userid);
			$updatequantity->bindValue(":productid", $productid);
			$updatequantity->bindValue(":quantity", $updatedquantity);
			$updatequantity->execute();
		}
	}	
	
	function getCurrentUserQuantity($productid) {
		global $db;	
		global $user;
		
		$userid = $user->getID();		
		
		$currentquantity = $db->query('SELECT `quantity` FROM `userinventory` WHERE `userid` = "' . $userid . '" AND `productid` = "' . $productid . '"')->fetchColumn();
		return $currentquantity;
	}	
	
	function checkcsidexists($customerid) {
		global $db;
		global $validationmessage;
		
		$csidexists = $db->query('SELECT count(*) FROM `installations` WHERE `customerid` = "' . $customerid . '"')->fetchColumn();
		return $csidexists;
	}	
	
	function addNewInstallation( $customername, $address, $city, $state, $zip, $installdate, $customerid, $notes, $installtype, $techid ){
		global $db;
		global $validationmessage;
				
		$addnewinstallation = "INSERT INTO installations(customername, address, city, state, zip, installdate, customerid, notes, installtype, techid) VALUES('" . $customername . "', '" . $address . "', '" . $city . "', '" . $state . "', '" . $zip . "', '" . $installdate . "', '" . $customerid . "', '" . $notes . "', '" . $installtype . "' ,'" . $techid . "')";
		$insertinstall = $db->prepare($addnewinstallation);
		$insertinstall->execute();
		
		$newinstallid = $db->lastInsertId();
			
		return $newinstallid;
	}
	
	function addTechInventory( $techid, $productid, $productquantity, $locationurl ) {
		global $db;
		global $validationmessage;

		$techhasproduct = $db->query('SELECT count(*) FROM `userinventory` WHERE `userid` = "' . $techid . '" AND `productid` = "' . $productid . '"')->fetchColumn();		
		
		if( $techhasproduct == 0 ){
			if( $productquantity > 0 ){
				$addnewinventoryitem = "INSERT INTO userinventory(userid, productid, quantity) VALUES('" . $techid . "', '" . $productid . "', '" . $productquantity . "')";
				$insertlineitem = $db->prepare($addnewinventoryitem);
				$insertlineitem->execute();
			}
		} elseif ( $techhasproduct == 1 ){
			if( $productquantity > 0 ){
				$currentquantity = $db->query('SELECT `quantity` FROM `userinventory` WHERE `productid` = "' . $productid . '"')->fetchColumn();
				$updatedquantity = $currentquantity + $productquantity;
				
				$updatequery = "UPDATE `userinventory` SET `quantity` = :quantity WHERE `productid` = :productid AND `userid` = :userid";
				$updatequantity = $db->prepare($updatequery);
				$updatequantity->bindValue(":productid", $productid);
				$updatequantity->bindValue(":userid", $techid);
				$updatequantity->bindValue(":quantity", $updatedquantity);
				$updatequantity->execute();
			}
		}
		
		if( $productquantity > 0 ){
			$currentquantity = $db->query('SELECT `quantity` FROM `locationinventory` WHERE `productid` = "' . $productid . '"')->fetchColumn();
			$updatedquantity = $currentquantity - $productquantity;
			
			$updatequery = "UPDATE `locationinventory` SET `quantity` = :quantity WHERE `productid` = :productid AND `locationid` = :locationid";
			$updatequantity = $db->prepare($updatequery);
			$updatequantity->bindValue(":productid", $productid);
			$updatequantity->bindValue(":locationid", $locationurl);
			$updatequantity->bindValue(":quantity", $updatedquantity);
			$updatequantity->execute();			
		}
	}	
	
	function getPurchaseOrders() {
		global $db;
		global $user;
		global $validationmessage;
		
		$userrole = $user->getRole();
		
		if( $userrole == "admin" ){
			$pos = "SELECT * FROM `purchaseorder`";
			$selectpos = $db->prepare($pos);
			$selectpos->execute();
			$polist = $selectpos->fetchAll();
			
			foreach($polist as $po) {
				if( $po['paid'] == 0 ){
					$paidstatus = "<span class='text-danger'><span class='glyphicon glyphicon-remove'></span> Unpaid</span>";
				} else {
					$paidstatus = "<span class='text-success'><span class='glyphicon glyphicon-ok'></span> Paid</span>";
				}
				$potable = $potable . "<tr><td>"
				. $po['ponumber'] . "</td><td>"
				. $po['description'] . "</td><td>$"
				. $po['cost'] . "</td><td>"
				. $paidstatus . "</td><td><a href='/dashboard/inventory/purchaseorder/view/" 
				. $po['id'] . "' class='btn-sm btn-info'>View</a></td><td><a href='/dashboard/inventory/purchaseorder/edit/" 
				. $po['id'] . "' class='btn-sm btn-warning'>Edit</a></td></tr>";
			}			
		} else {
			$validationmessage = "You do not have permission to view this page.";
		}
		
		return $potable;
	}
	
	function getCurrentPendingLocationTransfers($currentmanagerid){
		global $db;
		global $user;	
		
		$userrole = $user->getRole();
		$currentmanagerid = $user->getID();
		
		if( $userrole == "manager" ) {		
			$currentmanagerlocations = "SELECT * FROM `locationmanagers` WHERE `employeeid` = '" . $currentmanagerid . "'";
			$selectmanagerlocations = $db->prepare($currentmanagerlocations);
			$selectmanagerlocations->execute();
			$managerlocationlist = $selectmanagerlocations->fetchAll();
			
			foreach($managerlocationlist as $managerlocation){				
				$currentpendingtransfers = "SELECT `pendinglocationtransfers`.*, `locations`.locationname, `users`.* FROM `pendinglocationtransfers` INNER JOIN `locations` on `pendinglocationtransfers`.location=`locations`.id LEFT OUTER JOIN `users` on `pendinglocationtransfers`.submittedby=`users`.id WHERE `pendinglocationtransfers`.location = '" . $managerlocation[1] . "' AND `pendinglocationtransfers`.processed = '0'";
				$selectpendingtransfers = $db->prepare($currentpendingtransfers);
				$selectpendingtransfers->execute();
				$pendingtransferlist = $selectpendingtransfers->fetchAll();
				
				foreach($pendingtransferlist as $pendingtransfer){
					$transfertable = $transfertable . "<tr><td>"
					. $pendingtransfer[5] . "</td><td>"
					. $pendingtransfer[3] . "</td><td>"
					. $pendingtransfer['firstname'] . " " . $pendingtransfer['lastname'] . "</td><td>"
					. $pendingtransfer[0] . "</td><td><a href='/dashboard/inventory/pending/" 
					. $pendingtransfer[0] . "' >Process Transfer</a></td></tr>";
				}						
			}
		} elseif ( $userrole == "admin" ) {
			$currentpendingtransfers = "SELECT `pendinglocationtransfers`.*, `locations`.locationname, `users`.* FROM `pendinglocationtransfers` INNER JOIN `locations` on `pendinglocationtransfers`.location=`locations`.id LEFT OUTER JOIN `users` on `pendinglocationtransfers`.submittedby=`users`.id WHERE  `pendinglocationtransfers`.processed = '0'";		
			$selectpendingtransfers = $db->prepare($currentpendingtransfers);
			$selectpendingtransfers->execute();
			$pendingtransferlist = $selectpendingtransfers->fetchAll();

			foreach($pendingtransferlist as $pendingtransfer){
				$transfertable = $transfertable . "<tr><td>"
				. $pendingtransfer[5] . "</td><td>"
				. $pendingtransfer[3] . "</td><td>"
				. $pendingtransfer['firstname'] . " " . $pendingtransfer['lastname'] . "</td><td>"
				. $pendingtransfer[0] . "</td><td><a href='/dashboard/inventory/pending/" 
				. $pendingtransfer[0] . "' >Process Transfer</a></td></tr>";
			}				
		}
		
		return $transfertable;		
	}
	
	function getPendingLocationTransferDetails($transferid) {
		global $db;
		global $currentpendingtransfer;
		
		$selecttransferdetails = "SELECT `pendinglocationtransfers`.*, `locations`.locationname, `users`.* FROM `pendinglocationtransfers` INNER JOIN `locations` on `pendinglocationtransfers`.location=`locations`.id LEFT OUTER JOIN `users` on `pendinglocationtransfers`.submittedby=`users`.id WHERE `pendinglocationtransfers`.id = '" . $transferid . "'";
		$transferdetails = $db->prepare($selecttransferdetails);
		$transferdetails->execute();
		$transferdetailstable = $transferdetails->fetchAll();
		
		$currentpendingtransfer->setTransferId($transferdetailstable[0]['0']);
		$currentpendingtransfer->setLocationId($transferdetailstable[0]['1']);
		$currentpendingtransfer->setSubmittedBy($transferdetailstable[0]['submittedby']);
		$currentpendingtransfer->setDateSubmitted($transferdetailstable[0]['datesubmitted']);
		$currentpendingtransfer->setLocationName($transferdetailstable[0]['locationname']);
		$currentpendingtransfer->setSubmittedFirstName($transferdetailstable[0]['firstname']);
		$currentpendingtransfer->setSubmittedLastName($transferdetailstable[0]['lastname']);				
	}
	
	function getPendingLocationTransferLineItems($transferid) {
		global $db;
		
		$selectlineitems = "SELECT `pendinglocationtransferslineitems`.*, `inventory`.* FROM `pendinglocationtransferslineitems` INNER JOIN `inventory` on `pendinglocationtransferslineitems`.productid=`inventory`.productid  WHERE `transferid` = '" . $transferid . "'";
		$select = $db->prepare($selectlineitems);
		$select->execute();
		$lineitems = $select->fetchAll();
		
		foreach( $lineitems as $item ){
			$pendingitemstable = $pendingitemstable . "<tr><td>"
			. $item['productid'] . "</td><td>"
			. $item['description'] . "</td><td>"
			. $item[3] . "</td><td><input type='hidden' name='productid[]' value='" . $item['productid'] . "'><input type='hidden' name='quantitysent[]' value='" . $item[3] . "'><input class='form-control' name='quantityreceived[]' type='number' min='0' /></td></tr>";
		}
		
		return $pendingitemstable;
	}
	
	function getCurrentInventoryQuantity($productid) {
		global $db;
		
		$currentquantity = $db->query('SELECT `quantity` FROM `inventory` WHERE `productid` = "' . $productid . '"')->fetchColumn();
		return $currentquantity;
	}
	
	function createNewPurchaseOrder($ponumber, $description, $cost) {
		global $db;
		global $validationmessage;
		
		$poexists = checkPoExists($ponumber);
		$addsuccess = false;
		$postatus = 0;
		
		if( $poexists == 0 ){
			$addnewpo = "INSERT INTO purchaseorder(ponumber, description, cost, paid) VALUES('" . $ponumber . "', '" . $description . "', '" . $cost . "', '" . $postatus . "')";
			$insertpo = $db->prepare($addnewpo);
			$insertpo->execute();
			$validationmessage = "The Purchase Order was added successfully.";
			$addsuccess = true;
		} else {
			$validationmessage = "A Purchase Order with that number already exists.";
		}
		return $addsuccess;
	}
	
	function addPurchaseOrderLineItem( $ponumber, $partnumber, $partquantity, $partdescription, $partcost, $partweight, $partpointvalue ){
		global $db;
		global $validationmessage;
		
		$addlineitem = "INSERT INTO purchaseorderitems(ponumber, productid, quantity, description, cost, weight, pointvalue) VALUES('" . $ponumber . "', '" . $partnumber . "', '" . $partquantity . "', '" . $partdescription . "', '" . $partcost . "', '" . $partweight . "', '" . $partpointvalue . "')";
		$insertlineitem = $db->prepare($addlineitem);
		$insertlineitem->execute();
		$validationmessage = "Item added.";
	}
	
	function addInventoryItem( $partnumber, $partquantity, $partdescription, $partcost, $partweight, $partpointvalue ){
		global $db;
		global $validationmessage;
		
		$addinventoryitem = "INSERT INTO inventory(productid, quantity, description, averagecost, weight, pointvalue) VALUES('" . $partnumber . "', '" . $partquantity . "', '" . $partdescription . "', '" . $partcost . "', '" . $partweight . "', '" . $partpointvalue . "')";
		$insertinventoryitem = $db->prepare($addinventoryitem);
		$insertinventoryitem->execute();
		$validationmessage = "Inventory updated.";
	}
	
	function getProductCost( $partnumber ){
		global $db;
	
		$getcurrentprice = "SELECT `averagecost` FROM `inventory` WHERE `productid` = '" . $partnumber . "'";
		$currentprice = $db->prepare($getcurrentprice);
		$currentprice->execute();
		$currentpricevalue = $currentprice->fetchColumn();
		
		return $currentpricevalue;	
	}
	
	function getProductQuantity( $partnumber ){
		global $db;
	
		$getcurrentquantity = "SELECT `quantity` FROM `inventory` WHERE `productid` = '" . $partnumber . "'";
		$currentquantity = $db->prepare($getcurrentquantity);
		$currentquantity->execute();
		$currentquantityvalue = $currentquantity->fetchColumn();
		
		return $currentquantityvalue;		
	}
	
	function getProductQuantityAtLocation( $partnumber ){
		global $db;
	
		$getcurrentquantity = "SELECT `quantity` FROM `locationinventory` WHERE `productid` = '" . $partnumber . "'";
		$currentquantity = $db->prepare($getcurrentquantity);
		$currentquantity->execute();
		$currentquantityvalue = $currentquantity->fetchColumn();
		
		return $currentquantityvalue;		
	}	
	
	function updateInventoryItem( $partnumber, $partquantity, $partdescription, $partcost, $partweight, $partpointvalue ){
		global $db;
		global $validationmessage;
		
		$currentprice = getProductCost($partnumber);
		$updatedprice = ($currentprice + $partcost) / 2;
		
		$currentquantity = getProductQuantity($partnumber);
		$updatedquantity = $currentquantity + $partquantity;
		
		$updateinventoryitem = "UPDATE `inventory` SET `quantity` = :quantity, `averagecost` = :averagecost, `weight` = :weight, `pointvalue` = :pointvalue WHERE `productid` = :productid";
		$updateinventory = $db->prepare($updateinventoryitem);
		$updateinventory->bindValue(":quantity", $updatedquantity);
		$updateinventory->bindValue(":averagecost", $updatedprice);
		$updateinventory->bindValue(":weight", $partweight);
		$updateinventory->bindValue(":pointvalue", $partpointvalue);
		$updateinventory->bindValue(":productid", $partnumber);
		
		$status = $updateinventory->execute();		
	}
	
	function getInventoryItemQuantity( $partnumber ){
		global $db;
		global $validationmessage;
		
		$getquantityquery = "SELECT `quantity` FROM `inventory` WHERE `productid` = '" . $partnumber . "'";
		$getquantity = $db->prepare($getquantityquery);
		$getquantity->execute();
		$quantity = $getquantity->fetchColumn();
		
		return $quantity;
	}	
	
	function getPoItemQuantity( $partnumber, $ponumber ){
		global $db;
		global $validationmessage;
		
		$getquantityquery = "SELECT `quantity` FROM `purchaseorderitems` WHERE `productid` = '" . $partnumber . "' AND `ponumber` = '" . $ponumber . "'";
		$getquantity = $db->prepare($getquantityquery);
		$getquantity->execute();
		$quantity = $getquantity->fetchColumn();
		
		return $quantity;
	}
	
	function updateInventoryItemQuantity( $partnumber, $partquantitychange ){
		global $db;
		global $validationmessage;
		
		$quantity = getInventoryItemQuantity( $partnumber );
		$newquantity = $quantity + $partquantitychange;
		
		$updateinventoryitem = "UPDATE `inventory` SET `quantity` = :quantity WHERE `productid` = :productid";
		$updateitem = $db->prepare($updateinventoryitem);
		$updateitem->bindValue(":quantity", $newquantity);
		$updateitem->bindValue(":productid", $partnumber);
		$status = $updateitem->execute();		
	}
	
	function updatePurchaseOrderLineItem( $originalponumber, $newponumber, $quantity, $productid ){
		global $db;
		global $validationmessage;
		
		$updatepolineitem = "UPDATE `purchaseorderitems` SET `quantity` = :quantity, `ponumber` = :newponumber WHERE `ponumber` = :ponumber AND `productid` = :productid";
		$updateitem = $db->prepare($updatepolineitem);
		$updateitem->bindValue(":quantity", $quantity);
		$updateitem->bindValue(":newponumber", $newponumber);
		$updateitem->bindValue(":ponumber", $originalponumber);
		$updateitem->bindValue(":productid", $productid);
		
		$status = $updateitem->execute();
		return $status;
	}
	
	function updateInventoryQuantities( $productid, $quantity ){
		global $db;
		
		$updateinventoryitem = "UPDATE `inventory` SET `quantity` = :quantity WHERE `productid` = :productid";
		$updateitem = $db->prepare($updateinventoryitem);
		$updateitem->bindValue(":quantity", $quantity);
		$updateitem->bindValue(":productid", $productid);
		
		$status = $updateitem->execute();
		return $status;		
	}
		
	
	function addInventoryAtLocation($locationid, $productid, $quantity) {
		global $db;
		global $validationmessage;		
		
		$addlocationinventoryitem = "INSERT INTO locationinventory(locationid, productid, quantity) VALUES('" . $locationid . "', '" . $productid . "', '" . $quantity . "')";
		$insertinventoryitem = $db->prepare($addlocationinventoryitem);
		$insertinventoryitem->execute();
		$validationmessage = "Location Inventory updated.";
	}	
	
	function updateInventoryItemAtLocation( $locationid, $productid, $quantity ){
		global $db;
		global $validationmessage;
		
		$currentquantity = getProductQuantityAtLocation($productid);
		$updatedquantity = $currentquantity + $quantity;
		
		$updateinventoryitem = "UPDATE `locationinventory` SET `quantity` = :quantity WHERE `productid` = :productid AND `locationid` = :locationid";
		$updatelocationinventory = $db->prepare($updateinventoryitem);
		$updatelocationinventory->bindValue(":quantity", $updatedquantity);
		$updatelocationinventory->bindValue(":productid", $productid);
		$updatelocationinventory->bindValue(":locationid", $locationid);
		
		$status = $updatelocationinventory->execute();
	}
	
	function addLocationDiscrepancies ( $productid, $quantitysent, $quantityreceived, $transferid, $locationid ) {
		global $db;
		global $validationmessage;
		
		$addmismatch = "INSERT INTO discrepancies(productid, quantitysent, quantityreceived, transferid, locationid) VALUES('" . $productid . "', '" . $quantitysent . "', '" . $quantityreceived . "', '" . $transferid . "', '" . $locationid . "')";
		$addentry = $db->prepare($addmismatch);
		$addentry->execute();
		$validationmessage = "Discrepancy added.";
	}
	
	function getDiscrepancies() {	
		global $db;			
		
		$getdiscrepancies = "SELECT `discrepancies`.*, `locations`.locationname FROM `discrepancies` INNER JOIN `locations` on `discrepancies`.locationid=`locations`.id";
		$select = $db->prepare($getdiscrepancies);
		$select->execute();
		$items = $select->fetchAll();
		
		foreach( $items as $item ){
			$pendingitemstable = $pendingitemstable . "<tr><td>"
			. $item['locationname'] . "</td><td>"
			. $item['productid'] . "</td><td>"
			. $item['transferid'] . "</td><td>"
			. $item['quantitysent'] . "</td><td>"					
			. $item['quantityreceived'] . "</td></tr>";
		}		
		
		return $pendingitemstable;	
	}
	
	function transferProcessed( $transferid ) {
		global $db;
		global $validationmessage;
		
		$updatestatus = "UPDATE `pendinglocationtransfers` SET `processed` = 1";
		$update = $db->prepare($updatestatus);
		$status = $update->execute();
		
		return $status;
	}
	
	function getProcessedStatus( $transferid ) {
		global $db;
	
		$getprocessedstatus = "SELECT `processed` FROM `pendinglocationtransfers` WHERE `id` = '" . $transferid . "'";
		$getstatus = $db->prepare($getprocessedstatus);
		$getstatus->execute();
		$status = $getstatus->fetchColumn();
		
		return $status;			
	}
	
	function updateUser($email, $firstname, $lastname, $employeeid, $role, $location, $password = NULL) {
		global $db;
		global $validationmessage;
		$updatepassword = false;
		
		$emailinuse = checkEmployeeEmailInUse($email);
		$idinuse = checkEmployeeIdInUse($employeeid);
		
		global $edituser;
		$id = $edituser->getID();
		
		if( $password != NULL ){
			$updatepassword = true;
			$encryptedpassword = md5($password);
		}
		
		if( $role == NULL ){
			$edituser->getRole();
		}
		
		if( $emailinuse == 0 && $idinuse == 0 ) {
			$updateuserquery = "UPDATE `users` SET `email` = :email, `firstname` = :firstname, `lastname` = :lastname, `employeeid` = :employeeid, `role` = :role, `location` = :location WHERE `id` = :id";
			$updateuser = $db->prepare($updateuserquery);
			$updateuser->bindValue(":email", $email);
			$updateuser->bindValue(":firstname", $firstname);
			$updateuser->bindValue(":lastname", $lastname);
			$updateuser->bindValue(":employeeid", $employeeid);
			$updateuser->bindValue(":role", $role);
			$updateuser->bindValue(":id", $id);
			$updateuser->bindValue(":location", $location);
			
			$status = $updateuser->execute();
			
			if( $updatepassword == true && $status == true ){
				$updatepasswordquery = "UPDATE `users` SET `password` = :password WHERE `id` = :id";
				$updatepassword = $db->prepare($updatepasswordquery);
				$updatepassword->bindValue(":id", $id);
				$updatepassword->bindValue(":password", $encryptedpassword);
				$updatepassword->execute();			
			}
			
			if($status) {
				$validationmessage = "User successfully updated.";
			} else {
				$validationmessage = "The update was unsuccessful. Please make sure that email address and employee number are not already in use.";
			}
		} elseif( $emailinuse >= 1 ) {
			$validationmessage = "That email address is already being used by another user. Please choose a different email address.";
		} elseif( $idinuse >= 1 ){
			$validationmessage = "That employee ID number is already being used by another user. Please choose a different number.";
		}
		
		return $status;
	}

	function createNewLocation($locationname, $address, $city, $state, $zip, $phone) {
		global $db;
		global $validationmessage;
		
		$addnewlocation = "INSERT INTO locations(locationname, address, city, state, zip, phone) VALUES('" . $locationname . "', '" . $address . "', '" . $city . "', '" . $state . "', '" . $zip . "', '" . $phone . "')";
		$insertlocation  = $db->prepare($addnewlocation);
		$insertlocation->execute();			
		$validationmessage = "The location was added successfully.";		
	}
	
	
	function checkManagerExists($locationid, $employeeid) {
		global $db;
		global $validationmessage;
		
		$managerexists = $db->query('SELECT count(*) FROM `locationmanagers` WHERE `locationid` = "' . $locationid . '" AND `employeeid` = "' . $employeeid . '"')->fetchColumn();
		return $managerexists;
	}		
	
	function createNewManager($locationid, $employeeid) {
		global $db;
		global $validationmessage;
		
		$managerexists = checkManagerExists($locationid, $employeeid);
		
		if( $managerexists == 0 ){
			$addnewlocationmanager = "INSERT INTO locationmanagers(locationid, employeeid) VALUES('" . $locationid . "', '" . $employeeid . "')";
			$insertmanager = $db->prepare($addnewlocationmanager);
			$insertmanager->execute();
			$validationmessage = "The location manager was assigned successfully.";		
		} else {
			$validationmessage = "That manager is already assigned to that location.";
		}
	}

	function generateLocationList() {
		$locations = getLocations();
		foreach($locations as $location){
			$locationtable = $locationtable . "<tr><td>" 
			. $location[1] . "</td><td>" 
			. $location[2] . "</td><td>" 
			. $location[3] . "</td><td>" 
			. $location[4] . "</td><td>" 
			. $location[5] . "</td><td>" 
			. $location[6] . "</td></tr>";
		}
		return $locationtable;
	}	

	function generateLocationSelectList() {
		$locations = getLocations();
		
		foreach($locations as $location) {	
			$locationoptions = $locationoptions . "<option value='" . $location[0] . "'>" . ucwords($location[1]) . "</option>";	
		}
		return $locationoptions;		
	}
	
	function generateInventoryItemsDropdown(){
		$inventoryitems = getInventoryItems();
		
		foreach( $inventoryitems as $item ){
			$inventorydropdown = $inventorydropdown . "<option value='" . $item['id'] . "'>" . $item['partnumber'] . " (" .  $item['description'] . ")</option>";
		}
		
		return $inventorydropdown;
	}	
	
	function getInventoryItemDetails( $id ){
		global $db;				
		
		$selectinventoryitem = "SELECT * FROM `inventoryitems` WHERE id = " . $id;
		$select = $db->prepare($selectinventoryitem);
		$select->execute();
		$inventoryitem = $select->fetch();
		
		return $inventoryitem;
	}
	
	
	function getManagerLocations($employeeid) {
		global $db;			
		
		$selectlocations = "SELECT `locations`.*, `locationmanagers`.locationid FROM `locations` INNER JOIN `locationmanagers` on `locations`.id=`locationmanagers`.locationid WHERE `locationmanagers`.employeeid = " . $employeeid;
		$select = $db->prepare($selectlocations);
		$select->execute();
		$locationlist = $select->fetchAll();
		
		return $locationlist;		
	}

	function generateManagerLocationList( $employeeid ) {
		$locations = getManagerLocations($employeeid);
		
		foreach( $locations as $location ){
			$locationtable = $locationtable . "<tr><td>"
			. $location[1] . "</td><td>"
			. $location[6] . "</td><td><a href='/dashboard/inventory/transferuser/" 
			. $location[0] . "' class='btn-sm btn-info'>Assign Inventory to Techs</a></td></tr>";
		}
		
		return $locationtable;
	}
	
	function generateAdminLocationList() {
		$locations = getLocations();

		foreach( $locations as $location ){
			$locationtable = $locationtable . "<tr><td>"
			. $location[1] . "</td><td>"
			. $location[6] . "</td><td><a href='/dashboard/inventory/transferuser/" 
			. $location[0] . "' class='btn-sm btn-info'>Assign Inventory to Techs</a></td></tr>";
		}
		
		return $locationtable;
	}
	
	function getTransferTechLocationList( $employeeid ){
		global $db;
		global $user;
		global $validationmessage;
		
		$userrole = $user->getRole();		
		$userid = $user->getID();

		if( $userrole == "admin" ){
			$locationtable = generateAdminLocationList();
		} elseif ( $userrole == "manager" ){			
			$locationtable = generateManagerLocationList($userid);
		}
		
		return $locationtable;
	}
	
	function getUserInventory(){
		global $db;
		global $validationmessage;
		global $user;
		
		$userid = $user->getID();
		
		$selectinventory = "SELECT `userinventory`.*, `inventory`.* FROM `userinventory` INNER JOIN `inventory` on `userinventory`.productid=`inventory`.productid WHERE `userinventory`.userid = " . $userid;
		$select = $db->prepare($selectinventory);
		$select->execute();
		$userinventorylist = $select->fetchAll();
		
		return $userinventorylist;
	}
	
	function generateUserInventoryTable() {
		$inventorylist = getUserInventory();
		
		foreach( $inventorylist as $inventoryitem ){
			$inventorytable = $inventorytable . "<tr><td>"
			. $inventoryitem[2] . "</td><td>"
			. $inventoryitem[7] . "</td><td>"
			. $inventoryitem[3] . "</td></tr>";
		}
		
		return $inventorytable;
	}
	
	function generateUserInventoryInstallTable() {
		$inventoryitems = getUserInventory();
		
		foreach( $inventoryitems as $item ){
			$inventorytable = $inventorytable . "<tr><td>"
			. $item[2] . "</td><td>" 
			. $item[7] . "</td><td>" 
			. $item[3] . "</td><td>"
			. "<input type='number' class='form-control' name='itemquantity[]' max='" . $item[3] . "' min='0'></input><input type='hidden' name='itemid[]' value='" . $item[2] . "'></input></td></tr>";
		}
		
		return $inventorytable;		
	}			
	
	function getManagers() {
		global $db;
		
		$selectmanagers = "SELECT * FROM `users` WHERE `role` = 2";
		$select = $db->prepare($selectmanagers);
		$select->execute();		
		$managerlist = $select->fetchAll();
		
		return $managerlist;
	}
	
	function getAssignedManagers() {
		global $db;
		
		$selectmanagers = "SELECT `locationmanagers`.*, `users`.*, `locations`.* FROM `locationmanagers` INNER JOIN `users` on `locationmanagers`.employeeid=`users`.id LEFT OUTER JOIN `locations` on `locationmanagers`.locationid=`locations`.id";
		$select = $db->prepare($selectmanagers);
		$select->execute();		
		$managerlist = $select->fetchAll();
		
		return $managerlist;	
	}
	
	function generateAssignedManagerList() {
		$managers = getAssignedManagers();
		
		foreach($managers as $manager){
			$managertable = $managertable . "<tr><td>" 
			. $manager[6] . "</td><td>" 
			. $manager[7] . "</td><td>" 
			. $manager[8] . "</td><td>" 
			. $manager[12] . "</td><td>" 
			. $manager[4] . "</td></tr>";
		}
		return $managertable;		
	}
	
	function generateManagerSelectList() {
		$managers = getManagers();
		
		foreach($managers as $manager) {
			$manageroptions = $manageroptions . "<option value='" . $manager[0] . "'>" . $manager[3] . " " . $manager[4] . "</option>";
		}
		
		return $manageroptions;
	}

	function getInstallationDetails( $installid ) {
		global $db;
		global $validationmessage;
		
		$selectinstallation = "SELECT `installations`.*, `users`.* FROM `installations` INNER JOIN `users` on `installations`.techid=`users`.id WHERE `installations`.id = '" . $installid . "'";				
		$select = $db->prepare($selectinstallation);
		$select->execute();
		$installdetails = $select->fetchAll();
		
		return $installdetails;		
	}
	
	function getPoDetails( $id ){
		global $db;
		global $validationmessage;
		
		$selectpo = "SELECT * FROM `purchaseorder` WHERE id = " . $id;
		$select = $db->prepare($selectpo);
		$select->execute();
		$podetails = $select->fetch();
		
		return $podetails;
	}
	
	function getPoLineItems( $ponumber ){
		global $db;
		global $validationmessage;
		
		$selectlineitems = "SELECT * FROM `purchaseorderitems` WHERE ponumber = '" . $ponumber . "'";
		
		$select = $db->prepare($selectlineitems);
		$select->execute();
		$lineitems = $select->fetchAll();
		
		return $lineitems;
	}
	
	function generatePoLineItemsList( $id ) {
		$lineitems = getPoLineItems( $id );
		
		foreach( $lineitems as $lineitem ){
			$lineitemtable = $lineitemtable . "<tr><td>"			
			. $lineitem[2] . "</td><td>" 
			. $lineitem[3] . "</td><td>" 
			. $lineitem[4] . "</td><td>$" 
			. $lineitem[5] . "</td><td>" 
			. $lineitem[6] . "</td><td>" 
			. $lineitem[7] . "</td></tr>";
		}
		
		return $lineitemtable;	
	}
	
	function updatePoDetails( $ponumber, $cost, $paid, $description ){
		global $db;
		global $validationmessage;
		
		$updatepodetails = "UPDATE `purchaseorder` SET `ponumber` = :ponumber, `cost` = :cost, `paid` = :paid, `description` = :description";
		$updatepo = $db->prepare($updatepodetails);
		$updatepo->bindValue(":ponumber", $ponumber);
		$updatepo->bindValue(":cost", $cost);
		$updatepo->bindValue(":paid", $paid);
		$updatepo->bindValue(":description", $description);
		
		$status = $updatepo->execute();
		return $status;
	}	
	
	function generateEditPoLineItems( $id ){
		$lineitems = getPoLineItems( $id );
		
		foreach( $lineitems as $lineitem ){
			$lineitemtable = $lineitemtable . "<tr><td class='form-group'><input type='text' class='form-control' name='productid[]' value='" . $lineitem['productid'] . "' readonly>"
			. "</td><td class='form-group'><span class='form-control' readonly>" . $lineitem['description'] . "</td><td class='form-group'><input type='number' class='form-control' name='productquantity[]' value='" . $lineitem['quantity'] . "'></input></td></tr>"; 
		}
		
		return $lineitemtable;
	}
	
	function getInstallationLineItems( $installid ) {
		global $db;
		global $validationmessage;
		
		$selectlineitems = "SELECT `installationlineitems`.*, `inventory`.* FROM `installationlineitems` INNER JOIN `inventory` on `installationlineitems`.productid=`inventory`.productid WHERE `installationlineitems`.installationid = '" . $installid . "'";
		$select = $db->prepare($selectlineitems);
		$select->execute();
		$lineitems = $select->fetchAll();
		
		return $lineitems;
	}
	
	function generateInstallLineItemsList( $installid ){
		$lineitems = getInstallationLineItems( $installid );
		
		foreach( $lineitems as $lineitem ){
			$lineitemtable = $lineitemtable . "<tr><td>"
			. $lineitem[2] . "</td><td>" 
			. $lineitem[7] . "</td><td>" 
			. $lineitem[3] . "</td></tr>";
		}
		
		return $lineitemtable;
	}
?>