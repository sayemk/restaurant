
		<div class="col-md-1">&nbsp;</div>
	  	
	  	<div class="col-md-6">
	  	<h2>Create A New User</h2>
	  		
			<?php 
				  	if(validation_errors()) echo custom_message('info',validation_errors());
				  	if($this->session->flashdata('userFlashData'))
				  		echo $this->session->flashdata('userFlashData');

					echo form_open('admin/meal_category/update', array('class'=>'form-horizontal'));  
				?>

		  <div class="form-group">
		    <label for="name">Name</label>
		    
		      <input name="name" value="<?php echo $category[0]->name ?>" type="text" class="form-control" id="name" placeholder="Full Name">
		   
		  </div>
		  <div class="form-group">
		    <label for="description">Description</label>
		    
		      <textarea name="description" id="description" class="form-control" rows="4"><?php echo $category[0]->description ?></textarea>
		  </div>
		  <input type="hidden" name="id" value="<?php echo $category[0]->id ?>" />
		  <div class="form-group">
		    <div class="col-sm-10">
		      <button type="submit" class="btn btn-primary">Edit</button>
		    </div>
		  </div>
		  <?php echo form_close(); ?>
		</div>

  </div> <!--End of col-md-10-->
 
</div> <!-- End of row -->
</div>

</body>
</html>