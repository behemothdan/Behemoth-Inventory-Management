<?php
	class User {
		public $firstname;
		public $lastname;
		public $employeeid;
		public $email;
		public $id;
		public $role;
		public $location;
				
		public function setFirstName($firstnameval) {
			$this->firstname = $firstnameval;
		}
		public function getFirstName() {
			return $this->firstname;
		}
						
		public function setLastName($lastnameval) {
			$this->lastname = $lastnameval;
		}
		public function getLastName() {
			return $this->lastname;
		}		
						
		public function setEmployeeID($employeeidval) {
			$this->employeeid = $employeeidval;
		}
		public function getEmployeeID() {
			return $this->employeeid;
		}
		
		public function setEmail($emailval) {
			$this->email = $emailval;
		}
		public function getEmail() {
			return $this->email;
		}		
		
		public function setID($idval) {
			$this->id = $idval;
		}
		public function getID() {
			return $this->id;
		}

		public function setRole($roleval) {
			$this->role = $roleval;
		}
		public function getRole() {
			return $this->role;
		}	
		
		public function setLocation($locationval) {
			$this->location = $locationval;
		}
		public function getLocation() {
			return $this->location;
		}			
	}
	
	class LocationTransfer {
		public $transferid;
		public $locationid;
		public $submittedby;
		public $datesubmitted;
		public $locationname;		
		public $submittedfirstname;
		public $submittedlastname;	

		public function setTransferId($transferidval) {
			$this->transferid = $transferidval;
		}		
		public function getTransferId() {
			return $this->transferid;
		}		
		
		public function setLocationId($locationidval) {
			$this->locationid = $locationidval;
		}		
		public function getLocationId() {
			return $this->locationid;
		}
		
		public function setSubmittedBy($submittedbyval) {
			$this->submittedby = $submittedbyval;
		}
		public function getSubmittedBy() {
			return $this->submittedby;
		}
		
		public function setDateSubmitted($datesubmittedval) {
			$this->datesubmitted = $datesubmittedval;
		}
		public function getDateSubmitted() {
			return $this->datesubmitted;
		}	

		public function setLocationName($locationnameval) {
			$this->locationname = $locationnameval;
		}
		public function getLocationName() {
			return $this->locationname;
		}	

		public function setSubmittedFirstName($firstnameval) {
			$this->firstname = $firstnameval;
		}
		public function getSubmittedFirstName() {
			return $this->firstname;
		}

		public function setSubmittedlastName($lastnameval) {
			$this->lastname = $lastnameval;
		}
		public function getSubmittedLastName() {
			return $this->lastname;
		}			
	}
?>