<nav class="navbar navbar-default">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#adminmenu" aria-expanded="false">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
		<a class="navbar-brand" href="/dashboard/">Behemoth Inventory</a>
	</div>
	<div class="collapse navbar-collapse" id="adminmenu">
		<ul class="nav navbar-nav">
		
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User Management <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li>
						<a href="users/">Employee List</a>												
					</li>
					<?php 
						if( $user->getRole() == "admin" ){
					?>
						<li>
							<a href="users/add">Add Employee</a>
						</li>
						<li>
							<a href="users/edit">Edit Employee</a>
						</li>
						<li>
							<a href="users/remove">Remove Employee</a>
						</li>
					<?php } ?>
				</ul>
			</li>			

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Locations <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li>
						<a href="locations/">Locations</a>												
					</li>					
					<?php 
						if( $user->getRole() == "admin" ){
					?>									
					<li>
						<a href="locations/add">Add Location</a>
					</li>		
					<li>
						<a href="locations/managers">Location Managers</a>
					</li>					
					<li>
						<a href="locations/managers/add">Add Location Managers</a>
					</li>	
					<?php } ?>
				</ul>
			</li>			
				
			<?php
				if( $user->getRole() == "admin" || $user->getRole() == "manager" ){						
			?>
			<li>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Inventory <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<?php 
						if( $user->getRole() == "admin" ){
					?>
						<li>
							<a href="inventory/view">View Inventory</a>
						</li>												
						<li>
							<a href="inventory/edit">Edit Inventory</a>
						</li>								
						<li>
							<a href="inventory/discrepancies">Discrepancies</a>
						</li>
					<?php } ?>
					
					<?php
						if( $user->getRole() == "admin" || $user->getRole() == "manager" ){						
					?>
						<li>
							<a href="inventory/pending">Pending Equipment Transfers</a>
						</li>
						<li>
							<a href="inventory/transferuser">Equipment Transfer To Technician</a>
						</li>
					<?php } ?>
					<?php 
						if( $user->getRole() == "admin" ){
					?>					
						<li>
							<a href="inventory/transferlocation">Equipment Transfer To Location</a>
						</li>
					<?php } ?>
				</ul>				
			</li>
			<?php } ?>
			
			<?php
				if( $user->getRole() == "admin"){						
			?>
			<li>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Purchase Orders <span class="caret"></span></a>
				<ul class="dropdown-menu">			
						<li>
							<a href="inventory/add">Add Purchase Order</a>
						</li>
						<li>
							<a href="inventory/purchaseorder/view">View/Edit Purchase Orders</a>						
						</li>
				</ul>				
			</li>
			<?php } ?>			
			
			<li>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Installations <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<?php 
						if( $user->getRole() == "technician" || $user->getRole() == "manager" ){
					?>				
						<li>
							<a href="installations/add">Add Installation</a>
						</li>		
					<?php } ?>
					
					<?php
						if( $user->getRole() == "admin" || $user->getRole() == "manager" ){						
					?>					
						<li>
							<a href="installations/view">View Installations</a>
						</li>				
					<?php } ?>
				</ul>
			</li>			
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello <?php echo $user->getFirstName(); ?>!</a>
				<ul class="dropdown-menu">
					<li>
						<a href="users/edit/<?php echo $user->getID(); ?>">Edit Profile</a>
					</li>
					<?php if( $user->getRole() == "technician" ){ ?>
					<li>
						<a href="inventory/view/user">View My Inventory</a>
					</li>
					<?php } ?>
					<li>
						<a href="#">Logout</a>
					</li>					
				</ul>
			</li>
		</ul>		
	</div>
  </div>        
</nav>