<h1>User List</h1>
<?php 
	if (validation_errors()) {
		echo custom_message('info', validation_errors());	
	}
	
?>

<div class=" pull-right">
	
<?php echo form_open('admin/restaurant/view',array('class'=>'form-inline','method'=>'GET')); ?>
  <div class="form-group">
   <label for="filter">Filter By </label>
    <select name="filter" class="form-control">
     
	  <option value="id">ID</option>
	  <option value="email">Email</option>
	  <option value="phone">Phone</option>
	   <option value="status">website</option>
	 
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
 		<th>Name</th>
 		<th>Phone</th>
	 	<th>Email</th>
	 	<th>Opening Time</th>
	 	<th>Closing Time</th>
	 	<th>Latitude</th>
	 	<th>Longitude</th>
	 	<th title=" 1 = Active, 0 = Inactive">Status</th>
	 	<th>Action</th>
 	</tr>
 </thead>
 <tbody>
 	<?php 
 		foreach ($restaurants as  $restaurant) {
 			?>
 			<tr>
 				<td><?php echo $restaurant->id ?></td>
 				<td><?php echo $restaurant->name ?></td>
 				<td><?php echo $restaurant->phone ?></td>
 				<td><?php echo $restaurant->email ?></td>
 				<td><?php echo $restaurant->service_start ?></td>
 				<td><?php echo $restaurant->service_end ?></td>
 				<td><?php echo $restaurant->latitude ?></td>
 				<td><?php echo $restaurant->longitude; ?></td>
 				<td><?php echo $restaurant->status; ?></td>

 				<td>
 					<?php echo anchor('admin/users/show/'.$restaurant->id, '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>'); ?>
 					&nbsp;
 					<?php echo anchor('admin/users/edit/'.$restaurant->id, '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'); ?>
 					&nbsp;
 					<?php echo anchor('admin/users/delete/'.$restaurant->id, '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'); ?>
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