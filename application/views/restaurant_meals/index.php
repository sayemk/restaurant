<h1>Meal Category List</h1>



<table class="table table-bordered">
 <thead>
 	<tr>
 		<th>ID</th>
 		<th>Restaurant ID</th>
 		<th>Restaurant Name</th>
 		<th>Meal ID</th>
 		<th>Meal Neme</th>
 		<th>Price</th>
 		<th>Image</th>
	 	<th>Action</th>
 	</tr>
 </thead>
 <tbody>
 	<?php 
 		foreach ($meals as  $meal) {
 			?>
 			<tr>
 				<td><?php echo $meal->id ?></td>
 				<td><?php echo $meal->restaurant_id ?></td>
 				<td><?php echo $meal->res_name ?></td>
 				<td><?php echo $meal->meal_id ?></td>
 				<td><?php echo $meal->meal_name ?></td>
 				<td><?php echo $meal->price ?></td>
 				<td><img height="50px" width="50px" class="img-rounded table-image" src="<?php echo base_url().'/uploads/images/'.$meal->image_name ?>" alt ="<?php echo $meal->image_name ?>"></td>
 				<td>
 					<?php echo anchor('admin/restaurant_meals/edit/'.$meal->id, '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>'); ?>
 					&nbsp;
 					<?php echo anchor('admin/restaurant_meals/edit/'.$meal->id, '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'); ?>
 					&nbsp;
 					<?php echo anchor('admin/restaurant_meals/delete/'.$meal->id, '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'); ?>
 				</td>
 				
 			</tr>

 			<?php
 		}
 	 ?>
 </tbody>
</table>

<?php echo $this->pagination->create_links(); ?>

 </div> <!--End of col-md-10-->
 
</div> <!-- End of container -->

</body>
</html>