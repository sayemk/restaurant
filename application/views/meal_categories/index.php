<h1>Meal Category List</h1>

<?php 
		if($this->session->flashdata('userFlashData'))
				  		echo $this->session->flashdata('userFlashData')
 ?>

<table class="table table-bordered">
 <thead>
 	<tr>
 		<th>ID</th>
 		<th>Name</th>
 		<th>Description</th>
	 	<th>Action</th>
 	</tr>
 </thead>
 <tbody>
 	<?php 
 		foreach ($categories as  $category) {
 			?>
 			<tr>
 				<td><?php echo $category->id ?></td>
 				<td><?php echo $category->name ?></td>
 				<td><?php echo $category->description ?></td>
 				<td>
 					<?php echo anchor('admin/meal_category/edit/'.$category->id, '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'); ?>
 					&nbsp;
 					<?php echo anchor('admin/meal_category/delete/'.$category->id, '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'); ?>
 				</td>
 				
 			</tr>

 			<?php
 		}
 	 ?>
 </tbody>
</table>

 </div> <!--End of col-md-10-->
 
</div> <!-- End of container -->

</body>
</html>