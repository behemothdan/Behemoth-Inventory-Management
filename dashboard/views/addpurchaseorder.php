<div class="row">	
	<div class="col-md-12">
		<h1>Add Purchase Order</h1>
		<form action="inventory/add" method="post" enctype="multipart/form-data">
			<div class="form-group col-md-6">
				<label for="ponumberinput">PO Number</label>
				<input type="text" class="form-control" id="ponumberinput" name="ponumber" required />
			</div>
			<div class="form-group col-md-6">
				<label for="ordertotalinput">Order Total</label>
				<div class="input-group">
					<div class="input-group-addon">$</div>
					<input type="text" class="form-control" id="ordertotalinput" name="ordertotal" required />
				</div>
			</div>
			<div class="form-group col-md-12">
				<label for="descriptioninput">Description</label>
				<textarea class="form-control" id="descriptioninput" name="description" rows="4" required></textarea>
			</div>
			
			<div class="col-md-12 product-group">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group col-md-8">
							<label>Part</label>
							<select class="form-control" name="productid[]">
								<?php echo generateInventoryItemsDropdown(); ?>
							</select>							
						</div>	
						<div class="form-group col-md-4">
							<label>Quantity</label>
							<input type="number" class="form-control" name="productquantity[]" required></textarea>
						</div>							
						<div class="form-group col-md-4">
							<label>Part Price</label>
							<div class="input-group">
								<div class="input-group-addon">$</div>
								<input type="text" class="form-control" name="productcost[]" required></textarea>
							</div>
						</div>				
						<div class="form-group col-md-4">
							<label>Weight</label>
							<input type="text" class="form-control" name="productweight[]"></textarea>
						</div>				
						<div class="form-group col-md-4">
							<label>Point Value</label>
							<input type="text" class="form-control" name="productpointvalue[]"></textarea>
						</div>	
					</div>
				</div>
			</div>
			
			<div class="col-md-12">
				<div class="col-md-4">
					<div class="btn-group" role="group" aria-label="...">							
						<button type="button" class="btn btn-info" id="addpart">
							<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add Part
						</button>
						<button type="button" class="btn btn-warning disabled" id="removepart">
							<span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> Remove Part
						</button>
					</div>
				</div>
				
				<div class="col-md-4 col-md-offset-2">
					<div class="checkbox">
						<label>
							<input id="confirmpo" type="checkbox"> I have finished entering all PO entries.
						</label>
					</div>				
				</div>
				
				<div class="col-md-2">
					<button id="submitpo" type="submit" class="btn btn-primary" disabled="disabled">Add Purchase Order</button>
				</div>
			</div>
		</form>
	</div>
</div>