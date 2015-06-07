<h3>Restaurant Details</h3>
<div class=" col-md-8 pull-right"> </div>
<div class="col-md-6">
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
	 			<tr>
	 				<th>Address</th>
	 				<td>
	 					<?php 
							if (!empty($addresses)) {

						?>
							<table class="table">
					  			<thead>
					  				<tr>
										<td style="padding:0">
											<address>
												<strong><?php echo $addresses->address_line_1 ?></strong><br>
												<?php echo !empty($addresses->city) ? $addresses->city : '' ?>
												<?php echo !empty($addresses->state) ? ', '.$addresses->state : ''?><br>
												<?php echo $addresses->country ?><br>
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