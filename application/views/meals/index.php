<h1>User List</h1>
<?php 
	if (validation_errors()) {
		echo custom_message('info', validation_errors());	
	}
	
?>

<div class=" pull-right">
	
<?php echo form_open('admin/users/view',array('class'=>'form-inline','method'=>'GET')); ?>
  <div class="form-group">
   <label for="filter">Filter By </label>
    <select name="filter" class="form-control">
     
	  <option value="id">ID</option>
	  <option value="slug">Slug</option>
	  <option value="category_id">Category Id</option>
	  
	 
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
	 	<th>Slug</th>
	 	<th>Category ID</th>
	 	<th>Category Name</th>
	 	<th>Price($)</th>
	 	<th>Description</th>
	 	<th>Action</th>
 	</tr>
 </thead>
 <tbody>
 	<?php 
 		foreach ($meals as  $meal) {
 			?>
 			<tr>
 				<td><?php echo $meal->id ?></td>
 				<td><?php echo $meal->name ?></td>
 				<td><?php echo $meal->slug ?></td>
 				<td><?php echo $meal->category_id ?></td>
 				<td><?php echo $meal->cat_name ?></td>
 				<td><?php echo $meal->price ?></td>
 				<td><?php echo $meal->description; ?></td>
 				

 				<td>
 					<?php echo anchor('admin/meal/edit/'.$meal->id, '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'); ?>
 					&nbsp;
 					<?php echo anchor('admin/meal/delete/'.$meal->id, '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'); ?>
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