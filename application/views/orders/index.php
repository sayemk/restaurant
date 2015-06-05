<h1>Order List</h1>
<?php 
	if (validation_errors()) {
		echo custom_message('info', validation_errors());	
	}
	
?>

<div class=" pull-right">
	
<?php echo form_open('admin/meal/view',array('class'=>'form-inline','method'=>'GET')); ?>
  <div class="form-group">
   <label for="filter">Filter By </label>
    <select name="filter" class="form-control">
     
	  <option value="meals.id">ID</option>
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
 		<th>Order ID</th>
 		<th>Customer</th>
	 	<th></th>
	 	<th>Category ID</th>
	 	<th>Category Name</th>
	 	<th>Price($)</th>
	 	<th>Description</th>
	 	<th>Action</th>
 	</tr>
 </thead>
 <tbody>
 	<?php 
 		foreach ($orders as  $order) {
 			?>
 			<tr>
 				<td><?php echo $order->id ?></td>
 				<td><?php echo $order->name ?></td>
 				<td><?php echo $order->slug ?></td>
 				<td><?php echo $order->category_id ?></td>
 				<td><?php echo $order->cat_name ?></td>
 				<td><?php echo $order->price ?></td>
 				<td><?php echo $order->description; ?></td>
 				

 				<td>
 					<?php echo anchor('admin/order/edit/'.$order->id, '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'); ?>
 					&nbsp;
 					<?php echo anchor('admin/order/delete/'.$order->id, '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'); ?>
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