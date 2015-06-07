<h1>Restaurants Meal List</h1>
<?php 
  if (validation_errors()) {
    echo custom_message('info', validation_errors()); 
  }
  
?>
<div class=" pull-right">
	
<?php echo form_open('admin/restaurant_meal/view',array('class'=>'form-inline','method'=>'GET')); ?>
  <div class="form-group">
   <label for="filter">Filter By </label>
    <select name="filter" class="form-control">
     
	  <option value="restaurant_meals.restaurant_id">Restaurant ID</option>
	  <option value="restaurant_meals.meal_id">Meal ID</option>
	 	 
	</select>
    
  </div>
  <div class="form-group">
   <label for="data">Equal to </label>
    <input name="data" value="<?php echo set_value('data'); ?>" type="text" class="form-control" id="data" placeholder="Value to match">
    
  </div>
  <button type="submit" class="btn btn-primary">Filter</button>
</form>
<br >
</div>

<table class="table table-bordered">
 <thead>
 	<tr>
 		<th>ID</th>
 		<th>Restaurant ID</th>
 		<th>Restaurant Name</th>
 		<th>Meal ID</th>
 		<th>Meal Name</th>
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
 				<td>$<?php printf("%.2f",$meal->price); ?></td>
 				<td><img height="50px" width="50px" class="img-rounded table-image" src="<?php echo base_url().'/uploads/images/'.$meal->image_name ?>" alt ="<?php echo $meal->image_name ?>"></td>
 				<td>
 					
 					<?php echo anchor('admin/restaurant_meal/edit/'.$meal->id, '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'); ?>
 					&nbsp;
 					<?php echo anchor('admin/restaurant_meal/delete/'.$meal->id, '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'); ?>
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