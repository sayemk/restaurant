<h3>User Details</h3>
<div class=" col-md-8 pull-right"> </div>
<div class="col-md-4">
	<table class="table table-bordered">

	 <tbody>
	 	<?php 

	 		
	 			?>
	 			<tr>
	 				<th>ID</th>
	 				<td><?php echo $user->id ?></td>
	 			</tr>
	 			<tr>
	 				<th>Name</th>
	 				<td><?php echo $user->fullname ?></td>
	 			</tr>
	 			<tr>
	 				<th>Username</th>
	 				<td><?php echo $user->username ?></td>
	 			</tr>
	 			<tr>
	 				<th>Email</th>
	 				<td><?php echo $user->email ?></td>
	 			</tr>
	 			<tr>
	 				<th>Phone</th>
	 				<td><?php echo $user->phone ?></td>
	 			</tr>
	 			<tr>
	 				<th>Group</th>
	 				<td><?php echo $user->type ?></td>
	 			</tr>
	 			<tr>
	 				<th>Registration Time</th>
	 				<td><?php echo $user->registration_time ?></td>
	 			</tr>
	 			<tr>
	 				<th>Status</th>
	 				<td>
	 					<?php 
	 						if($user->status==1) echo "Active";
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
								<address>
									<strong><?php echo $address->address_line_1 ?></strong><br>
									<?php echo !empty($address->city) ? $address->city : '' ?>
									<?php echo !empty($address->state) ? ', '.$address->state : ''?><br>
									<?php echo $address->country ?><br>
									<?php 
										echo "<strong>Member Address: </strong>";
										if ($address->is_member_add) {
											echo 'Yes';
										}else {
											echo 'No';
										}
									?>
								</address>
								<!-- <table class="table table-bordered">
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
										<tr>
											<td>Member Address</td>
											<td>
											<?php 
												if ($address->is_member_add) {
													echo 'Yes';
												}else {
													echo 'No';
												}
											?>
											</td>
										</tr>
									</tbody>
								</table> -->
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