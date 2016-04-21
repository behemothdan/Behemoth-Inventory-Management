<div class="row">	
	<div class="col-md-12">
		<h1>Edit Purchase Order</h1>
		<form action="inventory/purchaseorder/edit/<?php echo $podetails[0]; ?>" method="post" enctype="multipart/form-data">
			<div class="form-group col-md-5">
				<label for="ponumberinput">PO Number</label>
				<input type="text" class="form-control" id="ponumberinput" name="ponumber" value="<?php echo $podetails[1]; ?>" />
			</div>
			<div class="form-group col-md-5">
				<label for="ordertotalinput">Order Total</label>
				<div class="input-group">
					<div class="input-group-addon">$</div>
					<input type="text" class="form-control" id="ordertotalinput" name="ordertotal" value="<?php echo $podetails[3]; ?>" />
				</div>
			</div>
			<div class="form-group col-md-2">
				<label for="paidstatus">Paid/Unpaid</label>			
				<select class="form-control" id="paidstatus" name="paidstatus">
					<option value="1" <?php echo ($podetails[4] == '1')?"selected":"" ?>>Paid</option>
					<option value="0" <?php echo ($podetails[4] == '0')?"selected":"" ?>>Unpaid</option>
				</select>									
			</div>			
			<div class="form-group col-md-12">
				<label for="descriptioninput">Description</label>
				<textarea class="form-control" id="descriptioninput" name="description" rows="4"><?php echo $podetails[2]; ?></textarea>
			</div>
			
			<div class="col-md-12 product-group">
				<div class="panel panel-default table-responsive">					
					<table class="table">
							<tr>					
								<th>Part Number</th>
								<th>Description</th>
								<th>Quantity</th>									
							</tr>
							<?php echo generateEditPoLineItems( $podetails[1] ); ?>	
						</table>															
				</div>
			</div>
			
			<div class="col-md-12">
				
				<div class="col-md-2 col-md-offset-10">
					<button type="submit" class="btn btn-primary">Update Purchase Order</button>
				</div>
			</div>
		</form>
	</div>
</div>