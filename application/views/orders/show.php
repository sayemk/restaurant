<h3>Restaurant Details</h3>
<div class=" col-md-8 pull-right"> </div>
<div class="col-md-6">
	<table class="table table-bordered">

	 <tbody>
	 	<?php 

	 		
	 			?>
	 			<tr>
	 				<th>ID</th>
	 				<td><?php echo $order[0]->id ?></td>
	 			</tr>
	 			<tr>
	 				<th>Customer</th>
	 				<td><?php echo $order[0]->fullname ?></td>
	 			</tr>
	 			<tr>
	 				<th>Phone</th>
	 				<td><?php echo $order[0]->phone ?></td>
	 			</tr>
	 			<tr>
	 				<th>Email</th>
	 				<td><?php echo $order[0]->email ?></td>
	 			</tr>
	 			<tr>
	 				<th>Restaurant</th>
	 				<td><?php echo $order[0]->rs_name ?></td>
	 			</tr>
	 			<tr>
	 				<th>Status</th>
	 				<td><?php echo $order[0]->status ?></td>
	 			</tr>
	 			
	 			<tr>
	 				<th><h3>Items</h3></th>
	 				<td>
	 					<table class="table table-bordered">
	 						<thead>
	 							<tr>
	 								<th>#</th>
	 								<th>Meal Name</th>
	 								<th>Unit Price</th>
	 								<th>Quantity</th>
	 								<th>Sub-total</th>
	 							</tr>
	 						</thead>
	 						<tbody>
								<?php 
									$count = 1;
									foreach ($meals as $meal) { ?>
		 							<tr>
		 								
		 									<td><?php echo $count?></td>
			 								<td><?php echo $meal->meal_name ?></td>
			 								<td>$<?php printf("%.2f",$meal->price); ?></td>
			 								<td>$<?php echo $meal->quantity ?></td>
			 								<td>$<?php printf("%.2f",$meal->sub_total); ?></td>

		 							</tr>
		 						<?php $count++; } ?>
	 							<tr>
	 								<th colspan="3"></th>
	 								<th>Total</th>
	 								<th>$<?php printf("%.2f", $order[0]->total_price); ?></th>
	 							</tr>
	 						</tbody>
	 					</table>
	 				</td>
	 				
	 			</tr>
	 			<tr>
	 				<td colspan="2">
	 					
	 				</td>
	 			</tr>
	 			<tr>
	 				<th>Address</th>
	 				<td>
	 					<?php 
							if (!empty($order)) {

						?>
							<table class="table">
					  			<thead>
					  				<tr>
										<td style="padding:0">
											<address>
												<strong><?php echo $order[0]->address_line_1 ?></strong><br>
												<?php echo !empty($order[0]->city) ? $order[0]->city : '' ?>
												<?php echo !empty($order[0]->state) ? ', '.$order[0]->state : ''?><br>
												<?php echo $order[0]->country ?><br>
											</address>
										</td>
									</tr>
											
					  			</thead>
					  		</table>

						<?php
							}else {
								echo "<h3> This Restaurant has no address ";
							}
						 ?>
	 				 </td>
	 			</tr>
	 		
	 </tbody>
	</table>
</div>

<!--div class="col-md-4 col-md-offset-2">
	<div class="thumbnail">
		<img src="http://www.comohotels.com/metropolitanbangkok/sites/default/files/styles/background_image/public/images/background/metbkk_bkg_nahm_restaurant.jpg?itok=GSmnYYaU" alt="Reataurent Image">
		 <div class="caption">
			<h3>Caption here</h3>
			<p>...</p>
			<p><a href="#" class="btn btn-default" role="button">Button</a></p>
		</div> 
	</div>
</div> -->

 </div> <!--End of col-md-12-->
 
</div> <!-- End of container -->

</body>
</html>