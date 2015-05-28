<h3>Restaurant Details</h3>
<div class=" col-md-8 pull-right"> </div>
<div class="col-md-4">
	<table class="table table-bordered">

	 <tbody>
	 	<?php 

	 		
	 			?>
	 			<tr>
	 				<th>ID</th>
	 				<td><?php echo $restaurant->id ?></td>
	 			</tr>
	 			<tr>
	 				<th>Name</th>
	 				<td><?php echo $restaurant->name ?></td>
	 			</tr>
	 			<tr>
	 				<th>Phone</th>
	 				<td><?php echo $restaurant->phone ?></td>
	 			</tr>
	 			<tr>
	 				<th>Email</th>
	 				<td><?php echo $restaurant->email ?></td>
	 			</tr>
	 			<tr>
	 				<th>Website</th>
	 				<td><?php echo $restaurant->website ?></td>
	 			</tr>
	 			<tr>
	 				<th>Description</th>
	 				<td><?php echo $restaurant->description ?></td>
	 			</tr>
	 			<tr>
	 				<th>Start Hour</th>
	 				<td><?php echo $restaurant->service_start ?></td>
	 			</tr>
	 			<tr>
	 				<th>Close Hour</th>
	 				<td><?php echo $restaurant->service_end ?></td>
	 			</tr>
	 			<tr>
	 				<th>Latitude</th>
	 				<td><?php echo $restaurant->latitude ?></td>
	 			</tr>
	 			<tr>
	 				<th>Longitude</th>
	 				<td><?php echo $restaurant->longitude ?></td>
	 			</tr>
	 			<tr>
	 				<th>Status</th>
	 				<td>
	 					<?php 
	 						if($restaurant->status==1) echo "Active";
	 						else echo "Inactive";
	 				 	?>
	 				 </td>
	 			</tr>
	 		
	 </tbody>
	</table>
</div>

<div class="col-md-8">

	<?php 
		if (!empty($addresses)) {

	?>
		<table class="table table-bordered">
  			<thead>
  				<tr>
  					<th>Address name</th>
  					<th>Address</th>
  				</tr>
  				<?php 
  					foreach ($addresses as $address) {
					?>
						<tr>
							<td><?php echo $address->name; ?></td>
							<td>
								<table class="table table-bordered">
									<tbody>
										
										<tr>
											<td>Address</td>
											<td><?php echo $address->address_line_1 ?></td>
										</tr>
										<tr>
											<td>City</td>
											<td><?php echo $address->city ?></td>
										</tr>
										<tr>
											<td>State</td>
											<td><?php echo $address->state ?></td>
										</tr>
										<tr>
											<td>Country</td>
											<td><?php echo $address->country ?></td>
										</tr>
										
									</tbody>
								</table>
							</td>
						</tr>
						

					<?php
											
  					}
  				 ?>
  			</thead>
  		</table>

	<?php
		}else {
			echo "<h3>User $user->fullname, has no address ";
		}
	 ?>
</div>

 </div> <!--End of col-md-12-->
 
</div> <!-- End of container -->

</body>
</html>