<h1>Order List</h1>
<?php 
	if (validation_errors()) {
		echo custom_message('info', validation_errors());	
	}
	
?>

<div class=" pull-right">
	
<?php echo form_open('admin/order/view',array('class'=>'form-inline','method'=>'GET')); ?>
  <div class="form-group">
   <label for="filter">Filter By </label>
    <select name="filter" class="form-control">
     
	  <option value="orders.id">Order ID</option>
	  <option value="orders.restaurant_id">Restaurant Id</option>
	  
	 
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
	 	<th>Phone</th>
	 	<th>Restaurant ID</th>
	 	<th>Restaurant</th>
	 	<th>Total Price</th>
	 	<th>Status</th>
	 	<th>Action</th>
 	</tr>
 </thead>
 <tbody>
 	<?php 
 		foreach ($orders as  $order) {
 			?>
 			<tr>
 				<td><?php echo $order->id ?></td>
 				<td><?php echo $order->fullname ?></td>
 				<td><?php echo $order->phone ?></td>
 				<td><?php echo $order->restaurant_id ?></td>
 				<td><?php echo $order->rs_name ?></td>
 				<td>$<?php printf("%.2f",$order->total_price) ?></td>
 				<td><?php echo $order->status ?></td>
 				<td>
 					<?php echo anchor('admin/order/show/'.$order->id, '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>'); ?>
 					&nbsp;
 					<?php echo anchor('admin/order/edit/'.$order->id, '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'); ?>
 					
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